<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_purchase".
 *
 * @property int $detail_purchase_id
 * @property string $item_id
 * @property string $purchase_id
 * @property int|null $qty
 * @property float|null $price
 * @property float|null $subtotal
 *
 * @property Purchase $purchase
 * @property Item $item
 */
class DetailPurchase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_purchase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'purchase_id'], 'required'],
            [['qty'], 'integer'],
            [['price', 'subtotal'], 'number'],
            [['item_id', 'purchase_id'], 'string', 'max' => 20],
            [['purchase_id'], 'exist', 'skipOnError' => true, 'targetClass' => Purchase::className(), 'targetAttribute' => ['purchase_id' => 'purchase_id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'item_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detail_purchase_id' => 'Detail Purchase ID',
            'item_id' => 'Item ID',
            'purchase_id' => 'Purchase ID',
            'qty' => 'Qty',
            'price' => 'Price',
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
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['item_id' => 'item_id']);
    }
}
