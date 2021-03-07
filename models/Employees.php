<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property string $employee_id
 * @property int $setting_id
 * @property int $job_id
 * @property string $employee_name
 * @property string|null $username
 * @property string $id_card_number
 * @property string $gender
 * @property string $birth_date
 * @property string $birth_place
 * @property string $address
 * @property string $email
 * @property string|null $phone_number
 * @property string $work_date
 * @property string $education
 * @property string|null $bachelor
 * @property string $password
 * @property string $saltpassword
 * @property string|null $image
 * @property float $salary
 * @property string|null $last_login
 * @property string|null $last_password_change
 * @property string|null $auth_key
 * @property int $flag
 *
 * @property Job $job
 * @property Setting $setting
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
            [['employee_id', 'setting_id', 'job_id', 'employee_name', 'id_card_number', 'gender', 'birth_date', 'birth_place', 'village_id', 'address', 'email', 'work_date', 'education', 'password', 'saltpassword', 'salary'], 'required', 'message' => '* {attribute} tidak boleh kosong!'],
            [['setting_id', 'job_id', 'flag'], 'integer'],
            [['birth_date', 'work_date', 'last_login', 'last_password_change'], 'safe'],
            [['address', 'bachelor'], 'string'],
			[['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpeg, jpg', 'mimeTypes' => 'image/png, image/jpeg, image/jpg',],
            [['employee_id', 'id_card_number', 'phone_number'], 'string', 'max' => 20],
            [['employee_name', 'email', 'password', 'saltpassword'], 'string', 'max' => 50],
            [['username'], 'string', 'max' => 25],
            [['gender'], 'string', 'max' => 1],
            [['birth_place'], 'string', 'max' => 100],
            [['education'], 'string', 'max' => 5],
            [['auth_key'], 'string', 'max' => 225],
            [['employee_name'], 'unique'],
            [['employee_id'], 'unique'],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Job::className(), 'targetAttribute' => ['job_id' => 'job_id']],
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
            'salary' => 'Gaji Pegawai',
			'auth_key' => 'auth_key',
            'last_login' => 'Login Terakhir',
			'last_password_change' => 'Tgl Terakhir Ganti Password',
            'flag' => 'Status',
        ];
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
     * Gets query for [[Setting]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSetting()
    {
        return $this->hasOne(Setting::className(), ['setting_id' => 'setting_id']);
    }
	
	 /**
	 * @return int|string current user ID
	 */
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
