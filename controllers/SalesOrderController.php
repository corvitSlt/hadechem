<?php

namespace app\controllers;

use Yii;
use app\models\SalesOrder;
use app\models\DetailSalesOrder;
use app\models\Item;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SalesOrderController implements the CRUD actions for SalesOrder model.
 */
class SalesOrderController extends Controller
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
     * Lists all SalesOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SalesOrder::find(),
			'sort' =>false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SalesOrder model.
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
     * Creates a new SalesOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$detail_so ='';
        $model = new SalesOrder();
		$model->total=0;
		$model->grandtotal=0;
		$model->employee_id=Yii::$app->user->identity->employee_id;
		if(Yii::$app->user->identity->job_id==1){
			$model->sales_id = Yii::$app->user->identity->employee_id;
		}
        if ($model->load(Yii::$app->request->post())) {
			$model->so_id = $this->genereteId();
			$model->date = date('Y-m-d H:i:s');
			$model->total = preg_replace("/[^0-9.]/", "", $model->total);
			$model->total =(double)$model->total;
			$model->grandtotal = preg_replace("/[^0-9.]/", "", $model->grandtotal);
			$model->grandtotal =(double)$model->grandtotal;
			$model->status = 2;
			
			if($model->save()){
				$stat_detail_save = true;
				$model_detail = [];
				for($i=0; $i < count(Yii::$app->request->post('DetailSalesOrder')); $i++){
					$model_detail[] = new DetailSalesOrder();
				}
				DetailSalesOrder::loadMultiple($model_detail, Yii::$app->request->post());
				foreach ($model_detail as $detail){
					$detail->so_id = $model->so_id;
					$detail->qty = (int)$detail->qty;
					$detail->price = preg_replace("/[^0-9.]/", "", $detail->price);
					$detail->price =(double)$detail->price;
					$detail->subtotal = preg_replace("/[^0-9.]/", "", $detail->subtotal);
					$detail->subtotal =(double)$detail->subtotal;
					if(!$detail->save())
						$stat_detail_save = false;
				}
				if($stat_detail_save == true)
					return $this->redirect(['view', 'id' => $model->so_id]);
			}
        }
		
		$model->date = date("d-m-Y");
		$model->so_id = "AUTO";
        return $this->render('create', [
            'model' => $model, 'detail_so' => $detail_so,
        ]);
    }

    /**
     * Updates an existing SalesOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model->date = date('d-m-Y',strtotime($model->date));
		$model->emp_edit_id=Yii::$app->user->identity->employee_id;
		$detail_so = DetailSalesOrder::find()->with('item')->with('unit')
		->where(['so_id' => $model->so_id])
		->asArray()
		->all();
        if ($model->load(Yii::$app->request->post())){
			$model->date = date('Y-m-d H:i:s');
			$model->date = date('Y-m-d',strtotime($model->date));
			$model->total = preg_replace("/[^0-9.]/", "", $model->total);
			$model->total =(double)$model->total;
			$model->grandtotal = preg_replace("/[^0-9.]/", "", $model->grandtotal);
			$model->grandtotal =(double)$model->grandtotal;
			
			if($model->save()){
				$stat_detail_save = true;
				$model_detail_save = [];
				for($i=0; $i < count(Yii::$app->request->post('DetailSalesOrder')); $i++){
					$model_detail_save[] = new DetailSalesOrder();
				}
				DetailSalesOrder::loadMultiple($model_detail_save, Yii::$app->request->post());
				foreach ($model_detail_save as $detail){
					$detail->so_id = $model->so_id;
					$detail->qty = (int)$detail->qty;
					$detail->price = preg_replace("/[^0-9.]/", "", $detail->price);
					$detail->price =(double)$detail->price;
					$detail->subtotal = preg_replace("/[^0-9.]/", "", $detail->subtotal);
					$detail->subtotal =(double)$detail->subtotal;
					if(!$detail->save())
						$stat_detail_save = false;
				}
				if($stat_detail_save == true){
					foreach ($detail_so as $temp){
						DetailSalesOrder::find()
						->where('detail_so_id = :detail_so_id', [':detail_so_id' => $temp['detail_so_id']])
						->one()->delete();
					}
					return $this->redirect(['view', 'id' => $model->so_id]);
				}
			}
        }

        return $this->render('update', [
            'model' => $model, 'detail_so' => $detail_so,
        ]);
    }

    /**
     * Deletes an existing SalesOrder model.
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
	public function actionGet_so_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$dataItem = SalesOrder::find()
			->with('customer')
			->asArray()
			->all();

			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataItem;
		}
    }
	public function actionGet_detail_so_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			$dataItem = DetailSalesOrder::find()->with('item')->with('unit')
			->where(['so_id' => $data['so_id']])
			->asArray()
			->all();
			
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataItem;
		  }
        

		//echo json_encode($dataItem);
    }
    /**
     * Finds the SalesOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SalesOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SalesOrder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function genereteId()
    {
		$transcode = "SO/".date("dmy")."/";
        $model = SalesOrder::find()->where(["like", "so_id", $transcode."%", false])->count()+1;
       
	   if($model < 10){
			return $transcode."00".(string)$model;
		}else if($model < 100){
			return $transcode."0".(string)$model;
		}else{
			return $transcode.(string)$model;
		}
    }
}
