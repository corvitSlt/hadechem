<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "village".
 *
 * @property string $village_id
 * @property string $district_id
 * @property string $village_name
 *
 * @property Customer[] $customers
 * @property Supplier[] $suppliers
 * @property District $district
 */
class Village extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'village';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['village_id', 'district_id', 'village_name'], 'required'],
            [['village_id'], 'string', 'max' => 10],
            [['district_id'], 'string', 'max' => 7],
            [['village_name'], 'string', 'max' => 255],
            [['village_id'], 'unique'],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district_id' => 'district_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'village_id' => 'Village ID',
            'district_id' => 'District ID',
            'village_name' => 'Village Name',
        ];
    }

    /**
     * Gets query for [[Customers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['village_id' => 'village_id']);
    }

    /**
     * Gets query for [[Suppliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasMany(Supplier::className(), ['village_id' => 'village_id']);
    }

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['district_id' => 'district_id']);
    }
}
