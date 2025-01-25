<?php
namespace frontend\models;

use Yii;

/**
 * This is the model class for table "uploads".
 *
 * @property int $id
 * @property int $user_id
 * @property string $file_name
 * @property string|null $description
 * @property string $file
 * @property string $upload_date
 * @property int $upload_type

 */
class Uploads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'file'], 'required'],
            [['user_id'], 'integer'], //'upload_type', , 'the_first_row_is_header'
            [['upload_date'], 'safe'],
            [['file_name'], 'string', 'max' => 255], //, 'description'
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'csv'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'file_name' => 'File Name',
            
            'file' => 'File',
            'upload_date' => 'Upload Date',
            //'upload_type' => 'Upload Type',
            //'status' => 'Status',
            //'the_first_row_is_header' => 'Is The First Row Header?',
        ];
    }
}
