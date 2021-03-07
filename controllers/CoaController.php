<?php

namespace app\controllers;

use Yii;
use app\models\Coa;
use app\models\AccountGroup;
use yii\data\ActiveDataProvider;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CoaController implements the CRUD actions for Coa model.
 */
class CoaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
			'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index'],
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
                            return Yii::$app->user->identity->job->authorization->coa;
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
     * Lists all Coa models.
     * @return mixed
     */
    public function actionIndex()
    {
         $model = new Coa();
		 $dataAccountGroup = AccountGroup::find()->all();
		 if ($model->load(Yii::$app->request->post())){
			 if($model->save()){
				return $this->redirect(['index']);
			}
		 }
		 return $this->render('index', [
            'model' => $model, 'dataAccountGroup' => $dataAccountGroup,
        ]);
    }

    /**
     * Displays a single Coa model.
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
     * Creates a new Coa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Coa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->coa_code]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Coa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->coa_code]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Coa model.
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
	public function actionGet_generate_coa_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			
			$dataGroup = AccountGroup::find()
			->where(['account_group_id' => $data['account_group_id']])
			->asArray()
			->one();
			
			$model = Coa::find()->where(['account_group_id' => $data['account_group_id']])->count()+1;
			$dataCOA="";
			if($model < 10){
				$dataCOA = "00".(string)$model;
			}else if($model < 100){
				$dataCOA = "0".(string)$model;
			}else{
				$dataCOA = (string)$model;
			}
			$dataDetailCOA = [
				'groupCode' => $dataGroup['group_code'],
				'coaCode' => $dataCOA,
			];	
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataDetailCOA;
		  }
    }
	public function actionGet_coa_ajax()
    {
        $dataItem = Coa::find()
		->with('accountGroup')
		->asArray()
        ->all();

		echo json_encode($dataItem);
    }
    /**
     * Finds the Coa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Coa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Coa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
