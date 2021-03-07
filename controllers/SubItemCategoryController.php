<?php

namespace app\controllers;

use Yii;
use app\models\SubItemCategory;
use app\models\ItemCategory;
use app\models\Item;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubItemCategoryController implements the CRUD actions for SubItemCategory model.
 */
class SubItemCategoryController extends Controller
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
                            return Yii::$app->user->identity->job->authorization->sub_item_category;
                        }
                    ],
					[
                        'actions' => ['create'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->create_sub_item_category;
                        }
                    ],
					[
                        'actions' => ['update'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->update_sub_item_category;
                        }
                    ],
					[
                        'actions' => ['delete'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->delete_sub_item_category;
                        }
                    ],
					[
                        'actions' => ['view'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->view_sub_item_category;
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
     * Lists all SubItemCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SubItemCategory::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SubItemCategory model.
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
     * Creates a new SubItemCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SubItemCategory();
		$model->disabledIdCategory = false;
		$dataItemCategory = ItemCategory::find()->all();
         if ($model->load(Yii::$app->request->post())) {
			$model->sub_item_category_id = $this->genereteId($model->item_category_id);
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->sub_item_category_id]);
			}
        }
		$model->sub_item_category_id = "AUTO";
        return $this->render('create', [
            'model' => $model, 'dataItemCategory' => $dataItemCategory,
        ]);
    }

    /**
     * Updates an existing SubItemCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		$categorty_id = $model->item_category_id;
		$model->disabledIdCategory = false;
		if(Item::find()->where(['like', 'sub_item_category_id', $model->sub_item_category_id.'%', false])->count() > 0)
			$model->disabledIdCategory = true;
     
		$dataItemCategory = ItemCategory::find()->all();
        if ($model->load(Yii::$app->request->post())){
			if($model->item_category_id != $categorty_id){
				$model->sub_item_category_id = $this->genereteId($model->item_category_id);
			}
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->sub_item_category_id]);
			}
        }
        return $this->render('create', [
            'model' => $model, 'dataItemCategory' => $dataItemCategory,
        ]);
    }

    /**
     * Deletes an existing SubItemCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$model->status = 0;
		if($model->save())
			return $this->redirect(['item/index', 'id'=>'subCategory']);
    }

    /**
     * Finds the SubItemCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SubItemCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SubItemCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function genereteId($CategoryId)
    {
        $model = SubItemCategory::find()->where(['like', 'item_category_id', $CategoryId.'%', false])->count() + 1;
       
	   $id = "";
	   
	   if($model < 10){
			$id = $CategoryId."0".(string)$model;
		}else{
			$id = $CategoryId.(string)$model;
		}
		
		while(SubItemCategory::find()->where(['sub_item_category_id' => $id])->count() > 0){
			$model ++;
			 if($model < 10){
				$id = $CategoryId."0".(string)$model;
			}else{
				$id = $CategoryId.(string)$model;
			}
		}
		
		return $id;
    }
}
