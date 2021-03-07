<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery_order".
 *
 * @property string $delivery_order_id
 * @property string $employee_id
 * @property string $so_id
 * @property string $date
 * @property string $shipper
 * @property string $transportation_type
 * @property string $vehicle_number
 * @property string|null $edit_date
 * @property string|null $emp_edit_id
 * @property int $status
 *
 * @property Employee $employee
 * @property SalesOrder $so
 * @property DetailDeliveryOrder[] $detailDeliveryOrders
 */
class DeliveryOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'delivery_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['delivery_order_id', 'employee_id', 'so_id', 'date', 'shipper', 'transportation_type', 'vehicle_number'], 'required'],
            [['date', 'edit_date'], 'safe'],
            [['status'], 'integer'],
            [['delivery_order_id', 'so_id', 'shipper'], 'string', 'max' => 50],
            [['employee_id', 'emp_edit_id'], 'string', 'max' => 20],
            [['transportation_type', 'vehicle_number'], 'string', 'max' => 15],
            [['delivery_order_id'], 'unique'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'employee_id']],
            [['so_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalesOrder::className(), 'targetAttribute' => ['so_id' => 'so_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'delivery_order_id' => 'No Pengiriman',
            'employee_id' => 'ID Pegawai',
            'so_id' => 'ID SO',
            'date' => 'Tanggal',
            'shipper' => 'Pengirim/Supir',
            'transportation_type' => 'Jenis Kendaraan',
            'vehicle_number' => 'No Kendaraan',
            'edit_date' => 'Tanggal Edit',
            'emp_edit_id' => 'Pegawai Edit',
            'status' => 'Status',
        ];
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
     * Gets query for [[So]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSo()
    {
        return $this->hasOne(SalesOrder::className(), ['so_id' => 'so_id']);
    }
	public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id'])
		->via('so');
    }
    /**
     * Gets query for [[DetailDeliveryOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailDeliveryOrders()
    {
        return $this->hasMany(DetailDeliveryOrder::className(), ['delivery_order_id' => 'delivery_order_id']);
    }
}
