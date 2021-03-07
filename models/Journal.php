<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "journal".
 *
 * @property int $journal_id
 * @property string|null $transaction_code
 * @property string|null $date
 * @property string $note
 *
 * @property DetailJournal[] $detailJournals
 */
class Journal extends \yii\db\ActiveRecord
{
	public $balance;
	public $debit;
	public $credit;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['note'], 'required'],
			[['note'], 'required', 'on' => 'generalJournal'],
            [['note', 'debit', 'credit', 'balance'], 'string'],
            [['transaction_code'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
		/*$labels = array(
			 'journal_id' => 'Journal ID',
			'transaction_code' => 'Nomor Bukti',
			'date' => 'Tanggal',
			'note' => 'Keterangan',
			'credit' => 'Masuk Dari',
			'debit' => 'Keluar ke',
			'balance' => 'Nominal',
		);*/
		switch($this->scenario)
		{
			case 'generalJournal':
				return array(
					 'journal_id' => 'Journal ID',
					'transaction_code' => 'Nomor Bukti',
					'date' => 'Tanggal',
					'note' => 'Keterangan',
					'credit' => 'Kredit',
					'debit' => 'Debit',
					'balance' => 'Nominal',
				);
				break;
				default: // employers end up here

				return array(

					 'journal_id' => 'Journal ID',
					'transaction_code' => 'Nomor Bukti',
					'date' => 'Tanggal',
					'note' => 'Keterangan',
					'credit' => 'Masuk Dari',
					'debit' => 'Keluar ke',
					'balance' => 'Nominal',

				);
				break;
		}
        /*return [
            'journal_id' => 'Journal ID',
            'transaction_code' => 'Nomor Bukti',
            'date' => 'Tanggal',
            'note' => 'Keterangan',
			'credit' => 'Masuk Dari',
			'debit' => 'Keluar ke',
			'balance' => 'Nominal',
        ];*/
    }
    /**
     * Gets query for [[DetailJournals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailJournals()
    {
        return $this->hasMany(DetailJournal::className(), ['journal_id' => 'journal_id']);
    }

}
