<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_item_category".
 *
 * @property string $sub_item_category_id
 * @property int $item_category_id
 * @property string $sub_item_category_name
 * @property int $status
 *
 * @property Item[] $items
 * @property ItemCategory $itemCategory
 */
class SubItemCategory extends \yii\db\ActiveRecord
{
	public $disabledIdCategory;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_item_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sub_item_category_id', 'item_category_id', 'sub_item_category_name'], 'required'],
            [['item_category_id', 'status'], 'integer'],
            [['sub_item_category_id'], 'string', 'max' => 20],
            [['sub_item_category_name'], 'string', 'max' => 50],
            [['sub_item_category_name'], 'unique'],
            [['sub_item_category_id'], 'unique'],
            [['item_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemCategory::className(), 'targetAttribute' => ['item_category_id' => 'item_category_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sub_item_category_id' => 'Sub Item Category ID',
            'item_category_id' => 'Item Category ID',
            'sub_item_category_name' => 'Sub Item Category Name',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Items]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['sub_item_category_id' => 'sub_item_category_id']);
    }

    /**
     * Gets query for [[ItemCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemCategory()
    {
        return $this->hasOne(ItemCategory::className(), ['item_category_id' => 'item_category_id']);
    }
}
