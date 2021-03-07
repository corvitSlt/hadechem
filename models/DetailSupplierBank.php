<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_supplier_bank".
 *
 * @property int $det_sup_bank_id
 * @property int $bank_id
 * @property string $supplier_id
 * @property string $account_number
 * @property string $account_name
 *
 * @property Bank $bank
 * @property Supplier $supplier
 */
class DetailSupplierBank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_supplier_bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_id', 'supplier_id', 'account_number', 'account_name'], 'required'],
            [['bank_id'], 'integer'],
            [['supplier_id', 'account_number', 'account_name'], 'string', 'max' => 20],
            [['bank_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bank::className(), 'targetAttribute' => ['bank_id' => 'bank_id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'supplier_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'det_sup_bank_id' => 'Det Sup Bank ID',
            'bank_id' => 'Bank ID',
            'supplier_id' => 'Supplier ID',
            'account_number' => 'Account Number',
            'account_name' => 'Account Name',
        ];
    }

    /**
     * Gets query for [[Bank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(Bank::className(), ['bank_id' => 'bank_id']);
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
