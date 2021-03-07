<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_category".
 *
 * @property int $item_category_id
 * @property string $item_category_name
 * @property int $status
 *
 * @property SubItemCategory[] $subItemCategories
 */
class ItemCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_category_name'], 'required'],
            [['status'], 'integer'],
            [['item_category_name'], 'string', 'max' => 50],
            [['item_category_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_category_id' => 'Item Category ID',
            'item_category_name' => 'Item Category Name',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[SubItemCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubItemCategories()
    {
        return $this->hasMany(SubItemCategory::className(), ['item_category_id' => 'item_category_id']);
    }
}
