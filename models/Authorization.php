<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authorization".
 *
 * @property int $authorization_id
 * @property int $system_access
 * @property int $customer
 * @property int $create_customer
 * @property int $update_customer
 * @property int $delete_customer
 * @property int $view_customer
 * @property int $print_customer_master
 * @property int $employee
 * @property int $create_employee
 * @property int $update_employee
 * @property int $delete_employee
 * @property int $view_employee
 * @property int $reset_employee_password
 * @property int $print_employee_master
 * @property int $supplier
 * @property int $create_supplier
 * @property int $update_supplier
 * @property int $delete_supplier
 * @property int $view_supplier
 * @property int $print_supplier_master
 * @property int $item
 * @property int $create_item
 * @property int $update_item
 * @property int $delete_item
 * @property int $view_item
 * @property int $print_item_master
 * @property int $item_category
 * @property int $create_item_category
 * @property int $update_item_category
 * @property int $delete_item_category
 * @property int $view_item_category
 * @property int $sub_item_category
 * @property int $create_sub_item_category
 * @property int $update_sub_item_category
 * @property int $delete_sub_item_category
 * @property int $view_sub_item_category
 * @property int $create_unit
 * @property int $update_unit
 * @property int $view_unit
 * @property int $stock_card
 * @property int $create_stock_card
 * @property int $update_stock_card
 * @property int $delete_stock_card
 * @property int $view_stock_card
 * @property int $print_stock_card
 *
 * @property Job[] $jobs
 */
class Authorization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authorization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['system_access', 'customer', 'create_customer', 'update_customer', 'delete_customer', 'view_customer', 'print_customer_master', 'employee', 'create_employee', 'update_employee', 'delete_employee', 'view_employee', 'reset_employee_password', 'print_employee_master', 'supplier', 'create_supplier', 'update_supplier', 'delete_supplier', 'view_supplier', 'print_supplier_master', 'item', 'create_item', 'update_item', 'delete_item', 'view_item', 'print_item_master', 'item_category', 'create_item_category', 'update_item_category', 'delete_item_category', 'view_item_category', 'sub_item_category', 'create_sub_item_category', 'update_sub_item_category', 'delete_sub_item_category', 'view_sub_item_category', 'create_unit', 'update_unit', 'view_unit', 'stock_card', 'create_stock_card', 'update_stock_card', 'delete_stock_card', 'view_stock_card', 'print_stock_card'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'authorization_id' => 'Authorization ID',
            'system_access' => 'System Access',
            'customer' => 'Customer',
            'create_customer' => 'Create Customer',
            'update_customer' => 'Update Customer',
            'delete_customer' => 'Delete Customer',
            'view_customer' => 'View Customer',
            'print_customer_master' => 'Print Customer Master',
            'employee' => 'Employee',
            'create_employee' => 'Create Employee',
            'update_employee' => 'Update Employee',
            'delete_employee' => 'Delete Employee',
            'view_employee' => 'View Employee',
            'reset_employee_password' => 'Reset Employee Password',
            'print_employee_master' => 'Print Employee Master',
            'supplier' => 'Supplier',
            'create_supplier' => 'Create Supplier',
            'update_supplier' => 'Update Supplier',
            'delete_supplier' => 'Delete Supplier',
            'view_supplier' => 'View Supplier',
            'print_supplier_master' => 'Print Supplier Master',
            'item' => 'Item',
            'create_item' => 'Create Item',
            'update_item' => 'Update Item',
            'delete_item' => 'Delete Item',
            'view_item' => 'View Item',
            'print_item_master' => 'Print Item Master',
            'item_category' => 'Item Category',
            'create_item_category' => 'Create Item Category',
            'update_item_category' => 'Update Item Category',
            'delete_item_category' => 'Delete Item Category',
            'view_item_category' => 'View Item Category',
            'sub_item_category' => 'Sub Item Category',
            'create_sub_item_category' => 'Create Sub Item Category',
            'update_sub_item_category' => 'Update Sub Item Category',
            'delete_sub_item_category' => 'Delete Sub Item Category',
            'view_sub_item_category' => 'View Sub Item Category',
            'create_unit' => 'Create Unit',
            'update_unit' => 'Update Unit',
            'view_unit' => 'View Unit',
            'stock_card' => 'Stock Card',
            'create_stock_card' => 'Create Stock Card',
            'update_stock_card' => 'Update Stock Card',
            'delete_stock_card' => 'Delete Stock Card',
            'view_stock_card' => 'View Stock Card',
            'print_stock_card' => 'Print Stock Card',
        ];
    }

    /**
     * Gets query for [[Jobs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobs()
    {
        return $this->hasMany(Job::className(), ['authorization_id' => 'authorization_id']);
    }
}
