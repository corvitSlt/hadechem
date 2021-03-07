<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_group".
 *
 * @property int $account_group_id
 * @property int $account_category_id
 * @property string $group_code
 * @property string $account_group_name
 * @property string $balance
 *
 * @property AccountCategory $accountCategory
 * @property Coa[] $coas
 */
class AccountGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_group_id', 'account_category_id', 'group_code', 'account_group_name', 'balance'], 'required'],
            [['account_group_id', 'account_category_id'], 'integer'],
            [['group_code'], 'string', 'max' => 20],
            [['account_group_name'], 'string', 'max' => 100],
            [['balance'], 'string', 'max' => 1],
            [['account_group_id'], 'unique'],
            [['account_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => AccountCategory::className(), 'targetAttribute' => ['account_category_id' => 'account_category_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'account_group_id' => 'Account Group ID',
            'account_category_id' => 'Account Category ID',
            'group_code' => 'Group Code',
            'account_group_name' => 'Account Group Name',
            'balance' => 'Balance',
        ];
    }

    /**
     * Gets query for [[AccountCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCategory()
    {
        return $this->hasOne(AccountCategory::className(), ['account_category_id' => 'account_category_id']);
    }

    /**
     * Gets query for [[Coas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoas()
    {
        return $this->hasMany(Coa::className(), ['account_group_id' => 'account_group_id']);
    }
}
