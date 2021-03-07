<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sales_order".
 *
 * @property string $so_id
 * @property string $employee_id
 * @property string $customer_id
 * @property string $date
 * @property float $total
 * @property string $sales_id
 * @property string|null $edit_date
 * @property string|null $emp_edit_id
 * @property int|null $status
 *
 * @property DetailSalesOrder[] $detailSalesOrders
 * @property Employee $employee
 * @property Customer $customer
 */
class SalesOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['so_id', 'employee_id', 'customer_id', 'date', 'total', 'grandtotal', 'sales_id'], 'required'],
            [['date', 'edit_date'], 'safe'],
            [['status', 'voucher_id'], 'integer'],
            [['so_id'], 'string', 'max' => 50],
            [['employee_id', 'customer_id', 'sales_id', 'emp_edit_id'], 'string', 'max' => 20],
            [['so_id'], 'unique'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'employee_id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'so_id' => 'No SO',
            'employee_id' => 'Pegawai',
            'customer_id' => 'Pelanggan',
            'date' => 'Tanggal',
            'total' => 'Total',
			'grandtotal' => 'Total Akhir',
            'sales_id' => 'Sales',
			'voucher_id' => 'Voucher',
            'edit_date' => 'Tanggal Edit',
            'emp_edit_id' => 'Pegawai Edit',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[DetailSalesOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailSalesOrders()
    {
        return $this->hasMany(DetailSalesOrder::className(), ['so_id' => 'so_id']);
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
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }
}
