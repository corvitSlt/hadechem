<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_receipt".
 *
 * @property string $or_id
 * @property string $employee_id
 * @property string $po_id
 * @property string $supplier_id
 * @property string $supplier_invoice
 * @property string|null $date
 * @property string|null $notes
 * @property string|null $shipper
 * @property string|null $vehicle_number
 * @property string|null $edit_date
 * @property string|null $emp_edit_id
 * @property int|null $status
 *
 * @property DetailOrderReceipt[] $detailOrderReceipts
 * @property Employee $employee
 * @property PurchaseOrder $po
 */
class OrderReceipt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_receipt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['or_id', 'employee_id', 'po_id', 'supplier_id', 'supplier_invoice'], 'required'],
            [['date', 'edit_date'], 'safe'],
            [['notes'], 'string'],
            [['status'], 'integer'],
            [['or_id', 'po_id', 'supplier_id', 'supplier_invoice', 'shipper'], 'string', 'max' => 50],
            [['employee_id', 'emp_edit_id'], 'string', 'max' => 20],
            [['vehicle_number'], 'string', 'max' => 15],
            [['or_id'], 'unique'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'employee_id']],
            [['po_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrder::className(), 'targetAttribute' => ['po_id' => 'po_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'or_id' => 'Or ID',
            'employee_id' => 'Employee ID',
            'po_id' => 'Po ID',
            'supplier_id' => 'Supplier ID',
            'supplier_invoice' => 'Supplier Invoice',
            'date' => 'Date',
            'notes' => 'Notes',
            'shipper' => 'Shipper',
            'vehicle_number' => 'Vehicle Number',
            'edit_date' => 'Edit Date',
            'emp_edit_id' => 'Emp Edit ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[DetailOrderReceipts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailOrderReceipts()
    {
        return $this->hasMany(DetailOrderReceipt::className(), ['or_id' => 'or_id']);
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
	
	public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['supplier_id' => 'supplier_id']);
    }
    /**
     * Gets query for [[Po]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPo()
    {
        return $this->hasOne(PurchaseOrder::className(), ['po_id' => 'po_id']);
    }
}
