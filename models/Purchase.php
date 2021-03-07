<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase".
 *
 * @property string $purchase_id
 * @property string $employee_id
 * @property string $supplier_id
 * @property string $trans_id
 * @property string $date
 * @property string $supplier_invoice
 * @property float|null $total
 * @property int|null $discount
 * @property float|null $rebate
 * @property float|null $grandtotal
 * @property string|null $due_date
 * @property string|null $edit_date
 * @property string|null $emp_edit_id
 * @property int|null $status
 *
 * @property DetailPurchase[] $detailPurchases
 * @property Employee $employee
 * @property Supplier $supplier
 */
class Purchase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purchase_id', 'employee_id', 'supplier_id', 'trans_id', 'date', 'supplier_invoice', 'total', 'grandtotal'], 'required'],
            [['date', 'due_date', 'edit_date'], 'safe'],
            [['status'], 'integer'],
            [['purchase_id', 'trans_id', 'supplier_invoice'], 'string', 'max' => 50],
            [['employee_id', 'supplier_id', 'emp_edit_id'], 'string', 'max' => 20],
            [['purchase_id'], 'unique'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'employee_id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'supplier_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'purchase_id' => 'Purchase ID',
            'employee_id' => 'Employee ID',
            'supplier_id' => 'Supplier ID',
            'trans_id' => 'Trans ID',
            'date' => 'Date',
            'supplier_invoice' => 'Supplier Invoice',
            'total' => 'Total',
            'discount' => 'Discount',
            'rebate' => 'Rebate',
            'grandtotal' => 'Grandtotal',
            'due_date' => 'Due Date',
            'edit_date' => 'Edit Date',
            'emp_edit_id' => 'Emp Edit ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[DetailPurchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPurchases()
    {
        return $this->hasMany(DetailPurchase::className(), ['purchase_id' => 'purchase_id']);
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
}
