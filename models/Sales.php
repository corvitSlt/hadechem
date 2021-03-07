<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sales".
 *
 * @property string $sales_id
 * @property string $customer_id
 * @property string $employee_id
 * @property string $delivery_order_id
 * @property string $date
 * @property float $total
 * @property float $grandtotal
 * @property float|null $discount
 * @property int $due_date
 * @property int|null $status
 *
 * @property DetailSales[] $detailSales
 * @property DetailSalesPayment[] $detailSalesPayments
 * @property Employee $employee
 * @property DeliveryOrder $deliveryOrder
 * @property Customer $customer
 */
class Sales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sales_id', 'customer_id', 'employee_id', 'delivery_order_id', 'date', 'total', 'grandtotal'], 'required'],
            [['date'], 'safe'],
            [['due_date', 'status'], 'integer'],
            [['sales_id', 'delivery_order_id'], 'string', 'max' => 50],
            [['customer_id', 'employee_id'], 'string', 'max' => 20],
            [['sales_id'], 'unique'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'employee_id']],
            [['delivery_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeliveryOrder::className(), 'targetAttribute' => ['delivery_order_id' => 'delivery_order_id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sales_id' => 'Sales ID',
            'customer_id' => 'Customer ID',
            'employee_id' => 'Employee ID',
            'delivery_order_id' => 'Delivery Order ID',
            'date' => 'Date',
            'total' => 'Total',
            'grandtotal' => 'Grandtotal',
            'discount' => 'Discount',
            'due_date' => 'Due Date',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[DetailSales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailSales()
    {
        return $this->hasMany(DetailSales::className(), ['sales_id' => 'sales_id']);
    }

    /**
     * Gets query for [[DetailSalesPayments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailSalesPayments()
    {
        return $this->hasMany(DetailSalesPayment::className(), ['sales_id' => 'sales_id']);
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

    /**
     * Gets query for [[DeliveryOrder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryOrder()
    {
        return $this->hasOne(DeliveryOrder::className(), ['delivery_order_id' => 'delivery_order_id']);
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
