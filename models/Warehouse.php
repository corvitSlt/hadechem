<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "warehouse".
 *
 * @property int $warehouse_id
 * @property string $village_id
 * @property string $warehouse_name
 * @property string $address
 * @property int $flag
 *
 * @property DetailDeliveryOrder[] $detailDeliveryOrders
 * @property DetailOrderReceipt[] $detailOrderReceipts
 * @property StockCard[] $stockCards
 * @property Village $village
 * @property WarehouseStock[] $warehouseStocks
 */
class Warehouse extends \yii\db\ActiveRecord
{
	public $province;
	public $regency;
	public $district;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['village_id', 'warehouse_name', 'address'], 'required',  'message' => '* {attribute} tidak boleh kosong!'],
			[['province', 'district', 'regency'], 'required',  'message' => '* {attribute} tidak boleh kosong!'],
            [['address'], 'string'],
            [['flag'], 'integer'],
            [['village_id'], 'string', 'max' => 10],
            [['warehouse_name'], 'string', 'max' => 50],
            [['warehouse_name'], 'unique'],
            [['village_id'], 'exist', 'skipOnError' => true, 'targetClass' => Village::className(), 'targetAttribute' => ['village_id' => 'village_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'warehouse_id' => 'Kode Gudang',
            'village_id' => 'Village ID',
            'warehouse_name' => 'Nama Gudang',
            'address' => 'Alamat',
            'flag' => 'Status',
        ];
    }

    /**
     * Gets query for [[DetailDeliveryOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailDeliveryOrders()
    {
        return $this->hasMany(DetailDeliveryOrder::className(), ['warehouse_id' => 'warehouse_id']);
    }

    /**
     * Gets query for [[DetailOrderReceipts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailOrderReceipts()
    {
        return $this->hasMany(DetailOrderReceipt::className(), ['warehouse_id' => 'warehouse_id']);
    }

    /**
     * Gets query for [[StockCards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStockCards()
    {
        return $this->hasMany(StockCard::className(), ['warehouse_id' => 'warehouse_id']);
    }

    /**
     * Gets query for [[Village]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVillage()
    {
        return $this->hasOne(Village::className(), ['village_id' => 'village_id']);
    }

    /**
     * Gets query for [[WarehouseStocks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseStocks()
    {
        return $this->hasMany(WarehouseStock::className(), ['warehouse_id' => 'warehouse_id']);
    }
}
