<?php

namespace app\controllers;

use Yii;
use app\models\Item;
use app\models\SubItemCategory;
use app\models\ItemCategory;
use app\models\Unit;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
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
                            return Yii::$app->user->identity->job->authorization->item;
                        }
                    ],
					[
                        'actions' => ['create'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->create_item;
                        }
                    ],
					[
                        'actions' => ['update'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->update_item;
                        }
                    ],
					[
                        'actions' => ['delete'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->delete_item;
                        }
                    ],
					[
                        'actions' => ['view'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->view_item;
                        }
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'deletes' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex($id='item')
    {
		$modalActive = $id;
        $dataProvider = new ActiveDataProvider([
            'query' => Item::find(),
			'sort' =>false,
        ]);
		$dataProviderSub = new ActiveDataProvider([
            'query' => SubItemCategory::find(),
			'sort' =>false,
        ]);
		$dataProviderCategory = new ActiveDataProvider([
            'query' => ItemCategory::find(),
			'sort' =>false,
        ]);
		$dataProviderUnit = new ActiveDataProvider([
            'query' => Unit::find(),
			'sort' =>false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
			'dataProviderSub' => $dataProviderSub,
			'dataProviderCategory' => $dataProviderCategory,
			'dataProviderUnit' => $dataProviderUnit,
			'modalActive' => $modalActive,
        ]);
    }

    /**
     * Displays a single Item model.
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
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();
		$dataSubItemCategory = SubItemCategory::find()->all();
		$dataUnit = Unit::find()->all();
		$model->price = 0;
        if ($model->load(Yii::$app->request->post())) {
			$model->item_id = $this->genereteId($model->sub_item_category_id);
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->item_id]);
			}
        }
		$model->item_id = "AUTO";
        return $this->render('create', [
            'model' => $model, 'dataSubItemCategory' => $dataSubItemCategory, 'dataUnit' => $dataUnit,
        ]);
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$dataSubItemCategory = SubItemCategory::find()->all();
		$dataUnit = Unit::find()->all();
		
        if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->item_id]);
			}
        }

        return $this->render('update', [
            'model' => $model, 'dataSubItemCategory' => $dataSubItemCategory, 'dataUnit' => $dataUnit,
        ]);
    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$model->status = 0;
		$model->save();
        return $this->redirect(['index']);
    }
	
	public function actionGet_item_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$dataItem = Item::find()->with('unit')
			->asArray()
			->all();

			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataItem;
		}
    }
    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function genereteId($subCategoryId)
    {
        $model = Item::find()->where(['like', 'sub_item_category_id', $subCategoryId.'%', false])->count() + 1;
		
       $id = "";
	   
	   if($model < 10){
			$id = $subCategoryId."0000".(string)$model;
		}else if($model < 100){
			$id = $subCategoryId."000".(string)$model;
		}else if($model < 1000){
			$id = $subCategoryId."00".(string)$model;
		}else if($model < 10000){
			$id = $subCategoryId."0".(string)$model;
		}else{
			$id = $subCategoryId.(string)$model;
		}
		
		while(Item::find()->where(['item_id' => $id])->count() > 0){
			$model ++;
			if($model < 10){
				$id = $subCategoryId."0000".(string)$model;
			}else if($model < 100){
				$id = $subCategoryId."000".(string)$model;
			}else if($model < 1000){
				$id = $subCategoryId."00".(string)$model;
			}else if($model < 10000){
				$id = $subCategoryId."0".(string)$model;
			}else{
				$id = $subCategoryId.(string)$model;
			}
		}
	
		return $id;
    }
}
