<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property string $item_id
 * @property string $sub_item_category_id
 * @property int $unit_id
 * @property string $item_name
 * @property float $price
 * @property int|null $total_stock
 * @property int|null $safe_stock
 * @property int|null $delivery_time
 * @property int|null $status
 *
 * @property DetailDeliveryOrder[] $detailDeliveryOrders
 * @property DetailOrderReceipt[] $detailOrderReceipts
 * @property DetailPurchase[] $detailPurchases
 * @property DetailPurchaseOrder[] $detailPurchaseOrders
 * @property DetailPurchaseRequest[] $detailPurchaseRequests
 * @property DetailSales[] $detailSales
 * @property DetailSalesOrder[] $detailSalesOrders
 * @property SubItemCategory $subItemCategory
 * @property Unit $unit
 * @property StockCard[] $stockCards
 * @property WarehouseStock[] $warehouseStocks
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'sub_item_category_id', 'unit_id', 'item_name', 'price'], 'required'],
            [['unit_id', 'total_stock', 'safe_stock', 'delivery_time', 'status'], 'integer'],
            [['item_id', 'sub_item_category_id'], 'string', 'max' => 20],
            [['item_name'], 'string', 'max' => 50],
            [['item_name'], 'unique'],
            [['item_id'], 'unique'],
            [['sub_item_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubItemCategory::className(), 'targetAttribute' => ['sub_item_category_id' => 'sub_item_category_id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::className(), 'targetAttribute' => ['unit_id' => 'unit_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'sub_item_category_id' => 'Sub Item Category ID',
            'unit_id' => 'Unit ID',
            'item_name' => 'Item Name',
            'price' => 'Price',
            'total_stock' => 'Total Stock',
            'safe_stock' => 'Safe Stock',
            'delivery_time' => 'Delivery Time',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[DetailDeliveryOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailDeliveryOrders()
    {
        return $this->hasMany(DetailDeliveryOrder::className(), ['item_id' => 'item_id']);
    }

    /**
     * Gets query for [[DetailOrderReceipts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailOrderReceipts()
    {
        return $this->hasMany(DetailOrderReceipt::className(), ['item_id' => 'item_id']);
    }

    /**
     * Gets query for [[DetailPurchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPurchases()
    {
        return $this->hasMany(DetailPurchase::className(), ['item_id' => 'item_id']);
    }

    /**
     * Gets query for [[DetailPurchaseOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPurchaseOrders()
    {
        return $this->hasMany(DetailPurchaseOrder::className(), ['item_id' => 'item_id']);
    }

    /**
     * Gets query for [[DetailPurchaseRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPurchaseRequests()
    {
        return $this->hasMany(DetailPurchaseRequest::className(), ['item_id' => 'item_id']);
    }

    /**
     * Gets query for [[DetailSales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailSales()
    {
        return $this->hasMany(DetailSales::className(), ['item_id' => 'item_id']);
    }

    /**
     * Gets query for [[DetailSalesOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailSalesOrders()
    {
        return $this->hasMany(DetailSalesOrder::className(), ['item_id' => 'item_id']);
    }

    /**
     * Gets query for [[SubItemCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubItemCategory()
    {
        return $this->hasOne(SubItemCategory::className(), ['sub_item_category_id' => 'sub_item_category_id']);
    }

    /**
     * Gets query for [[Unit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['unit_id' => 'unit_id']);
    }

    /**
     * Gets query for [[StockCards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStockCards()
    {
        return $this->hasMany(StockCard::className(), ['item_id' => 'item_id']);
    }

    /**
     * Gets query for [[WarehouseStocks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseStocks()
    {
        return $this->hasMany(WarehouseStock::className(), ['item_id' => 'item_id']);
    }
}
