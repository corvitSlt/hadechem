<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coa".
 *
 * @property string $coa_code
 * @property int $account_group_id
 * @property string|null $coa_name
 * @property float|null $beginning_balance
 *
 * @property AccountGroup $accountGroup
 * @property CoaBalance[] $coaBalances
 * @property DetailJournal[] $detailJournals
 */
class Coa extends \yii\db\ActiveRecord
{
	public $coa_code_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coa_code', 'account_group_id'], 'required'],
            [['account_group_id'], 'integer'],
            [['beginning_balance'], 'number'],
            [['coa_code'], 'string', 'max' => 20],
            [['coa_name'], 'string', 'max' => 100],
            [['coa_code'], 'unique'],
            [['account_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => AccountGroup::className(), 'targetAttribute' => ['account_group_id' => 'account_group_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'coa_code' => 'Kode COA',
            'account_group_id' => 'Kode Group',
            'coa_name' => 'Nama COA',
            'beginning_balance' => 'Beginning Balance',
        ];
    }

    /**
     * Gets query for [[AccountGroup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccountGroup()
    {
        return $this->hasOne(AccountGroup::className(), ['account_group_id' => 'account_group_id']);
    }

    /**
     * Gets query for [[CoaBalances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoaBalances()
    {
        return $this->hasMany(CoaBalance::className(), ['coa_code' => 'coa_code']);
    }

    /**
     * Gets query for [[DetailJournals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailJournals()
    {
        return $this->hasMany(DetailJournal::className(), ['coa_code' => 'coa_code']);
    }
}
