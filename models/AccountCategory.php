<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_category".
 *
 * @property int $account_category_id
 * @property string|null $account_category_name
 *
 * @property AccountGroup[] $accountGroups
 */
class AccountCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_category_id'], 'required'],
            [['account_category_id'], 'integer'],
            [['account_category_name'], 'string', 'max' => 100],
            [['account_category_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'account_category_id' => 'Account Category ID',
            'account_category_name' => 'Account Category Name',
        ];
    }

    /**
     * Gets query for [[AccountGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccountGroups()
    {
        return $this->hasMany(AccountGroup::className(), ['account_category_id' => 'account_category_id']);
    }
}
