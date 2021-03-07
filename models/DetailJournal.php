<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_journal".
 *
 * @property int $detail_journal_id
 * @property string $coa_code
 * @property int $journal_id
 * @property float|null $debit
 * @property float|null $credit
 *
 * @property Coa $coaCode
 * @property Journal $journal
 */
class DetailJournal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_journal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coa_code', 'journal_id'], 'required'],
            [['journal_id'], 'integer'],
            [['debit', 'credit'], 'number'],
            [['coa_code'], 'string', 'max' => 20],
            [['coa_code'], 'exist', 'skipOnError' => true, 'targetClass' => Coa::className(), 'targetAttribute' => ['coa_code' => 'coa_code']],
            [['journal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Journal::className(), 'targetAttribute' => ['journal_id' => 'journal_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detail_journal_id' => 'Detail Journal ID',
            'coa_code' => 'Coa Code',
            'journal_id' => 'Journal ID',
            'debit' => 'Debit',
            'credit' => 'Credit',
        ];
    }

    /**
     * Gets query for [[CoaCode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoaCode()
    {
        return $this->hasOne(Coa::className(), ['coa_code' => 'coa_code']);
    }

    /**
     * Gets query for [[Journal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJournal()
    {
        return $this->hasOne(Journal::className(), ['journal_id' => 'journal_id']);
    }
}
