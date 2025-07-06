<style>
.padd{
    margin-top: -5px;
}
</style>

<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
//use frontend\models\States;
//use frontend\models\Webhookurls;
//use frontend\models\Campaigns;

//$campaigns = $dataProvider->query->all();
//$campaigns =  ArrayHelper::map(Campaigns::find()->orderBy('campaign')->asArray()->all(), 'id', 'campaign');
//$webhookurls = Webhookurls::find()->where(['status' => '1'])->asArray()->orderBy('webhook_title')->all();
//$select_array = array_merge(['csv'=>'CSV'],ArrayHelper::map($webhookurls, 'webhook_url', 'webhook_title'));
?>
<div class="export_form">
    <?php $form = ActiveForm::begin(['action' =>'bulkexport']); ?>
<div class="row">
    <div class="col-md-3">
        <?php // echo $form->field($model, 'campaigne') ?>
        <?php //echo $form->field($model,'campaign[]')->dropDownList($campaigns, 
                //['prompt' => '- Select -', 'class'=>'form-control selectpicker', 'multiple'=>'multiple', 'data-live-search'=>"true"]); ?>
    </div>
    <div class="col-md-2">
        <?php // echo $form->field($model, 'state') ?>
        <?php //echo $form->field($model,'state[]')->dropDownList(ArrayHelper::map(States::find()->orderBy('state')->all(), 'area_code', 'state'), 
                //['prompt' => '- Select -', 'class'=>'form-control selectpicker', 'multiple'=>'multiple', 'data-live-search'=>"true"]); ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'totalleads') ->textInput(['maxlength' => true, 'value'=>1000, 'placeholder' => "0"]) ?>
    </div>
    <div class="col-md-3">
        <?php // $form->field($model, 'csvwebhook')->dropDownList($select_array, ['prompt' => '- Select -']); ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'leads_with_emails')->dropDownList(['0'=>'No', '1'=>'Yes'], ['prompt' => '- Select -']); ?>
    </div>
</div>
<div class="row">    
    <div class="col-md-6">
    <div class="row"> 
        <?= $form->field($model, 'leads_with_total_exports_limit_sign', ['inputTemplate' => '<div class="col-sm-2">{input}</div>'])->dropDownList(['>'=>'>', '='=>'=', '<'=>'<'])
        ->label(Html::activeLabel($model,'leads_with_total_exports_limit_sign'), ['class'=>'col-sm-4']) ; ?>
        <div class="col-sm-4 padd">
        <?= $form->field($model, 'leads_with_total_exports')->textInput(['maxlength' => true, 'value'=>0, 'placeholder' => "0"])->label(false); ?>
        </div>
        <div class="col-md-2 padd">
            <?= Html::submitButton('Export', ['class' => 'btn btn-primary', 'style'=>'width: 100%;']) ?>
        </div>
        </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>
</div>