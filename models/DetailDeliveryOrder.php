<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_delivery_order".
 *
 * @property int $detail_delivery_order_id
 * @property string $item_id
 * @property string $delivery_order_id
 * @property int $warehouse_id
 * @property int $qty_so
 * @property int $qty
 *
 * @property DeliveryOrder $deliveryOrder
 * @property Item $item
 * @property Warehouse $warehouse
 */
class DetailDeliveryOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_delivery_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'delivery_order_id', 'warehouse_id', 'qty_so', 'qty'], 'required'],
            [['warehouse_id', 'qty_so', 'qty'], 'integer'],
            [['item_id', 'delivery_order_id'], 'string', 'max' => 20],
            [['delivery_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeliveryOrder::className(), 'targetAttribute' => ['delivery_order_id' => 'delivery_order_id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'item_id']],
            [['warehouse_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['warehouse_id' => 'warehouse_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detail_delivery_order_id' => 'Detail Delivery Order ID',
            'item_id' => 'Item ID',
            'delivery_order_id' => 'Delivery Order ID',
            'warehouse_id' => 'Warehouse ID',
            'qty_so' => 'Qty So',
            'qty' => 'Qty',
        ];
    }

    /**
     * Gets query for [[DeliveryOrder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryOrder()
    {
        return $this->hasOne(DeliveryOrder::className(), ['delivery_order_id' => 'delivery_order_id']);
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
     * Gets query for [[Warehouse]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['warehouse_id' => 'warehouse_id']);
    }
}
