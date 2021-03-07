<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "voucher".
 *
 * @property int $voucher_id
 * @property string $customer_id
 * @property float $discount
 * @property int $discount_type
 * @property string $date
 * @property string $valid_date
 * @property string|null $exp_date
 * @property int $status
 *
 * @property Customer $customer
 */
class Voucher extends \yii\db\ActiveRecord
{
	public $customer_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'voucher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'discount', 'date', 'valid_date'], 'required'],
            [['discount'], 'number'],
            [['discount_type', 'status'], 'integer'],
            [['date', 'valid_date', 'exp_date'], 'safe'],
            [['customer_id'], 'string', 'max' => 20],
			[['customer_name'], 'string', 'max' => 100],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'voucher_id' => 'Voucher ID',
            'customer_id' => 'Customer ID',
            'discount' => 'Discount',
            'discount_type' => 'Discount Type',
            'date' => 'Date',
            'valid_date' => 'Valid Date',
            'exp_date' => 'Exp Date',
            'status' => 'Status',
        ];
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
