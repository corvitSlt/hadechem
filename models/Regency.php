<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "regency".
 *
 * @property string $regency_id
 * @property string $province_id
 * @property string $regency_name
 *
 * @property District[] $districts
 * @property Province $province
 */
class Regency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regency_id', 'province_id', 'regency_name'], 'required'],
            [['regency_id'], 'string', 'max' => 4],
            [['province_id'], 'string', 'max' => 2],
            [['regency_name'], 'string', 'max' => 255],
            [['regency_id'], 'unique'],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['province_id' => 'province_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'regency_id' => 'Regency ID',
            'province_id' => 'Province ID',
            'regency_name' => 'Regency Name',
        ];
    }

    /**
     * Gets query for [[Districts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::className(), ['regency_id' => 'regency_id']);
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['province_id' => 'province_id']);
    }
}
