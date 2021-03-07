<?php

namespace app\controllers;

use Yii;
use app\models\Setting;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SettingController implements the CRUD actions for Setting model.
 */
class SettingController extends Controller
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
     * Lists all Setting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Setting::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Setting model.
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
     * Creates a new Setting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Setting();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->setting_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Setting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->setting_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Setting model.
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
	public function actionUpdate_setting_ajax()
    {
        $model = $this->findModel($_POST["id"]);
		if($_POST['entity']=='no_navbar_border')
			$model->no_navbar_border = $_POST['value'];
		if($_POST['entity']=='navbar_position_fix')
			$model->navbar_position_fix = $_POST['value'];
		if($_POST['entity']=='footer_position_fix')
			$model->footer_position_fix = $_POST['value'];
		if($_POST['entity']=='body_small_text')
			$model->body_small_text = $_POST['value'];
		if($_POST['entity']=='navbar_small_text')
			$model->navbar_small_text = $_POST['value'];
		if($_POST['entity']=='sidebar_nav_small_text')
			$model->sidebar_nav_small_text = $_POST['value'];
		if($_POST['entity']=='footer_small_text')
			$model->footer_small_text = $_POST['value'];
		if($_POST['entity']=='mini_sidebar')
			$model->mini_sidebar = $_POST['value'];
		if($_POST['entity']=='sidebar_nav_flat_style')
			$model->sidebar_nav_flat_style = $_POST['value'];
		if($_POST['entity']=='sidebar_nav_legacy_style')
			$model->sidebar_nav_legacy_style = $_POST['value'];
		if($_POST['entity']=='sidebar_nav_compact')
			$model->sidebar_nav_compact = $_POST['value'];
		if($_POST['entity']=='sidebar_nav_child_indent')
			$model->sidebar_nav_child_indent = $_POST['value'];
		if($_POST['entity']=='sidebar_nav_faf')
			$model->sidebar_nav_faf = $_POST['value'];
		if($_POST['entity']=='sidebar_nav_fas')
			$model->sidebar_nav_fas = $_POST['value'];
		if($_POST['entity']=='main_sidebar_disable_hover')
			$model->main_sidebar_disable_hover = $_POST['value'];
		if($_POST['entity']=='brand_small_text')
			$model->brand_small_text = $_POST['value'];
		if($_POST['entity']=='navbar_variant')
			$model->navbar_variant = $_POST['value'];
		if($_POST['entity']=='accent_color_variant')
			$model->accent_color_variant = $_POST['value'];
		if($_POST['entity']=='sidebar_variant')
			$model->sidebar_variant = $_POST['value'];
		if($_POST['entity']=='brand_logo_variant')
			$model->brand_logo_variant = $_POST['value'];
        if($model->save())
			echo json_encode('save');
    }
    /**
     * Finds the Setting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Setting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Setting::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
