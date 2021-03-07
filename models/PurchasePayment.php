<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase_payment".
 *
 * @property string $purchase_payment_id
 * @property string $supplier_id
 * @property string $employee_id
 * @property string $date
 * @property float $total
 * @property int $payment_type
 *
 * @property DetailPurchasePayment[] $detailPurchasePayments
 * @property Employee $employee
 * @property Supplier $supplier
 */
class PurchasePayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purchase_payment_id', 'supplier_id', 'employee_id', 'date', 'total'], 'required'],
            [['date'], 'safe'],
            [['payment_type'], 'integer'],
            [['purchase_payment_id'], 'string', 'max' => 50],
            [['supplier_id', 'employee_id'], 'string', 'max' => 20],
            [['purchase_payment_id'], 'unique'],
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
            'purchase_payment_id' => 'Purchase Payment ID',
            'supplier_id' => 'Supplier ID',
            'employee_id' => 'Employee ID',
            'date' => 'Date',
            'total' => 'Total',
            'payment_type' => 'Payment Type',
        ];
    }

    /**
     * Gets query for [[DetailPurchasePayments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPurchasePayments()
    {
        return $this->hasMany(DetailPurchasePayment::className(), ['purchase_payment_id' => 'purchase_payment_id']);
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
