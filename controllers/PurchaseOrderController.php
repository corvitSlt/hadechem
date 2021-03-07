<?php

namespace app\controllers;

use Yii;
use app\models\PurchaseOrder;
use app\models\DetailPurchaseOrder;
use app\models\DetailPurchaseRequest;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PurchaseOrderController implements the CRUD actions for PurchaseOrder model.
 */
class PurchaseOrderController extends Controller
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
     * Lists all PurchaseOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PurchaseOrder::find(),
			'sort' =>false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PurchaseOrder model.
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
     * Creates a new PurchaseOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$detail_po ='';
        $model = new PurchaseOrder();
		$model->total=0;
		$model->employee_id=Yii::$app->user->identity->employee_id;
        if ($model->load(Yii::$app->request->post())) {
            $model->po_id = $this->genereteId();
			$model->date = date('Y-m-d H:i:s');
			$model->total = preg_replace("/[^0-9.]/", "", $model->total);
			$model->total =(double)$model->total;
			
			if($model->save()){
				$stat_detail_save = true;
				$model_detail = [];
				for($i=0; $i < count(Yii::$app->request->post('DetailPurchaseOrder')); $i++){
					$model_detail[] = new DetailPurchaseOrder();
				}
				DetailPurchaseOrder::loadMultiple($model_detail, Yii::$app->request->post());
				foreach ($model_detail as $detail){
					$detail->po_id = $model->po_id;
					$detail->qty = (int)$detail->qty;
					$detail->price = preg_replace("/[^0-9.]/", "", $detail->price);
					$detail->price =(double)$detail->price;
					$detail->subtotal = preg_replace("/[^0-9.]/", "", $detail->subtotal);
					$detail->subtotal =(double)$detail->subtotal;
					if(!$detail->save())
						$stat_detail_save = false;
				}
				if($stat_detail_save == true)
					return $this->redirect(['view', 'id' => $model->po_id]);
			}
        }
		$model->date = date("d-m-Y");
		$model->po_id = "AUTO";
        return $this->render('create', [
            'model' => $model, 'detail_po' => $detail_po,
        ]);
    }

    /**
     * Updates an existing PurchaseOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->po_id]);
        }
		$model->date = date("d-m-Y");
		$model->so_id = "AUTO";
        return $this->render('update', [
            'model' => $model, 'detail_po' => $detail_po,
        ]);
    }

    /**
     * Deletes an existing PurchaseOrder model.
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
	public function actionGet_po_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$dataItem = PurchaseOrder::find()
			->with('supplier')
			->asArray()
			->all();

			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataItem;
		}
    }
	public function actionGet_detail_po_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			$dataItem = DetailPurchaseOrder::find()->with('item')->with('unit')
			->where(['po_id' => $data['po_id']])
			->asArray()
			->all();
			
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataItem;
		  }
    }
    /**
     * Finds the PurchaseOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PurchaseOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PurchaseOrder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function genereteId()
    {
		$transcode = "PO/".date("dmy")."/";
        $model = PurchaseOrder::find()->where(["like", "po_id", $transcode."%", false])->count()+1;
       
	   if($model < 10){
			return $transcode."00".(string)$model;
		}else if($model < 100){
			return $transcode."0".(string)$model;
		}else{
			return $transcode.(string)$model;
		}
    }
}
