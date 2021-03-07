<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "job".
 *
 * @property int $job_id
 * @property int $authorization_id
 * @property string $job_name
 *
 * @property Employee[] $employees
 * @property Authorization $authorization
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['authorization_id', 'job_name'], 'required'],
            [['authorization_id'], 'integer'],
            [['job_name'], 'string', 'max' => 10],
            [['job_name'], 'unique'],
            [['authorization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Authorization::className(), 'targetAttribute' => ['authorization_id' => 'authorization_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'job_id' => 'Job ID',
            'authorization_id' => 'Authorization ID',
            'job_name' => 'Job Name',
        ];
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['job_id' => 'job_id']);
    }

    /**
     * Gets query for [[Authorization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorization()
    {
        return $this->hasOne(Authorization::className(), ['authorization_id' => 'authorization_id']);
    }
}
