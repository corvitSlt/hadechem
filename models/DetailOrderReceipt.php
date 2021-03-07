<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_order_receipt".
 *
 * @property int $detail_or_id
 * @property string $or_id
 * @property string $item_id
 * @property int $warehouse_id
 * @property int $qty_order
 * @property int $qty
 *
 * @property OrderReceipt $or
 * @property Item $item
 * @property Warehouse $warehouse
 */
class DetailOrderReceipt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_order_receipt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['or_id', 'item_id', 'warehouse_id', 'qty_order', 'qty'], 'required'],
            [['warehouse_id', 'qty_order', 'qty'], 'integer'],
            [['or_id'], 'string', 'max' => 50],
            [['item_id'], 'string', 'max' => 20],
            [['or_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderReceipt::className(), 'targetAttribute' => ['or_id' => 'or_id']],
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
            'detail_or_id' => 'Detail Or ID',
            'or_id' => 'Or ID',
            'item_id' => 'Item ID',
            'warehouse_id' => 'Warehouse ID',
            'qty_order' => 'Qty Order',
            'qty' => 'Qty',
        ];
    }

    /**
     * Gets query for [[Or]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOr()
    {
        return $this->hasOne(OrderReceipt::className(), ['or_id' => 'or_id']);
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
