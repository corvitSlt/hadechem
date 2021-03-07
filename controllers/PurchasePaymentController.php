<?php

namespace app\controllers;

use Yii;
use app\models\PurchasePayment;
use app\models\DetailPurchasePayment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PurchasePaymentController implements the CRUD actions for PurchasePayment model.
 */
class PurchasePaymentController extends Controller
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
     * Lists all PurchasePayment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PurchasePayment::find(),
			'sort' =>false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PurchasePayment model.
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
     * Creates a new PurchasePayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$detail_purchasePayment = '';
        $model = new PurchasePayment();
		$model->total=0;
		$model->employee_id=Yii::$app->user->identity->employee_id;
         if ($model->load(Yii::$app->request->post())) {
			$model->purchase_payment_id = $this->genereteId();
			$model->date = date('Y-m-d H:i:s');
			$model->total = preg_replace("/[^0-9.]/", "", $model->total);
			$model->total =(double)$model->total;
			
			if($model->save()){
				$stat_detail_save = true;
				$model_detail = [];
				for($i=0; $i < count(Yii::$app->request->post('DetailPurchasePayment')); $i++){
					$model_detail[] = new DetailPurchasePayment();
				}
				DetailPurchasePayment::loadMultiple($model_detail, Yii::$app->request->post());
				foreach ($model_detail as $detail){
					$detail->purchase_payment_id = $model->purchase_payment_id;
					$detail->subtotal = preg_replace("/[^0-9.]/", "", $detail->subtotal);
					$detail->subtotal =(double)$detail->subtotal;
					if(!$detail->save())
						$stat_detail_save = false;
				}
				if($stat_detail_save == true)
					return $this->redirect(['view', 'id' => $model->purchase_payment_id]);
			}
        }
		
		$model->date = date("d-m-Y");
		$model->purchase_payment_id = "AUTO";
        return $this->render('create', [
            'model' => $model, 'detail_purchasePayment' => $detail_purchasePayment,
        ]);
    }

    /**
     * Updates an existing PurchasePayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->purchase_payment_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PurchasePayment model.
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

    /**
     * Finds the PurchasePayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PurchasePayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PurchasePayment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function genereteId()
    {
		$transcode = "PP/".date("dmy")."/";
        $model = PurchasePayment::find()->where(["like", "purchase_payment_id", $transcode."%", false])->count()+1;
       
	   if($model < 10){
			return $transcode."00".(string)$model;
		}else if($model < 100){
			return $transcode."0".(string)$model;
		}else{
			return $transcode.(string)$model;
		}
    }
}
