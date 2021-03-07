<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_purchase_request".
 *
 * @property int $detail_pr_id
 * @property string $item_id
 * @property string $pr_id
 * @property int|null $qty
 *
 * @property Item $item
 * @property PurchaseRequest $pr
 */
class DetailPurchaseRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_purchase_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'pr_id'], 'required'],
            [['qty'], 'integer'],
            [['item_id', 'pr_id'], 'string', 'max' => 20],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'item_id']],
            [['pr_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseRequest::className(), 'targetAttribute' => ['pr_id' => 'pr_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detail_pr_id' => 'Detail Pr ID',
            'item_id' => 'Item ID',
            'pr_id' => 'Pr ID',
            'qty' => 'Qty',
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['item_id' => 'item_id']);
    }
	public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['unit_id' => 'unit_id'])
		->via('item');
    }
    /**
     * Gets query for [[Pr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPr()
    {
        return $this->hasOne(PurchaseRequest::className(), ['pr_id' => 'pr_id']);
    }
}
