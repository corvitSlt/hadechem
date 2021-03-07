<?php

namespace app\controllers;

use Yii;
use app\models\Warehouse;
use app\models\Province;
use app\models\Regency;
use app\models\District;
use app\models\Village;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WarehouseController implements the CRUD actions for Warehouse model.
 */
class WarehouseController extends Controller
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
                            return Yii::$app->user->identity->job->authorization->warehouse;
                        }
                    ],
					[
                        'actions' => ['create'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->create_warehouse;
                        }
                    ],
					[
                        'actions' => ['update'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->update_warehouse;
                        }
                    ],
					[
                        'actions' => ['delete'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->delete_warehouse;
                        }
                    ],
					[
                        'actions' => ['view'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->view_warehouse;
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
     * Lists all Warehouse models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Warehouse::find(),
			'sort' =>false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Warehouse model.
     * @param integer $id
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
     * Creates a new Warehouse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Warehouse();

        if($model->load(Yii::$app->request->post())){
			$model->warehouse_id = "";
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->warehouse_id]);
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
		$model->warehouse_id = "AUTO";
        return $this->render('create', [
            'model' => $model, 'dataProvince' => $dataProvince, 'dataRegency' => $dataRegency, 'dataDistrict' => $dataDistrict, 'dataVillage' => $dataVillage,
        ]);
    }

    /**
     * Updates an existing Warehouse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->warehouse_id]);
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
     * Deletes an existing Warehouse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	public function actionGet_warehouse_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$dataItem = Warehouse::find()
			->asArray()
			->all();

			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataItem;
		}
    }
    /**
     * Finds the Warehouse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Warehouse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Warehouse::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
