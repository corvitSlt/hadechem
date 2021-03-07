<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_customer_bank".
 *
 * @property int $det_cus_bank_id
 * @property int $bank_id
 * @property string $customer_id
 * @property string $account_number
 * @property string $account_name
 *
 * @property Bank $bank
 * @property Customer $customer
 */
class DetailCustomerBank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_customer_bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_id', 'customer_id', 'account_number', 'account_name'], 'required'],
            [['bank_id'], 'integer'],
            [['customer_id', 'account_number', 'account_name'], 'string', 'max' => 20],
            [['bank_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bank::className(), 'targetAttribute' => ['bank_id' => 'bank_id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'det_cus_bank_id' => 'Det Cus Bank ID',
            'bank_id' => 'Bank ID',
            'customer_id' => 'Customer ID',
            'account_number' => 'Account Number',
            'account_name' => 'Account Name',
        ];
    }

    /**
     * Gets query for [[Bank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(Bank::className(), ['bank_id' => 'bank_id']);
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }
}
