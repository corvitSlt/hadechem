<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "period".
 *
 * @property int $period_id
 * @property string $period_name
 * @property string $beginning_date
 * @property string $ending_date
 * @property int $status
 *
 * @property CoaBalance[] $coaBalances
 */
class Period extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'period';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['period_name', 'beginning_date', 'ending_date', 'status'], 'required'],
            [['beginning_date', 'ending_date'], 'safe'],
            [['status'], 'integer'],
            [['period_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'period_id' => 'Period ID',
            'period_name' => 'Period Name',
            'beginning_date' => 'Beginning Date',
            'ending_date' => 'Ending Date',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[CoaBalances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoaBalances()
    {
        return $this->hasMany(CoaBalance::className(), ['period_id' => 'period_id']);
    }
}
