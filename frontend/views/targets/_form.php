<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//use frontend\models\Types;
//use frontend\models\Status;


//$types = Types::find()->asArray()->orderBy('type')->all();
//$statuses = Status::find()->asArray()->orderBy('status')->all();
?>

<div class="Targets-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
<?php 
if($model->isNewRecord){$user_id = Yii::$app->user->id;}else{$user_id = $model->entered_by;}
    
    echo $form->field($model, 'entered_by')->hiddenInput(['value'=>$user_id])->label(false); ?>    
    
    <?php // $form->field($model, 'entered_by', ['options' => ['class' => 'col-lg-2']])->textInput() ?>    
    
    <?php // $form->field($model, 'entry_time')->textInput() ?>
    <?php // $form->field($model, 'updated', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
        
<div class="col-lg-7 mb-2">
    <?= $form->field($model, 'target', ['options' => ['class' => 'col-lg-8']])->textInput(['maxlength' => true]) ?>

    
</div>

    <div class="form-group col-lg-3 mt-4">
    <?= $form->field($model, 'target_curve')->fileInput() ?>
  
	<?php 
	$file = Yii::getAlias('@frontend/web/uploads/target_curves/') . "$model->target_curve";
    $screen_path = '/uploads/target_curves/'.$model->target_curve;
	if (file_exists($file) && $model->target_curve){ ?>
		<div class="form-group field-company-company_name required">
		<?php echo $model->target_curve;
        
        
        //Html::img($screen_path, ['width' => '200px', 'alt3'=> $model->firstname]);?>
         
		</div>	
	<?php } ?>
    </div>



    <div class="form-group col-lg-2 mt-4">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success w-100']) ?>
    </div>

</div>

    <?php ActiveForm::end(); ?>

</div>
