<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_purchase_payment".
 *
 * @property int $detail_purchase_payment_id
 * @property string $purchase_payment_id
 * @property string $purchase_id
 * @property float $discount
 * @property float $subtotal
 *
 * @property Purchase $purchase
 * @property PurchasePayment $purchasePayment
 */
class DetailPurchasePayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_purchase_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purchase_payment_id', 'purchase_id', 'subtotal'], 'required'],
            [['discount', 'subtotal'], 'number'],
            [['purchase_payment_id', 'purchase_id'], 'string', 'max' => 50],
            [['purchase_id'], 'exist', 'skipOnError' => true, 'targetClass' => Purchase::className(), 'targetAttribute' => ['purchase_id' => 'purchase_id']],
            [['purchase_payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchasePayment::className(), 'targetAttribute' => ['purchase_payment_id' => 'purchase_payment_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detail_purchase_payment_id' => 'Detail Purchase Payment ID',
            'purchase_payment_id' => 'Purchase Payment ID',
            'purchase_id' => 'Purchase ID',
            'discount' => 'Discount',
            'subtotal' => 'Subtotal',
        ];
    }

    /**
     * Gets query for [[Purchase]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchase()
    {
        return $this->hasOne(Purchase::className(), ['purchase_id' => 'purchase_id']);
    }

    /**
     * Gets query for [[PurchasePayment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchasePayment()
    {
        return $this->hasOne(PurchasePayment::className(), ['purchase_payment_id' => 'purchase_payment_id']);
    }
}
