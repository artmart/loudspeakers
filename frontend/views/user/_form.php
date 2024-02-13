<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="user-form">
<div class="mt-5 offset-lg-3 col-lg-6">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
<div class="row">
<div class="col-lg-6">    
    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
</div>    
<div class="col-lg-6">      
    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-lg-6">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-lg-6">
    <?= $form->field($model, 'password')->passwordInput() ?>
</div>
<?php 
if(!Yii::$app->user->isGuest && Yii::$app->user->identity->user_group == 1) {
?>

<div class="col-lg-6">
    <?= $form->field($model, 'status')->dropDownList(['10' => 'Active', '9' =>'Inactive'] /*, ['prompt'=>'- Select -']*/); ?>
</div> 
<div class="col-lg-6">    
    <?= $form->field($model, 'user_group')->dropDownList(['1' => 'Administrator', '2' => 'User'] /*, ['prompt'=>'- Select -']*/); ?>
</div>
<?php } ?>  
</div>
<hr />
    <div class="form-group">
    <?= $form->field($model, 'profile_photo')->fileInput() ?>
  
		<?php 
		$file = Yii::getAlias('@frontend/web/uploads/') . "$model->profile_photo";
        
        $screen_path = '/uploads/'.$model->profile_photo;
		if (file_exists($file) && $model->profile_photo){ ?>
			<div class="form-group field-company-company_name required">
			<?=Html::img($screen_path, ['width' => '200px', 'alt3'=> $model->firstname]);?>
             
			</div>	
		<?php } ?>
    </div>
 <hr />     
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success w-100']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</div>