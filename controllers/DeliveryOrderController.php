<?php

namespace app\controllers;

use Yii;
use app\models\DeliveryOrder;
use app\models\DetailDeliveryOrder;
use app\models\Customer;
use app\models\SalesOrder;
use app\models\DetailSalesOrder;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DeliveryOrderController implements the CRUD actions for DeliveryOrder model.
 */
class DeliveryOrderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DeliveryOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => DeliveryOrder::find(),
			'sort' =>false,
        ]);
		$dataProvider->setPagination(false);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DeliveryOrder model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DeliveryOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$detail_do = '';
        $model = new DeliveryOrder();
		$model->employee_id=Yii::$app->user->identity->employee_id;
        if ($model->load(Yii::$app->request->post())) {
			$model->delivery_order_id = $this->genereteId();
			$model->date = date('Y-m-d H:i:s');
			$model->status = 2;
			
			if($model->save()){
				$stat_detail_save = true;
				$model_detail = [];
				for($i=0; $i < count(Yii::$app->request->post('DetailDeliveryOrder')); $i++){
					$model_detail[] = new DetailDeliveryOrder();
				}
				DetailDeliveryOrder::loadMultiple($model_detail, Yii::$app->request->post());
				foreach ($model_detail as $detail){
					$detail->delivery_order_id = $model->delivery_order_id;
					$detail->qty = (int)$detail->qty;
					$detail->qty_so = (int)$detail->qty_so;
					echo $detail->warehouse_id.'</br>';
					echo $detail->delivery_order_id.'</br>';
					echo $detail->qty.'</br>';
					echo $detail->qty_so.'</br>';
					echo $detail->item_id.'</br>';
					if(!$detail->save())
						$stat_detail_save = false;
				}
				if($stat_detail_save == true)
					return $this->redirect(['view', 'id' => $model->delivery_order_id]);
			}
            
        }
		
        $model->date = date("d-m-Y");
		$model->delivery_order_id = "AUTO";
        return $this->render('create', [
            'model' => $model, 'detail_do' => $detail_do,
        ]);
    }

    /**
     * Updates an existing DeliveryOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->delivery_order_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DeliveryOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	public function actionGet_do_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$dataItem = DeliveryOrder::find()
			->with('so.customer')
			->asArray()
			->all();

			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataItem;
		}
    }
	public function actionGet_detail_do_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			$dataItem = DetailDeliveryOrder::find()->with('item')->with('unit')
			->where(['delivery_order_id' => $data['delivery_order_id']])
			->asArray()
			->all();
			$dumb = [];
			
			foreach ($dataItem as $_dataItem){
				$temp_data_price =  DetailSalesOrder::find()
				->andWhere(['so_id' => $data['so_id']])
				->andWhere(['item_id' => $_dataItem['item_id']])
				->asArray()
				->all();
				
				$_dataItem = array_merge($_dataItem, ['prices'=>$temp_data_price[0]]);
				$dumb=array_merge($dumb, [$_dataItem]);
			}
			unset($_dataItem);
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dumb;
		}
    }
    /**
     * Finds the DeliveryOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DeliveryOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DeliveryOrder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function genereteId()
    {
		$transcode = "DO/".date("dmy")."/";
        $model = DeliveryOrder::find()->where(["like", "delivery_order_id", $transcode."%", false])->count()+1;
       
	   if($model < 10){
			return $transcode."00".(string)$model;
		}else if($model < 100){
			return $transcode."0".(string)$model;
		}else{
			return $transcode.(string)$model;
		}
    }
}
