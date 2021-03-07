<?php

namespace app\models;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property string $employee_id
 * @property int $setting_id
 * @property int $job_id
 * @property string $village_id
 * @property string $username
 * @property string|null $employee_name
 * @property string $id_card_number
 * @property string $gender
 * @property string $birth_date
 * @property string $birth_place
 * @property string $address
 * @property string $email
 * @property string $phone_number
 * @property string $work_date
 * @property string $education
 * @property string|null $bachelor
 * @property string $password
 * @property string $saltpassword
 * @property string|null $image
 * @property float $salary
 * @property string|null $auth_key
 * @property string|null $last_login
 * @property string|null $last_password_change
 * @property int|null $flag
 *
 * @property DeliveryOrder[] $deliveryOrders
 * @property Job $job
 * @property Village $village
 * @property Setting $setting
 * @property OrderReceipt[] $orderReceipts
 * @property Purchase[] $purchases
 * @property PurchaseOrder[] $purchaseOrders
 * @property PurchaseRequest[] $purchaseRequests
 * @property Sales[] $sales
 * @property SalesOrder[] $salesOrders
 */
class Employee extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
	public $province;
	public $regency;
	public $district;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'setting_id', 'job_id', 'village_id', 'username', 'employee_name', 'id_card_number', 'birth_date', 'birth_place', 'address', 'phone_number', 'work_date', 'password', 'saltpassword', 'salary'], 'required',  'message' => '* {attribute} tidak boleh kosong!'],
			[['province', 'district', 'regency'], 'required',  'message' => '* {attribute} tidak boleh kosong!', 'on' => ['create', 'update', 'afterCreateUpload']],
			[['image'], 'required',  'message' => '* {attribute} tidak boleh kosong!', 'on' => ['create', 'afterCreateUpload']],
            [['setting_id', 'job_id', 'flag'], 'integer'],
            [['birth_date', 'work_date', 'last_login', 'last_password_change'], 'safe'],
            [['address', 'bachelor'], 'string'],
            [['employee_id', 'id_card_number', 'phone_number'], 'string', 'max' => 20],
            [['village_id'], 'string', 'max' => 10],
            [['username'], 'string', 'max' => 25],
            [['employee_name', 'email', 'password', 'saltpassword'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 1],
            [['birth_place'], 'string', 'max' => 100],
            [['education'], 'string', 'max' => 5],
            [['auth_key'], 'string', 'max' => 225],
			[['username'], 'unique'],
            [['image'], 'unique'],
            [['id_card_image'], 'unique'],
            [['employee_id'], 'unique'],
			[['image', 'id_card_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpeg, jpg', 'mimeTypes' => 'image/png, image/jpeg, image/jpg'],
			[['profil_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpeg, jpg', 'mimeTypes' => 'image/png, image/jpeg, image/jpg'],
			[['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpeg, jpg', 'mimeTypes' => 'image/png, image/jpeg, image/jpg', 'on' => 'create'],
			[['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpeg, jpg', 'mimeTypes' => 'image/png, image/jpeg, image/jpg', 'on' => 'afterCreateUpload'],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Job::className(), 'targetAttribute' => ['job_id' => 'job_id']],
            [['village_id'], 'exist', 'skipOnError' => true, 'targetClass' => Village::className(), 'targetAttribute' => ['village_id' => 'village_id']],
            [['setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => Setting::className(), 'targetAttribute' => ['setting_id' => 'setting_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'ID Pegawai',
            'setting_id' => 'ID Setting',
            'job_id' => 'Pekerjaan',
			'username' => 'Username',
            'employee_name' => 'Nama Pegawai',
			'id_card_number' => 'NIK (KTP)',
            'gender' => 'Jenis Kelamin',
            'birth_date' => 'Tanggal Lahir',
            'birth_place' => 'Tempat Lahir',
            'address' => 'Alamat Lengkap',
			'email' => 'Email',
            'phone_number' => 'No HP/Telp',
            'work_date' => 'Tanggal Mulai Kerja',
            'education' => 'Pendidikan',
			'bachelor' => 'Bidang/Jurusan',
            'password' => 'Password',
            'saltpassword' => 'Saltpassword',
            'image' => 'Foto Pegawai',
			'id_card_image' => 'Foto KTP Pegawai',
            'salary' => 'Gaji Pegawai',
			'auth_key' => 'auth_key',
            'last_login' => 'Login Terakhir',
			'last_password_change' => 'Tgl Terakhir Ganti Password',
            'flag' => 'Status',
			'village_id' => 'Desa',
			'province' => 'Provinsi',
			'regency' => 'Kota/Kabupaten',
			'district' => 'Kecamatan'
        ];
    }
	
	public function upload()
    {
        if ($this->validate()) {
			if($this->image)
				$this->image->saveAs('empImages/' . $this->employee_id . '.' . $this->image->extension);
			if($this->id_card_image)
				$this->id_card_image->saveAs('empIdImages/' . $this->employee_id . '-card.' . $this->id_card_image->extension);
            return true;
        } else {
            return false;
        }
    }
    /**
     * Gets query for [[DeliveryOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryOrders()
    {
        return $this->hasMany(DeliveryOrder::className(), ['employee_id' => 'employee_id']);
    }

    /**
     * Gets query for [[Job]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Job::className(), ['job_id' => 'job_id']);
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
     * Gets query for [[Setting]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSetting()
    {
        return $this->hasOne(Setting::className(), ['setting_id' => 'setting_id']);
    }

    /**
     * Gets query for [[OrderReceipts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderReceipts()
    {
        return $this->hasMany(OrderReceipt::className(), ['employee_id' => 'employee_id']);
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::className(), ['employee_id' => 'employee_id']);
    }

    /**
     * Gets query for [[PurchaseOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['employee_id' => 'employee_id']);
    }

    /**
     * Gets query for [[PurchaseRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequests()
    {
        return $this->hasMany(PurchaseRequest::className(), ['employee_id' => 'employee_id']);
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sales::className(), ['employee_id' => 'employee_id']);
    }

    /**
     * Gets query for [[SalesOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesOrders()
    {
        return $this->hasMany(SalesOrder::className(), ['employee_id' => 'employee_id']);
    }
	public static function findIdentity($id)
    {
        return static::findOne($id);
    }
	
	/**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
	public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
	
	/**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
	
	/**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->employee_id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
	
	public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }
	
	public function validatePassword($password) 
	{ 
		return $this->hashPassword($password,$this->saltpassword)===$this->password; 
	} 
	
	public function hashPassword($password,$salt) 
	{ 
		return md5($salt.$password); 
	} 
	
	public function generateSalt() 
	{ 
		return uniqid('',true); 
	}
}
