<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property string $supplier_id
 * @property string $village_id
 * @property string $supplier_name
 * @property string $address
 * @property string $phone_number
 * @property string|null $fax_number
 * @property string $contact_name
 * @property string $contact_number
 * @property string|null $email
 * @property int|null $flag
 *
 * @property DetailSupplierBank[] $detailSupplierBanks
 * @property Purchase[] $purchases
 * @property PurchaseOrder[] $purchaseOrders
 * @property PurchaseRequest[] $purchaseRequests
 * @property Village $village
 */
class Supplier extends \yii\db\ActiveRecord
{
	public $province;
	public $regency;
	public $district;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['supplier_id', 'village_id', 'supplier_name', 'address', 'phone_number', 'contact_name', 'contact_number'], 'required'],
			[['province', 'district', 'regency'], 'required',  'message' => '* {attribute} tidak boleh kosong!'],
            [['flag'], 'integer'],
            [['supplier_id', 'npwp_number', 'phone_number', 'contact_number'], 'string', 'max' => 20],
            [['village_id'], 'string', 'max' => 10],
            [['supplier_name', 'contact_name'], 'string', 'max' => 50],
            [['address', 'email'], 'string', 'max' => 100],
            [['fax_number'], 'string', 'max' => 15],
            [['supplier_id'], 'unique'],
			[['npwp_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpeg, jpg', 'mimeTypes' => 'image/png, image/jpeg, image/jpg'],
            [['village_id'], 'exist', 'skipOnError' => true, 'targetClass' => Village::className(), 'targetAttribute' => ['village_id' => 'village_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'supplier_id' => 'Supplier ID',
            'village_id' => 'Village ID',
            'supplier_name' => 'Supplier Name',
            'address' => 'Address',
            'phone_number' => 'Phone Number',
            'fax_number' => 'Fax Number',
            'contact_name' => 'Contact Name',
			'npwp_number' => 'No NPWP',
            'contact_number' => 'Contact Number',
			'npwp_image' => 'Foto NPWP Supplier',
            'email' => 'Email',
            'flag' => 'Flag',
        ];
    }
	
	public function upload()
    {
        if ($this->validate()) {
			if($this->npwp_image)
				$this->npwp_image->saveAs('supNPWPImages/' . $this->supplier_id . '-npwp.' . $this->npwp_image->extension);
            return true;
        } else {
            return false;
        }
    }
    /**
     * Gets query for [[DetailSupplierBanks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailSupplierBanks()
    {
        return $this->hasMany(DetailSupplierBank::className(), ['supplier_id' => 'supplier_id']);
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::className(), ['supplier_id' => 'supplier_id']);
    }

    /**
     * Gets query for [[PurchaseOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['supplier_id' => 'supplier_id']);
    }

    /**
     * Gets query for [[PurchaseRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequests()
    {
        return $this->hasMany(PurchaseRequest::className(), ['supplier_id' => 'supplier_id']);
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
}
