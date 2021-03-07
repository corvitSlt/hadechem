<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_sales_order".
 *
 * @property int $detail_so_id
 * @property string $item_id
 * @property string $so_id
 * @property int $qty
 * @property float $price
 * @property float $subtotal
 *
 * @property Item $item
 * @property SalesOrder $so
 */
class DetailSalesOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_sales_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'so_id', 'qty', 'price', 'subtotal'], 'required'],
            [['qty'], 'integer'],
            [['price', 'subtotal'], 'number'],
            [['item_id'], 'string', 'max' => 20],
            [['so_id'], 'string', 'max' => 50],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'item_id']],
            [['so_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalesOrder::className(), 'targetAttribute' => ['so_id' => 'so_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detail_so_id' => 'Detail So ID',
            'item_id' => 'Item ID',
            'so_id' => 'So ID',
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
     * Gets query for [[So]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSo()
    {
        return $this->hasOne(SalesOrder::className(), ['so_id' => 'so_id']);
    }
}
