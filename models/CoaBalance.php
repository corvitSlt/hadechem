<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coa_balance".
 *
 * @property int $coa_balance_id
 * @property string $coa_code
 * @property int $period_id
 * @property float|null $beginning_balance
 * @property float|null $ending_balance
 *
 * @property Coa $coaCode
 * @property Period $period
 */
class CoaBalance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coa_balance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coa_balance_id', 'coa_code', 'period_id'], 'required'],
            [['coa_balance_id', 'period_id'], 'integer'],
            [['beginning_balance', 'ending_balance'], 'number'],
            [['coa_code'], 'string', 'max' => 20],
            [['coa_balance_id'], 'unique'],
            [['coa_code'], 'exist', 'skipOnError' => true, 'targetClass' => Coa::className(), 'targetAttribute' => ['coa_code' => 'coa_code']],
            [['period_id'], 'exist', 'skipOnError' => true, 'targetClass' => Period::className(), 'targetAttribute' => ['period_id' => 'period_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'coa_balance_id' => 'Coa Balance ID',
            'coa_code' => 'Coa Code',
            'period_id' => 'Period ID',
            'beginning_balance' => 'Beginning Balance',
            'ending_balance' => 'Ending Balance',
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
     * Gets query for [[Period]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeriod()
    {
        return $this->hasOne(Period::className(), ['period_id' => 'period_id']);
    }
}
