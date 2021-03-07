<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_sales_payment".
 *
 * @property int $detail_sales_payment_id
 * @property string $sales_payment_id
 * @property string $sales_id
 * @property float $discount
 * @property float $subtotal
 *
 * @property Sales $sales
 * @property SalesPayment $salesPayment
 */
class DetailSalesPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_sales_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sales_payment_id', 'sales_id', 'subtotal'], 'required'],
            [['discount', 'subtotal'], 'number'],
            [['sales_payment_id', 'sales_id'], 'string', 'max' => 50],
            [['sales_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::className(), 'targetAttribute' => ['sales_id' => 'sales_id']],
            [['sales_payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalesPayment::className(), 'targetAttribute' => ['sales_payment_id' => 'sales_payment_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detail_sales_payment_id' => 'Detail Sales Payment ID',
            'sales_payment_id' => 'Sales Payment ID',
            'sales_id' => 'Sales ID',
            'discount' => 'Discount',
            'subtotal' => 'Subtotal',
        ];
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasOne(Sales::className(), ['sales_id' => 'sales_id']);
    }

    /**
     * Gets query for [[SalesPayment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesPayment()
    {
        return $this->hasOne(SalesPayment::className(), ['sales_payment_id' => 'sales_payment_id']);
    }
}
