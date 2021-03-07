<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_purchase_order".
 *
 * @property int $detail_po_id
 * @property string $item_id
 * @property string $po_id
 * @property int|null $qty
 * @property float|null $price
 * @property float|null $subtotal
 *
 * @property Item $item
 * @property PurchaseOrder $po
 */
class DetailPurchaseOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_purchase_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'po_id'], 'required'],
            [['qty'], 'integer'],
            [['price', 'subtotal'], 'number'],
            [['item_id'], 'string', 'max' => 20],
            [['po_id'], 'string', 'max' => 50],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'item_id']],
            [['po_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrder::className(), 'targetAttribute' => ['po_id' => 'po_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detail_po_id' => 'Detail Po ID',
            'item_id' => 'Item ID',
            'po_id' => 'Po ID',
            'qty' => 'Qty',
            'price' => 'Price',
            'subtotal' => 'Subtotal',
        ];
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
	public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['unit_id' => 'unit_id'])
		->via('item');
    }
    /**
     * Gets query for [[Po]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPo()
    {
        return $this->hasOne(PurchaseOrder::className(), ['po_id' => 'po_id']);
    }
}
