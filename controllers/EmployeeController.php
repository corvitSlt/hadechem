<?php

namespace app\controllers;

use Yii;
use app\models\Employee;
use app\models\Job;
use app\models\Province;
use app\models\Regency;
use app\models\District;
use app\models\Village;
use app\models\Setting;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\ConvertDateIdToEn;
setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
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
                            return Yii::$app->user->identity->job->authorization->employee;
                        }
                    ],
					[
                        'actions' => ['create'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->create_employee;
                        }
                    ],
					[
                        'actions' => ['update'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->update_employee;
                        }
                    ],
					[
                        'actions' => ['delete'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->delete_employee;
                        }
                    ],
					[
                        'actions' => ['view'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->view_employee;
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
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Employee::find(),
			'sort' =>false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
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
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
        $model = new Employee(['scenario' => 'create']);
		$dataJob = Job::find()->all();
		
		foreach($dataJob as &$tempJob){
			$tempJob->job_name = ucwords($tempJob->job_name);
		}
		unset($tempJob);
		
		$model->gender = "L";
		$model->salary = 0;
		
		$model->birth_date = '1-1-' . ((int)(date('Y'))-24);
		$model->work_date = date('Y-m-d');
		$model->employee_id = $this->genereteId();
		
		if ($model->load(Yii::$app->request->post())){
			$model->employee_id = $this->genereteId();
			$modelSetting = new Setting();
			// CREATE SETTING //
			$modelSetting->save();
			// SET FORMAT ID SETTING //
			$model->setting_id = $modelSetting->setting_id;
			// SET FORMAT WORK_DATE //
			$model->birth_date = date('Y-m-d',strtotime($model->birth_date));
			$model->work_date = ConvertDateIdToEn::convertDate($model->work_date, 'l, j F Y', 'Y-m-d');
			// SET FORMAT SALARY //
			$model->salary = preg_replace("/[^0-9.]/", "", $model->salary);
			$model->salary =(double)$model->salary;
			// SET PASSWORD //
			$model->username = $this->generateUsername();
			$model->password = $this->generatePassword();
			$password = $model->password;
			$model->saltpassword = $model->generateSalt();
			$model->password = $model->hashPassword($password,$model->saltpassword);
			
			$model->image = UploadedFile::getInstance($model, 'image');
			$model->id_card_image = UploadedFile::getInstance($model, 'id_card_image');
			
			if($model->save()){
				if($model->upload()){
					$model->scenario = 'afterCreateUpload';
					$model->image = $model->employee_id . '.' . $model->image->extension;
					if($model->id_card_image)
						$model->id_card_image = $model->employee_id . '-card.' . $model->id_card_image->extension;
						
					if($model->save())
						return $this->redirect(['view', 'id' => $model->employee_id]);
					else{
						$model->scenario = 'create';
						$model->delete();
						$modelSetting->delete();
						$model->id_card_image = "";
						$model->image = "";
					}
				}else{
					$model->delete();
					$modelSetting->delete();
					$model->id_card_image = "";
					$model->image = "";
				}
			}
			else{
				$modelSetting->delete();
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
		$model->work_date = strftime("%A, %e %B %Y",strtotime($model->work_date));
		$model->birth_date = strftime("%d-%m-%Y", strtotime($model->birth_date));
        return $this->render('create', [
            'model' => $model, 'dataJob' => $dataJob, 'dataProvince' => $dataProvince, 'dataRegency' => $dataRegency, 'dataDistrict' => $dataDistrict, 'dataVillage' => $dataVillage,
        ]);
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model->scenario = 'update';
		$dataJob = Job::find()->all();
		
		foreach($dataJob as &$tempJob){
			$tempJob->job_name = ucwords($tempJob->job_name);
		}
		unset($tempJob);
		
		$image = $model->image;
		$id_card_image = $model->id_card_image;
		
        if ($model->load(Yii::$app->request->post())) {
			// SET FORMAT WORK_DATE //
			
			
			$model->birth_date = strftime("%Y-%m-%d", strtotime($model->birth_date));
			$model->work_date = ConvertDateIdToEn::convertDate($model->work_date, 'l, j F Y', 'Y-m-d');
			
			// SET FORMAT SALARY //
			$model->salary = preg_replace("/[^0-9.]/", "", $model->salary);
			$model->salary =(double)$model->salary;
			
			$model->image = UploadedFile::getInstance($model, 'image');
			$model->id_card_image = UploadedFile::getInstance($model, 'id_card_image');
			
			if($model->save()){
				if($model->upload()){
					
					if($model->image){
						$model->image = $model->employee_id . '.' . $model->image->extension;
						if($model->image != $image)
							unlink('empImages/'.$image);
					}
					else
						$model->image = $image;
						
					if($model->id_card_image){
						$model->id_card_image = $model->employee_id . '-card.' . $model->id_card_image->extension;
						if($id_card_image){
							if($model->id_card_image != $id_card_image)
								unlink('empIdImages/'.$id_card_image);
						}
					}
					else
						$model->id_card_image = $id_card_image;
						
					if($model->save())
						return $this->redirect(['view', 'id' => $model->employee_id]);
				}
				else{
					$model->image = $image;
					$model->id_card_image = $id_card_image;
					
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
		
		$model->work_date = strftime("%A, %e %B %Y", strtotime($model->work_date));
		$model->birth_date = strftime("%d-%m-%Y", strtotime($model->birth_date));
        return $this->render('update', [
            'model' => $model, 'dataJob' => $dataJob, 'dataProvince' => $dataProvince, 'dataRegency' => $dataRegency, 'dataDistrict' => $dataDistrict, 'dataVillage' => $dataVillage,
        ]);
    }

    /**
     * Deletes an existing Employee model.
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
	public function actionGet_setting_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$dataSetting = Employee::find(Yii::$app->user->id)->with('setting')
			->asArray()
			->one();
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataSetting['setting'];
		}
    }
	
	public function actionGet_salesman_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$dataSales = Employee::find()
			->where(['job_id' => 1])
			->asArray()
			->all();
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataSales;
		}
    }
	public function actionGet_regency_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			$dataRegency = Regency::find()
			->where(['province_id' => $data['province_id']])
			->asArray()
			->all();
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataRegency;
		}
    }
	public function actionGet_district_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			$dataDistrict = District::find()
			->where(['regency_id' => $data['regency_id']])
			->asArray()
			->all();
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataDistrict;
		}
    }
	public function actionGet_village_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			$dataVillage = Village::find()
			->where(['district_id' => $data['district_id']])
			->asArray()
			->all();
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataVillage;
		}
    }
    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	//generate new ID//
	protected function genereteId()
    {
        $model = Employee::find()->count()+1;
       
	   if($model < 10){
			return "emp0000".(string)$model;
		}else if($model < 100){
			return"emp000".(string)$model;
		}else if($model < 1000){
			return "emp00".(string)$model;
		}else if($model < 10000){
			return "emp0".(string)$model;
		}else{
			return "emp".(string)$model;
		}
    }
	protected function generateUsername()
    {
	    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randUsername = substr(str_shuffle($permitted_chars), 0, 16);
		
		while(Employee::find()->where(['username' => $randUsername])->count() > 0){
			$randUsername = substr(str_shuffle($permitted_chars), 0, 16);
		}
		return $randUsername;
    }
	protected function generatePassword()
    {
	    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randPassword = substr(str_shuffle($permitted_chars), 0, 16);
		
		return $randPassword;
    }
}
