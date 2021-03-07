<?php

namespace app\controllers;

use Yii;
use app\models\Supplier;
use app\models\Province;
use app\models\Regency;
use app\models\District;
use app\models\Village;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * SupplierController implements the CRUD actions for Supplier model.
 */
class SupplierController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
		'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index', 'create', 'update', 'delete', 'view'],
                'rules' => [
					 [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['index'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->supplier;
                        }
                    ],
					[
                        'actions' => ['create'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->create_supplier;
                        }
                    ],
					[
                        'actions' => ['update'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->update_supplier;
                        }
                    ],
					[
                        'actions' => ['delete'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->delete_supplier;
                        }
                    ],
					[
                        'actions' => ['view'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->view_supplier;
                        }
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Supplier models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Supplier::find(),
			'sort' =>false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Supplier model.
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
     * Creates a new Supplier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Supplier();
		$model->supplier_id = $this->genereteId();
        if ($model->load(Yii::$app->request->post())) {
			$model->npwp_image = UploadedFile::getInstance($model, 'npwp_image');
			if($model->save()){
				if($model->upload()){
					if($model->npwp_image)
						$model->npwp_image = $model->supplier_id . '-npwp.' . $model->npwp_image->extension;
						
					if($model->save()){
						return $this->redirect(['view', 'id' => $model->supplier_id]);
					}
					else{
						$model->delete();
						$model->npwp_image = "";
					}
				}else{
					$model->delete();
					$model->npwp_image = "";
				}
			}
		}
		$dataProvince =  Province::find()
			->asArray()
			->all();
		$dataRegency = [];
		$dataDistrict = [];
		$dataVillage = [];
		if($model->village_id){
			$village = Village::find()
			->where(['village_id' => $model->village_id])
			->with('district.regency.province')
			->asArray()
			->one();
			$model->province = $village['district']['regency']['province']['province_id'];
			$model->regency = $village['district']['regency']['regency_id'];
			$model->district = $village['district']['district_id'];
			$dataRegency = Regency::find()
			->where(['province_id' => $model->province])
			->asArray()
			->all();
			$dataDistrict = District::find()
			->where(['regency_id' => $model->regency])
			->asArray()
			->all();
			$dataVillage = Village::find()
			->where(['district_id' => $model->district])
			->asArray()
			->all();
		}
        return $this->render('create', [
            'model' => $model, 'dataProvince' => $dataProvince, 'dataRegency' => $dataRegency, 'dataDistrict' => $dataDistrict, 'dataVillage' => $dataVillage,
        ]);
    }

    /**
     * Updates an existing Supplier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$npwp_image = $model->npwp_image;
         if ($model->load(Yii::$app->request->post())) {
			$model->npwp_image = UploadedFile::getInstance($model, 'npwp_image');
			if($model->save()){
				if($model->upload()){
					if($model->npwp_image){
						$model->npwp_image = $model->supplier_id . '-npwp.' . $model->npwp_image->extension;
						if($npwp_image){
							if($model->npwp_image != $npwp_image)
								unlink('supNPWPImages/'.$npwp_image);
						}
					}
					else
						$model->npwp_image = $npwp_image;
						
					if($model->save())
						return $this->redirect(['view', 'id' => $model->supplier_id]);
				}
				else{
					$model->npwp_image = $npwp_image;
					
					$model->save();
				}
			}
		}
		$dataProvince =  Province::find()
			->asArray()
			->all();
		$dataRegency = [];
		$dataDistrict = [];
		$dataVillage = [];
		if($model->village_id){
			$village = Village::find()
			->where(['village_id' => $model->village_id])
			->with('district.regency.province')
			->asArray()
			->one();
			$model->province = $village['district']['regency']['province']['province_id'];
			$model->regency = $village['district']['regency']['regency_id'];
			$model->district = $village['district']['district_id'];
			$dataRegency = Regency::find()
			->where(['province_id' => $model->province])
			->asArray()
			->all();
			$dataDistrict = District::find()
			->where(['regency_id' => $model->regency])
			->asArray()
			->all();
			$dataVillage = Village::find()
			->where(['district_id' => $model->district])
			->asArray()
			->all();
		}
        return $this->render('update', [
            'model' => $model, 'dataProvince' => $dataProvince, 'dataRegency' => $dataRegency, 'dataDistrict' => $dataDistrict, 'dataVillage' => $dataVillage,
        ]);
    }

    /**
     * Deletes an existing Supplier model.
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
	public function actionGet_supplier_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$dataItem = Supplier::find()
			->where(['flag' => 1])
			->asArray()
			->all();

			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataItem;
		}
    }
    /**
     * Finds the Supplier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Supplier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Supplier::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	protected function genereteId()
    {
        $model = Supplier::find()->count()+1;
       
	   if($model < 10){
			return "sup0000".(string)$model;
		}else if($model < 100){
			return"sup000".(string)$model;
		}else if($model < 1000){
			return "sup00".(string)$model;
		}else if($model < 10000){
			return "sup0".(string)$model;
		}else{
			return "sup".(string)$model;
		}
    }
}
