<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "province".
 *
 * @property string $province_id
 * @property string $province_name
 *
 * @property Regency[] $regencies
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['province_id', 'province_name'], 'required'],
            [['province_id'], 'string', 'max' => 2],
            [['province_name'], 'string', 'max' => 255],
            [['province_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'province_id' => 'Province ID',
            'province_name' => 'Province Name',
        ];
    }

    /**
     * Gets query for [[Regencies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegencies()
    {
        return $this->hasMany(Regency::className(), ['province_id' => 'province_id']);
    }
}
