<?php

namespace app\controllers;

use Yii;
use app\models\Purchase;
use app\models\DetailPurchase;
use app\models\PurchaseOrder;
use app\models\OrderReceipt;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PurchaseController implements the CRUD actions for Purchase model.
 */
class PurchaseController extends Controller
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
     * Lists all Purchase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Purchase::find(),
			'sort' =>false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Purchase model.
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
     * Creates a new Purchase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$detail_purchase = "";
        $model = new Purchase();
		$model->total=0;
		$model->discount=0;
		$model->grandtotal=0;
		$model->employee_id=Yii::$app->user->identity->employee_id;
        if ($model->load(Yii::$app->request->post())) {
            $model->purchase_id = $this->genereteId();
			$model->date = date('Y-m-d H:i:s');
			$model->due_date = (int)$model->due_date;
			$model->total = preg_replace("/[^0-9.]/", "", $model->total);
			$model->total =(double)$model->total;
			$model->grandtotal = preg_replace("/[^0-9.]/", "", $model->grandtotal);
			$model->grandtotal =(double)$model->grandtotal;
			if(strpos($model->trans_id, 'PO/')!==false)
				$model->status = 8;
			else
				$model->status = 2;
			if($model->save()){
				$stat_detail_save = true;
				$model_detail = [];
				for($i=0; $i < count(Yii::$app->request->post('DetailPurchase')); $i++){
					$model_detail[] = new DetailPurchase();
				}
				DetailPurchase::loadMultiple($model_detail, Yii::$app->request->post());
				foreach ($model_detail as $detail){
					$detail->purchase_id = $model->purchase_id;
					$detail->qty = (int)$detail->qty;
					$detail->price = preg_replace("/[^0-9.]/", "", $detail->price);
					$detail->price =(double)$detail->price;
					$detail->subtotal = preg_replace("/[^0-9.]/", "", $detail->subtotal);
					$detail->subtotal =(double)$detail->subtotal;
					if(!$detail->save())
						$stat_detail_save = false;
				}
				if($stat_detail_save == true)
					return $this->redirect(['view', 'id' => $model->purchase_id]);
			}
        }
		
		$model->date = date("d-m-Y");
		$model->purchase_id = "AUTO";
        return $this->render('create', [
            'model' => $model, 'detail_purchase' => $detail_purchase,
        ]);
    }

    /**
     * Updates an existing Purchase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->purchase_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Purchase model.
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
	public function actionGet_purchase_trans_id_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$dataPurchase = PurchaseOrder::find()->with('supplier')
			->where(['status' => 7])
			->asArray()
			->all();
			$dataOR = OrderReceipt::find()->with('supplier')
			->where(['status' => 2])
			->asArray()
			->all();
			
			$dataTrans = array_merge($dataPurchase,$dataOR);
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataTrans;
		}
    }
	public function actionGet_purchase_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			$dataItem = Purchase::find()
			->where(['supplier_id' => $data['supplier_id']])
			->asArray()
			->all();

			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataItem;
		}
    }
    /**
     * Finds the Purchase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Purchase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Purchase::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function genereteId()
    {
		$transcode = "INVP/".date("dmy")."/";
        $model = Purchase::find()->where(["like", "purchase_id", $transcode."%", false])->count()+1;
       
	   if($model < 10){
			return $transcode."00".(string)$model;
		}else if($model < 100){
			return $transcode."0".(string)$model;
		}else{
			return $transcode.(string)$model;
		}
    }
}
