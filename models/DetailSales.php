<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_sales".
 *
 * @property int $detail_sales_id
 * @property string $sales_id
 * @property string $item_id
 * @property float $price
 * @property int $qty
 * @property float $subtotal
 *
 * @property Item $item
 * @property Sales $sales
 */
class DetailSales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_sales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sales_id', 'item_id', 'price', 'qty', 'subtotal'], 'required'],
            [['price', 'subtotal'], 'number'],
            [['qty'], 'integer'],
            [['sales_id'], 'string', 'max' => 50],
            [['item_id'], 'string', 'max' => 20],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'item_id']],
            [['sales_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::className(), 'targetAttribute' => ['sales_id' => 'sales_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detail_sales_id' => 'Detail Sales ID',
            'sales_id' => 'Sales ID',
            'item_id' => 'Item ID',
            'price' => 'Price',
            'qty' => 'Qty',
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

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasOne(Sales::className(), ['sales_id' => 'sales_id']);
    }
}
