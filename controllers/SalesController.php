<?php

namespace app\controllers;

use Yii;
use app\models\Sales;
use app\models\DetailSales;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SalesController implements the CRUD actions for Sales model.
 */
class SalesController extends Controller
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
     * Lists all Sales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Sales::find(),
			'sort' =>false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sales model.
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
     * Creates a new Sales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$detail_sales = '';
        $model = new Sales();
		$model->employee_id=Yii::$app->user->identity->employee_id;
        if ($model->load(Yii::$app->request->post())) {
			$model->sales_id = $this->genereteId();
			$model->date = date('Y-m-d H:i:s');
			$model->due_date = (int)$model->due_date;
			$model->total = preg_replace("/[^0-9.]/", "", $model->total);
			$model->total =(double)$model->total;
			$model->grandtotal = preg_replace("/[^0-9.]/", "", $model->grandtotal);
			$model->grandtotal =(double)$model->grandtotal;
			$model->discount = preg_replace("/[^0-9.]/", "", $model->discount);
			$model->discount =(double)$model->discount;
			
			if($model->save()){
				$stat_detail_save = true;
				$model_detail = [];
				for($i=0; $i < count(Yii::$app->request->post('DetailSales')); $i++){
					$model_detail[] = new DetailSales();
				}
				DetailSales::loadMultiple($model_detail, Yii::$app->request->post());
				foreach ($model_detail as $detail){
					$detail->sales_id = $model->sales_id;
					$detail->qty = (int)$detail->qty;
					$detail->price = preg_replace("/[^0-9.]/", "", $detail->price);
					$detail->price =(double)$detail->price;
					$detail->subtotal = preg_replace("/[^0-9.]/", "", $detail->subtotal);
					$detail->subtotal =(double)$detail->subtotal;
					if(!$detail->save())
						$stat_detail_save = false;
				}
				if($stat_detail_save == true)
					return $this->redirect(['view', 'id' => $model->sales_id]);
			}
        }
		
		$model->date = date("d-m-Y");
		$model->sales_id = "AUTO";
		
        return $this->render('create', [
            'model' => $model, 'detail_sales' => $detail_sales,
        ]);
    }

    /**
     * Updates an existing Sales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sales_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sales model.
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
	public function actionGet_sales_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			$dataItem = Sales::find()
			->where(['customer_id' => $data['customer_id']])
			->asArray()
			->all();

			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataItem;
		}
    }
    /**
     * Finds the Sales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Sales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sales::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function genereteId()
    {
		$transcode = "INVS/".date("dmy")."/";
        $model = Sales::find()->where(["like", "sales_id", $transcode."%", false])->count()+1;
       
	   if($model < 10){
			return $transcode."00".(string)$model;
		}else if($model < 100){
			return $transcode."0".(string)$model;
		}else{
			return $transcode.(string)$model;
		}
    }
}
