<?php

namespace app\controllers;

use Yii;
use app\models\Customer;
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
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
                            return Yii::$app->user->identity->job->authorization->customer;
                        }
                    ],
					[
                        'actions' => ['create'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->create_customer;
                        }
                    ],
					[
                        'actions' => ['update'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->update_customer;
                        }
                    ],
					[
                        'actions' => ['delete'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->delete_customer;
                        }
                    ],
					[
                        'actions' => ['view'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->view_customer;
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Customer::find(),
			'sort' =>false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
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
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer();
		$model->same_address = 1;
		$model->limit_amount = 0;
		$model->customer_id = $this->genereteId();
        if ($model->load(Yii::$app->request->post())) {
			$model->limit_amount = preg_replace("/[^0-9.]/", "", $model->limit_amount);
			$model->limit_amount =(double)$model->limit_amount;
			if($model->same_address == 1){
				$model->village_bill_id = $model->village_id;
				$model->bill_address = $model->address;
			}
			$model->id_card_image = UploadedFile::getInstance($model, 'id_card_image');
			$model->npwp_image = UploadedFile::getInstance($model, 'npwp_image');
			if($model->save()){
				if($model->upload()){
					if($model->id_card_image)
						$model->id_card_image = $model->customer_id . '-card.' . $model->id_card_image->extension;
					if($model->npwp_image)
						$model->npwp_image = $model->customer_id . '-npwp.' . $model->npwp_image->extension;
						
					if($model->save()){
						return $this->redirect(['view', 'id' => $model->customer_id]);
					}
					else{
						$model->delete();
						$model->id_card_image = "";
						$model->npwp_image = "";
					}
				}else{
					$model->delete();
					$model->id_card_image = "";
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
		
		$dataBillRegency = [];
		$dataBillDistrict = [];
		$dataBillVillage = [];
		if($model->village_bill_id){
			$villageBill = Village::find()
			->where(['village_id' => $model->village_bill_id])
			->with('district.regency.province')
			->asArray()
			->one();
			$model->bill_province = $villageBill['district']['regency']['province']['province_id'];
			$model->bill_regency = $villageBill['district']['regency']['regency_id'];
			$model->bill_district = $villageBill['district']['district_id'];
			$dataBillRegency = Regency::find()
			->where(['province_id' => $model->bill_province])
			->asArray()
			->all();
			$dataBillDistrict = District::find()
			->where(['regency_id' => $model->bill_regency])
			->asArray()
			->all();
			$dataBillVillage = Village::find()
			->where(['district_id' => $model->bill_district])
			->asArray()
			->all();
		}
        return $this->render('create', [
            'model' => $model, 'dataProvince' => $dataProvince, 'dataRegency' => $dataRegency, 'dataDistrict' => $dataDistrict, 'dataVillage' => $dataVillage, 'dataBillRegency' => $dataBillRegency, 'dataBillDistrict' => $dataBillDistrict, 'dataBillVillage' => $dataBillVillage,
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$id_card_image = $model->id_card_image;
		$npwp_image = $model->npwp_image;
		if($model->village_id && $model->village_bill_id){
			if($model->village_id == $model->village_bill_id && $model->address == $model->bill_address)
				$model->same_address = 1;
			else
				$model->same_address = 0;
		}
        if ($model->load(Yii::$app->request->post())) {
			$model->limit_amount = preg_replace("/[^0-9.]/", "", $model->limit_amount);
			$model->limit_amount =(double)$model->limit_amount;
			if($model->same_address == 1){
				$model->village_bill_id = $model->village_id;
				$model->bill_address = $model->address;
			}
			$model->id_card_image = UploadedFile::getInstance($model, 'id_card_image');
			$model->npwp_image = UploadedFile::getInstance($model, 'npwp_image');
			if($model->save()){
				if($model->upload()){

					if($model->id_card_image){
						$model->id_card_image = $model->customer_id . '-card.' . $model->id_card_image->extension;
						if($id_card_image){
							if($model->id_card_image != $id_card_image)
								unlink('cusIdImages/'.$id_card_image);
						}
					}
					else
						$model->id_card_image = $id_card_image;
						
					if($model->npwp_image){
						$model->npwp_image = $model->customer_id . '-npwp.' . $model->npwp_image->extension;
						if($npwp_image){
							if($model->npwp_image != $npwp_image)
								unlink('cusNPWPImages/'.$npwp_image);
						}
					}
					else
						$model->npwp_image = $npwp_image;
						
					if($model->save())
						return $this->redirect(['view', 'id' => $model->customer_id]);
				}
				else{
					$model->id_card_image = $id_card_image;
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
		
		$dataBillRegency = [];
		$dataBillDistrict = [];
		$dataBillVillage = [];
		if($model->village_bill_id){
			$villageBill = Village::find()
			->where(['village_id' => $model->village_bill_id])
			->with('district.regency.province')
			->asArray()
			->one();
			$model->bill_province = $villageBill['district']['regency']['province']['province_id'];
			$model->bill_regency = $villageBill['district']['regency']['regency_id'];
			$model->bill_district = $villageBill['district']['district_id'];
			$dataBillRegency = Regency::find()
			->where(['province_id' => $model->bill_province])
			->asArray()
			->all();
			$dataBillDistrict = District::find()
			->where(['regency_id' => $model->bill_regency])
			->asArray()
			->all();
			$dataBillVillage = Village::find()
			->where(['district_id' => $model->bill_district])
			->asArray()
			->all();
		}
        return $this->render('update', [
            'model' => $model, 'dataProvince' => $dataProvince, 'dataRegency' => $dataRegency, 'dataDistrict' => $dataDistrict, 'dataVillage' => $dataVillage, 'dataBillRegency' => $dataBillRegency, 'dataBillDistrict' => $dataBillDistrict, 'dataBillVillage' => $dataBillVillage,
        ]);
    }

    /**
     * Deletes an existing Customer model.
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

	public function actionGet_customer_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$dataItem = Customer::find()
			->where(['flag' => 1])
			->asArray()
			->all();

			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataItem;
		}
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	//generate new ID//
	protected function genereteId()
    {
        $model = Customer::find()->count()+1;
       
	   if($model < 10){
			return "cus0000".(string)$model;
		}else if($model < 100){
			return"cus000".(string)$model;
		}else if($model < 1000){
			return "cus00".(string)$model;
		}else if($model < 10000){
			return "cus0".(string)$model;
		}else{
			return "cus".(string)$model;
		}
    }
}
