<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase_order".
 *
 * @property string $po_id
 * @property string $pr_id
 * @property string $supplier_id
 * @property string $employee_id
 * @property int $cash_type
 * @property string $supplier_invoice
 * @property string|null $date
 * @property float|null $total
 * @property string|null $edit_date
 * @property string|null $emp_edit_id
 * @property int $status
 *
 * @property DetailPurchaseOrder[] $detailPurchaseOrders
 * @property Employee $employee
 * @property Supplier $supplier
 * @property PurchaseRequest $pr
 */
class PurchaseOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['po_id', 'pr_id', 'supplier_id', 'employee_id', 'supplier_invoice', 'status'], 'required'],
            [['cash_type', 'status'], 'integer'],
            [['date', 'edit_date'], 'safe'],
            [['po_id', 'pr_id', 'supplier_invoice'], 'string', 'max' => 50],
            [['supplier_id', 'employee_id', 'emp_edit_id'], 'string', 'max' => 20],
            [['po_id'], 'unique'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'employee_id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'supplier_id']],
            [['pr_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseRequest::className(), 'targetAttribute' => ['pr_id' => 'pr_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'po_id' => 'Po ID',
            'pr_id' => 'Pr ID',
            'supplier_id' => 'Supplier ID',
            'employee_id' => 'Employee ID',
            'cash_type' => 'Cash Type',
            'supplier_invoice' => 'Supplier Invoice',
            'date' => 'Date',
            'total' => 'Total',
            'edit_date' => 'Edit Date',
            'emp_edit_id' => 'Emp Edit ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[DetailPurchaseOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPurchaseOrders()
    {
        return $this->hasMany(DetailPurchaseOrder::className(), ['po_id' => 'po_id']);
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
     * Gets query for [[Supplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['supplier_id' => 'supplier_id']);
    }

    /**
     * Gets query for [[Pr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPr()
    {
        return $this->hasOne(PurchaseRequest::className(), ['pr_id' => 'pr_id']);
    }
}
