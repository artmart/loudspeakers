<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "types".
 *
 * @property int $id
 * @property string $type
 *
 * @property Transducers[] $transducers
 */
class Types extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
        ];
    }

    /**
     * Gets query for [[Transducers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransducers()
    {
        return $this->hasMany(Transducers::class, ['type' => 'id']);
    }
}
