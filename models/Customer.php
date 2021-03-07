<?php

namespace app\models;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property string $customer_id
 * @property string $village_id
 * @property string $village_bill_id
 * @property string $customer_name
 * @property string $id_card_number
 * @property string $address
 * @property string|null $bill_address
 * @property string $phone_number
 * @property string|null $fax_number
 * @property string|null $email
 * @property string $id_card_image
 * @property float $limit_amount
 * @property int $flag
 *
 * @property Village $villageBill
 * @property Village $village
 * @property DetailCustomerBank[] $detailCustomerBanks
 * @property Sales[] $sales
 * @property SalesOrder[] $salesOrders
 */
class Customer extends \yii\db\ActiveRecord
{
	public $province;
	public $regency;
	public $district;
	public $bill_province;
	public $bill_regency;
	public $bill_district;
	public $same_address;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'village_id', 'customer_name', 'id_card_number', 'address', 'phone_number', 'limit_amount', 'province', 'district', 'regency'], 'required',  'message' => '* {attribute} tidak boleh kosong!'],
			[['bill_address', 'village_bill_id', 'bill_province', 'bill_district', 'bill_regency'], 'required', 'when' => function($model) {return $model->same_address == 0;},
				'whenClient' => "function (attribute, value) {
					return $('#customer-same_address').is(':checked') == false;
				}",  'message' => '* {attribute} tidak boleh kosong!'],
			[['address', 'bill_address'], 'string'],
            [['flag', 'same_address'], 'integer'],
            [['customer_id', 'id_card_number', 'npwp_number', 'phone_number'], 'string', 'max' => 20],
            [['village_id', 'village_bill_id'], 'string', 'max' => 10],
            [['customer_name'], 'string', 'max' => 50],
            [['fax_number'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 100],
            [['customer_id'], 'unique'],
			[['id_card_image'], 'unique'],
			[['id_card_image', 'npwp_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpeg, jpg', 'mimeTypes' => 'image/png, image/jpeg, image/jpg'],
            [['village_bill_id'], 'exist', 'skipOnError' => true, 'targetClass' => Village::className(), 'targetAttribute' => ['village_bill_id' => 'village_id']],
            [['village_id'], 'exist', 'skipOnError' => true, 'targetClass' => Village::className(), 'targetAttribute' => ['village_id' => 'village_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'ID Pelanggan',
            'village_id' => 'Desa',
            'village_bill_id' => 'Desa',
            'customer_name' => 'Nama Pelanggan',
            'id_card_number' => 'NIK (KTP)',
			'npwp_number' => 'No NPWP',
            'address' => 'Alamat Lengkap',
            'bill_address' => 'Alamat Lengkap',
            'phone_number' => 'No HP/Telp',
            'fax_number' => 'Nomor Fax',
            'email' => 'Email',
            'id_card_image' => 'Foto KTP Pelanggan',
			'npwp_image' => 'Foto NPWP Pelanggan',
            'limit_amount' => 'Batas Order',
            'flag' => 'Status',
			'province' => 'Provinsi',
			'regency' => 'Kota/Kabupaten',
			'district' => 'Kecamatan',
			'bill_province' => 'Provinsi',
			'bill_regency' => 'Kota/Kabupaten',
			'bill_district' => 'Kecamatan',
			'same_address' => 'Alamat penagihan sama dengan alamat rumah/kantor'
        ];
    }
	public function upload()
    {
        if ($this->validate()) {
			if($this->id_card_image)
				$this->id_card_image->saveAs('cusIdImages/' . $this->customer_id . '-card.' . $this->id_card_image->extension);
			if($this->npwp_image)
				$this->npwp_image->saveAs('cusNPWPImages/' . $this->customer_id . '-npwp.' . $this->npwp_image->extension);
            return true;
        } else {
            return false;
        }
    }
    /**
     * Gets query for [[VillageBill]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVillageBill()
    {
        return $this->hasOne(Village::className(), ['village_id' => 'village_bill_id']);
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
     * Gets query for [[DetailCustomerBanks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailCustomerBanks()
    {
        return $this->hasMany(DetailCustomerBank::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sales::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * Gets query for [[SalesOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesOrders()
    {
        return $this->hasMany(SalesOrder::className(), ['customer_id' => 'customer_id']);
    }
}
