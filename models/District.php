<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property string $district_id
 * @property string $regency_id
 * @property string $district_name
 *
 * @property Regency $regency
 * @property Village[] $villages
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['district_id', 'regency_id', 'district_name'], 'required'],
            [['district_id'], 'string', 'max' => 7],
            [['regency_id'], 'string', 'max' => 4],
            [['district_name'], 'string', 'max' => 255],
            [['district_id'], 'unique'],
            [['regency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regency::className(), 'targetAttribute' => ['regency_id' => 'regency_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'district_id' => 'District ID',
            'regency_id' => 'Regency ID',
            'district_name' => 'District Name',
        ];
    }

    /**
     * Gets query for [[Regency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegency()
    {
        return $this->hasOne(Regency::className(), ['regency_id' => 'regency_id']);
    }

    /**
     * Gets query for [[Villages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVillages()
    {
        return $this->hasMany(Village::className(), ['district_id' => 'district_id']);
    }
}
