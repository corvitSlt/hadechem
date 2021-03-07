<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sales_payment".
 *
 * @property string $sales_payment_id
 * @property string $customer_id
 * @property string $employee_id
 * @property string $date
 * @property float $total
 * @property int $payment_type
 *
 * @property DetailSalesPayment[] $detailSalesPayments
 * @property Customer $customer
 * @property Employee $employee
 */
class SalesPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sales_payment_id', 'customer_id', 'employee_id', 'date', 'total'], 'required'],
            [['date'], 'safe'],
            [['payment_type'], 'integer'],
            [['sales_payment_id'], 'string', 'max' => 50],
            [['customer_id', 'employee_id'], 'string', 'max' => 20],
            [['sales_payment_id'], 'unique'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'employee_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sales_payment_id' => 'Sales Payment ID',
            'customer_id' => 'Customer ID',
            'employee_id' => 'Employee ID',
            'date' => 'Date',
            'total' => 'Total',
            'payment_type' => 'Payment Type',
        ];
    }

    /**
     * Gets query for [[DetailSalesPayments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailSalesPayments()
    {
        return $this->hasMany(DetailSalesPayment::className(), ['sales_payment_id' => 'sales_payment_id']);
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

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['employee_id' => 'employee_id']);
    }
}
