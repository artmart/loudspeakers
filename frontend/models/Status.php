<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $status
 *
 * @property Transducers[] $transducers
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Transducers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransducers()
    {
        return $this->hasMany(Transducers::class, ['status' => 'id']);
    }
}
