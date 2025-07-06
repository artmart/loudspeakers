<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
//use common\models\User;

class ExportForm extends Model
{
    public $state;
    public $campaign;
    public $csvwebhook;
    public $totalleads;
    public $leads_with_emails;
    public $leads_with_total_exports;
    public $leads_with_total_exports_limit_sign;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['csvwebhook', 'required'],
            [['csvwebhook'], 'string', 'min' => 2, 'max' => 255],
            [['totalleads', 'leads_with_emails', 'leads_with_total_exports'], 'integer'],
            [['state', 'campaign'], 'validateArray'],
            ['leads_with_total_exports_limit_sign', 'string'],
        ];
    }
    
    public function validateArray($attribute, $params, $validator){
        if(!is_array($this->$attribute)){$this->addError($attribute, 'The attribute must be array.');}
    }

    public function attributeLabels()
    {
        return [
           // 'id' => 'ID',
            'csvwebhook' => 'CSV/Webhook',
            'state' => 'State',
            'campaign' => 'Campaign',
            'totalleads' => 'Total Leads to export',
            'leads_with_emails' => 'Leads with emails?',
            'leads_with_total_exports' =>' ', // 'Leads with Total Exports',
            'leads_with_total_exports_limit_sign' =>'Leads with Total Exports' // 'Leads with Total Exports Limit Sign'
        ];
    }
}