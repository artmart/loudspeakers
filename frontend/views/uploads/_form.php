<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//use frontend\models\Campaigns;

if($model->isNewRecord){$user_id = Yii::$app->user->id;}else{$user_id = $model->user_id;}
?>
<div class="well col-xs-10 col-sm-8 col-md-6 col-xs-offset-1 col-sm-offset-2 col-md-offset-3">
<div class="uploads-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>    
    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>$user_id])->label(false); ?>
    <?php // echo $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
     <?php //echo $form->field($model,'campaign_id')->dropDownList(ArrayHelper::map(Campaigns::find()->orderBy('campaign')->all(), 'id', 'campaign'), ['prompt' => '- Select -']); ?>
    <?php // $form->field($model,'the_first_row_is_header')->dropDownList(['1'=>'Yes', '0'=>'No']); ?>
    <?= $form->field($model, 'file')->fileInput() ?>
<hr />
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</div>