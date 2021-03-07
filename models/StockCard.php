<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock_card".
 *
 * @property string $stock_card_id
 * @property string $item_id
 * @property int $warehouse_id
 * @property string $trans_id
 * @property string|null $date
 * @property int|null $stock
 * @property float|null $purchase_price
 * @property float|null $seles_price
 * @property string|null $note
 * @property int|null $changes
 *
 * @property Item $item
 * @property Warehouse $warehouse
 */
class StockCard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stock_card_id', 'item_id', 'warehouse_id', 'trans_id'], 'required'],
            [['warehouse_id', 'stock', 'changes'], 'integer'],
            [['date'], 'safe'],
            [['purchase_price', 'seles_price'], 'number'],
            [['note'], 'string'],
            [['stock_card_id', 'trans_id'], 'string', 'max' => 50],
            [['item_id'], 'string', 'max' => 20],
            [['stock_card_id'], 'unique'],
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
            'stock_card_id' => 'Stock Card ID',
            'item_id' => 'Item ID',
            'warehouse_id' => 'Warehouse ID',
            'trans_id' => 'Trans ID',
            'date' => 'Date',
            'stock' => 'Stock',
            'purchase_price' => 'Purchase Price',
            'seles_price' => 'Seles Price',
            'note' => 'Note',
            'changes' => 'Changes',
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
     * Gets query for [[Warehouse]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['warehouse_id' => 'warehouse_id']);
    }
}
