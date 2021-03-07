<?php

namespace app\controllers;

use Yii;
use app\models\Journal;
use app\models\DetailJournal;
use app\models\Coa;

use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ConvertDateIdToEn;
setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');

/**
 * JournalController implements the CRUD actions for Journal model.
 */
class JournalController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
			'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index','cashin','cashout', 'bankin', 'bankout', 'general'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['cashin'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->cash_in;
                        }
                    ],
					[
                        'actions' => ['cashout'],
                        'allow' => true,
						'roles' => ['@'],	
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->cash_out;
                        }
                    ],
					[
                        'actions' => ['bankin'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->bank_in;
                        }
                    ],
					[
                        'actions' => ['bankout'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->bank_out;
                        }
                    ],
					[
                        'actions' => ['general'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->general_journal;
                        }
                    ],
					[
                        'actions' => ['index'],
                        'allow' => true,
						'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->job->authorization->journal;
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
     * Lists all Journal models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', []);
    }

    /**
     * Displays a single Journal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */


    /**
     * Creates a new Journal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	public function actionCashin()
    {
        $model = new Journal();
		$dataCoa = Coa::find()->select(['coa_code', 'CONCAT(coa_code, " - ", coa_name) AS coa_code_name'])
		->andWhere(['!=', 'coa_code', '101.001'])
		->andWhere(['!=', 'coa_code', '101.002'])
		->all();
		$model->date = date("l, d F Y");
		$model->balance = 0;
        if ($model->load(Yii::$app->request->post())) {
			$save_state = true;
			$model->date = ConvertDateIdToEn::convertDate($model->date, 'l, j F Y', 'Y-m-d');
			if($model->save()){
				$modelDebit = new DetailJournal;
				$modelCredit = new DetailJournal;
				
				$modelDebit->journal_id = $model->journal_id;
				$modelDebit->coa_code = '101.001';
				$modelDebit->debit = preg_replace("/[^0-9.]/", "", $model->balance);
				$modelDebit->debit =(double)$modelDebit->debit;
				
				$modelCredit->journal_id = $model->journal_id;
				$modelCredit->coa_code = $model->credit;
				$modelCredit->credit = preg_replace("/[^0-9.]/", "", $model->balance);
				$modelCredit->credit =(double)$modelCredit->credit;
				
				if($modelDebit->save()){
					if(!$modelCredit->save()){
						$model->delete();
						$modelDebit->delete();
						$save_state = false;
					}
				}
				else{
					$model->delete();
					$save_state = false;
				}
			}else
				$save_state = false;
			if($save_state){
				$temp_date = $model->date;
				$model = new Journal();
				$model->date = $temp_date;
			}
        }
		$model->date = strftime("%A, %e %B %Y", strtotime($model->date));
        return $this->render('cashin', [
            'model' => $model, 'dataCoa' => $dataCoa,
        ]);
    }
	
	public function actionCashout()
    {
        $model = new Journal();
		$dataCoa = Coa::find()->select(['coa_code', 'CONCAT(coa_code, " - ", coa_name) AS coa_code_name'])
		->andWhere(['!=', 'coa_code', '101.001'])
		->andWhere(['!=', 'coa_code', '101.002'])
		->all();
		$model->date = date("l, d F Y");
		$model->balance = 0;
        if ($model->load(Yii::$app->request->post())) {
			$save_state = true;
			$model->date = ConvertDateIdToEn::convertDate($model->date, 'l, j F Y', 'Y-m-d');
			if($model->save()){
				$modelDebit = new DetailJournal;
				$modelCredit = new DetailJournal;
				
				$modelDebit->journal_id = $model->journal_id;
				$modelDebit->coa_code = $model->debit;
				$modelDebit->debit = preg_replace("/[^0-9.]/", "", $model->balance);
				$modelDebit->debit =(double)$modelDebit->debit;
				
				$modelCredit->journal_id = $model->journal_id;
				$modelCredit->coa_code = '101.001';
				$modelCredit->credit = preg_replace("/[^0-9.]/", "", $model->balance);
				$modelCredit->credit =(double)$modelCredit->credit;
				
				if($modelDebit->save()){
					if(!$modelCredit->save()){
						$model->delete();
						$modelDebit->delete();
						$save_state = false;
					}
				}
				else{
					$model->delete();
					$save_state = false;
				}
			}else
				$save_state = false;
			if($save_state){
				$temp_date = $model->date;
				$model = new Journal();
				$model->date = $temp_date;
			}
        }
		$model->date = strftime("%A, %e %B %Y", strtotime($model->date));
        return $this->render('cashout', [
            'model' => $model, 'dataCoa' => $dataCoa,
        ]);
    }
	
	public function actionBankin()
    {
        $model = new Journal();
		$dataCoa = Coa::find()->select(['coa_code', 'CONCAT(coa_code, " - ", coa_name) AS coa_code_name'])
		->andWhere(['!=', 'coa_code', '101.001'])
		->andWhere(['!=', 'coa_code', '101.002'])
		->all();
		$model->date = date("l, d F Y");
		$model->balance = 0;
        if ($model->load(Yii::$app->request->post())) {
			$save_state = true;
			$model->date = ConvertDateIdToEn::convertDate($model->date, 'l, j F Y', 'Y-m-d');
			if($model->save()){
				$modelDebit = new DetailJournal;
				$modelCredit = new DetailJournal;
				
				$modelDebit->journal_id = $model->journal_id;
				$modelDebit->coa_code = '101.002';
				$modelDebit->debit = preg_replace("/[^0-9.]/", "", $model->balance);
				$modelDebit->debit =(double)$modelDebit->debit;
				
				$modelCredit->journal_id = $model->journal_id;
				$modelCredit->coa_code = $model->credit;
				$modelCredit->credit = preg_replace("/[^0-9.]/", "", $model->balance);
				$modelCredit->credit =(double)$modelCredit->credit;
				
				if($modelDebit->save()){
					if(!$modelCredit->save()){
						$model->delete();
						$modelDebit->delete();
						$save_state = false;
					}
				}
				else{
					$model->delete();
					$save_state = false;
				}
			}else
				$save_state = false;
			if($save_state){
				$temp_date = $model->date;
				$model = new Journal();
				$model->date = $temp_date;
			}
        }
		$model->date = strftime("%A, %e %B %Y", strtotime($model->date));
        return $this->render('bankin', [
            'model' => $model, 'dataCoa' => $dataCoa,
        ]);
    }
	
	public function actionBankout()
    {
        $model = new Journal();
		$dataCoa = Coa::find()->select(['coa_code', 'CONCAT(coa_code, " - ", coa_name) AS coa_code_name'])
		->andWhere(['!=', 'coa_code', '101.001'])
		->andWhere(['!=', 'coa_code', '101.002'])
		->all();
		$model->date = date("l, d F Y");
		$model->balance = 0;
        if ($model->load(Yii::$app->request->post())) {
			$save_state = true;
			$model->date = ConvertDateIdToEn::convertDate($model->date, 'l, j F Y', 'Y-m-d');
			if($model->save()){
				$modelDebit = new DetailJournal;
				$modelCredit = new DetailJournal;
				
				$modelDebit->journal_id = $model->journal_id;
				$modelDebit->coa_code = $model->debit;
				$modelDebit->debit = preg_replace("/[^0-9.]/", "", $model->balance);
				$modelDebit->debit =(double)$modelDebit->debit;
				
				$modelCredit->journal_id = $model->journal_id;
				$modelCredit->coa_code = '101.002';
				$modelCredit->credit = preg_replace("/[^0-9.]/", "", $model->balance);
				$modelCredit->credit =(double)$modelCredit->credit;
				
				if($modelDebit->save()){
					if(!$modelCredit->save()){
						$model->delete();
						$modelDebit->delete();
						$save_state = false;
					}
				}
				else{
					$model->delete();
					$save_state = false;
				}
			}else
				$save_state = false;
			if($save_state){
				$temp_date = $model->date;
				$model = new Journal();
				$model->date = $temp_date;
			}
        }
		$model->date = strftime("%A, %e %B %Y", strtotime($model->date));
        return $this->render('bankout', [
            'model' => $model, 'dataCoa' => $dataCoa,
        ]);
    }
	
	public function actionGeneral()
    {
        $model = new Journal(['scenario'=>'generalJournal']);
		$dataCoa = Coa::find()->select(['coa_code', 'CONCAT(coa_code, " - ", coa_name) AS coa_code_name'])
		->andWhere(['!=', 'coa_code', '101.001'])
		->andWhere(['!=', 'coa_code', '101.002'])
		->all();
		$model->date = date("l, d F Y");
		$model->balance = 0;
        if ($model->load(Yii::$app->request->post())) {
			$save_state = true;
			$model->date = ConvertDateIdToEn::convertDate($model->date, 'l, j F Y', 'Y-m-d');
			if($model->save()){
				$modelDebit = new DetailJournal;
				$modelCredit = new DetailJournal;
				
				$modelDebit->journal_id = $model->journal_id;
				$modelDebit->coa_code = $model->debit;
				$modelDebit->debit = preg_replace("/[^0-9.]/", "", $model->balance);
				$modelDebit->debit =(double)$modelDebit->debit;
				
				$modelCredit->journal_id = $model->journal_id;
				$modelCredit->coa_code = $model->credit;
				$modelCredit->credit = preg_replace("/[^0-9.]/", "", $model->balance);
				$modelCredit->credit =(double)$modelCredit->credit;
				
				if($modelDebit->save()){
					if(!$modelCredit->save()){
						$model->delete();
						$modelDebit->delete();
						$save_state = false;
					}
				}
				else{
					$model->delete();
					$save_state = false;
				}
			}else
				$save_state = false;
			if($save_state){
				$temp_date = $model->date;
				$model = new Journal(['scenario'=>'generalJournal']);
				$model->date = $temp_date;
			}
        }
		$model->date = strftime("%A, %e %B %Y", strtotime($model->date));
		//$model->debit->attributes->label = 'debit';
        return $this->render('general', [
            'model' => $model, 'dataCoa' => $dataCoa,
        ]);
    }
    /**
     * Updates an existing Journal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /**
     * Deletes an existing Journal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
	public function actionGet_journal_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			
			$dataItem = Journal::find()
			->where(['like','transaction_code', $data['jurnal_code'].'%', false])
			->andWhere(['>=', 'date', date('Y-m-d',strtotime($data['start_date']))])
			->andWhere(['<=', 'date', date('Y-m-d',strtotime($data['end_date']))])
			->with(['detailJournals.coaCode'])
			->orderBy(['date' => SORT_ASC])
			->asArray()
			->all();

			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataItem;
		}
    }
	public function actionGet_generate_journal_ajax()
    {
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			
			$model = Journal::find()->where(['like','transaction_code', $data['transaction_code'].'/%/'.date('m').'/'.date('y'), false])->count()+1;
			$noJournal="";
			$transactionCode="";
			if($model < 10){
				$noJournal = "000".(string)$model;
			}else if($model < 100){
				$noJournal = "00".(string)$model;
			}else if($model < 1000){
				$noJournal = "0".(string)$model;
			}else{
				$noJournal = (string)$model;
			}
			$transactionCode = $data['transaction_code'].'/'.$noJournal.'/'.date('m').'/'.date('y');
			$dataJournal = [
				'noJournal' => $noJournal,
				'transactionCode' => $transactionCode,
				'month' => date('m'),
				'year' => date('y'),
			];	
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $dataJournal;
		  }
    }
    /**
     * Finds the Journal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Journal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Journal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
