<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "warehouse_stock".
 *
 * @property int $ws_id
 * @property string $item_id
 * @property int $warehouse_id
 * @property int|null $stock
 *
 * @property Item $item
 * @property Warehouse $warehouse
 */
class WarehouseStock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse_stock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'warehouse_id'], 'required'],
            [['warehouse_id', 'stock'], 'integer'],
            [['item_id'], 'string', 'max' => 20],
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
            'ws_id' => 'Ws ID',
            'item_id' => 'Item ID',
            'warehouse_id' => 'Warehouse ID',
            'stock' => 'Stock',
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
