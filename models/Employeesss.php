<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property string $employee_id
 * @property int $setting_id
 * @property int $job_id
 * @property string $village_id
 * @property string $username
 * @property string $employee_name
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
 * @property string|null $id_card_image
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
class Employee extends \yii\db\ActiveRecord
{
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
            [['employee_id', 'setting_id', 'job_id', 'village_id', 'username', 'employee_name', 'id_card_number', 'birth_date', 'birth_place', 'address', 'email', 'phone_number', 'work_date', 'education', 'password', 'saltpassword', 'salary'], 'required'],
            [['setting_id', 'job_id', 'flag'], 'integer'],
            [['birth_date', 'work_date', 'last_login', 'last_password_change'], 'safe'],
            [['address', 'bachelor'], 'string'],
            [['salary'], 'number'],
            [['employee_id', 'id_card_number', 'phone_number'], 'string', 'max' => 20],
            [['village_id'], 'string', 'max' => 10],
            [['username'], 'string', 'max' => 25],
            [['employee_name', 'email', 'password', 'saltpassword'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 1],
            [['birth_place', 'image', 'id_card_image'], 'string', 'max' => 100],
            [['education'], 'string', 'max' => 5],
            [['auth_key'], 'string', 'max' => 225],
            [['username'], 'unique'],
            [['image'], 'unique'],
            [['id_card_image'], 'unique'],
            [['employee_id'], 'unique'],
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
            'employee_id' => 'Employee ID',
            'setting_id' => 'Setting ID',
            'job_id' => 'Job ID',
            'village_id' => 'Village ID',
            'username' => 'Username',
            'employee_name' => 'Employee Name',
            'id_card_number' => 'Id Card Number',
            'gender' => 'Gender',
            'birth_date' => 'Birth Date',
            'birth_place' => 'Birth Place',
            'address' => 'Address',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'work_date' => 'Work Date',
            'education' => 'Education',
            'bachelor' => 'Bachelor',
            'password' => 'Password',
            'saltpassword' => 'Saltpassword',
            'image' => 'Image',
            'id_card_image' => 'Id Card Image',
            'salary' => 'Salary',
            'auth_key' => 'Auth Key',
            'last_login' => 'Last Login',
            'last_password_change' => 'Last Password Change',
            'flag' => 'Flag',
        ];
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
}
