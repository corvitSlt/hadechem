<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase_request".
 *
 * @property string $pr_id
 * @property string $supplier_id
 * @property string $employee_id
 * @property string|null $date
 * @property string|null $edit_date
 * @property string|null $emp_edit_id
 * @property int|null $status
 *
 * @property DetailPurchaseRequest[] $detailPurchaseRequests
 * @property Employee $employee
 * @property Supplier $supplier
 */
class PurchaseRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pr_id', 'supplier_id', 'employee_id'], 'required'],
            [['date', 'edit_date'], 'safe'],
            [['status'], 'integer'],
            [['pr_id'], 'string', 'max' => 50],
            [['supplier_id', 'employee_id', 'emp_edit_id'], 'string', 'max' => 20],
            [['pr_id'], 'unique'],
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
            'pr_id' => 'Pr ID',
            'supplier_id' => 'Supplier ID',
            'employee_id' => 'Employee ID',
            'date' => 'Date',
            'edit_date' => 'Edit Date',
            'emp_edit_id' => 'Emp Edit ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[DetailPurchaseRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPurchaseRequests()
    {
        return $this->hasMany(DetailPurchaseRequest::className(), ['pr_id' => 'pr_id']);
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
