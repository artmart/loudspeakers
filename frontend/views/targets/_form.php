<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Types;
use frontend\models\Status;


$types = Types::find()->asArray()->orderBy('type')->all();
$statuses = Status::find()->asArray()->orderBy('status')->all();
?>

<div class="Targets-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
<?php 
if($model->isNewRecord){$user_id = Yii::$app->user->id;}else{$user_id = $model->entered_by;}
    
    echo $form->field($model, 'entered_by')->hiddenInput(['value'=>$user_id])->label(false); ?>    
    
    <?php // $form->field($model, 'entered_by', ['options' => ['class' => 'col-lg-2']])->textInput() ?>    
    
    <?php // $form->field($model, 'entry_time')->textInput() ?>
    <?php // $form->field($model, 'updated', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
        
<div class="row mb-2">
    <?= $form->field($model, 'manufacturer', ['options' => ['class' => 'col-lg-8']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model', ['options' => ['class' => 'col-lg-4']])->textInput(['maxlength' => true]) ?>
</div>
<div class="row mb-2">
    <?= //$form->field($model, 'type')->textInput() 
    $form->field($model, 'type', ['options' => ['class' => 'col-lg-2']])->dropDownList(ArrayHelper::map($types, 'id', 'type'), ['prompt'=>'- Select -', 'class'=>'form-control'])
    ?>
    <?= //$form->field($model, 'status', ['options' => ['class' => 'col-lg-2']])->textInput() 
    $form->field($model, 'status', ['options' => ['class' => 'col-lg-2']])->dropDownList(ArrayHelper::map($statuses, 'id', 'status'), ['prompt'=>'- Select -', 'class'=>'form-control'])
    
    ?>
    <?= $form->field($model, 'size', ['options' => ['class' => 'col-lg-2']])->textInput() ?>

    <?= $form->field($model, 're', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'z1k', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'z10k', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
</div>
<div class="row mb-2">
    <?= $form->field($model, 'le', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'leb', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'ke', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'rss', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'fs', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'qms', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
</div>
<div class="row mb-2">
    <?= $form->field($model, 'qes', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'qts', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'rms', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'mms', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'cms', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'vas', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
</div>
<div class="row mb-2">
    <?= $form->field($model, 'sd', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'bl', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'pmax', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'xmax', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'beta', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'uspl', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
</div>
<div class="row mb-2">
    <?= $form->field($model, 'bl2_re', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'vocc', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'weight', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'diameter_oa', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'height_oa', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <?= $form->field($model, 'cost', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
</div>
<div class="row mb-2">
    <?= $form->field($model, 'webpage', ['options' => ['class' => 'col-lg-8']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'revision', ['options' => ['class' => 'col-lg-4']])->textInput(['maxlength' => true]) ?>
    
</div>
<hr />
<div class="row">    
    
    <?php //$form->field($model, 'target_curve', ['options' => ['class' => 'col-lg-2']])->textInput() ?>
    <div class="form-group col-lg-4">
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

    <?php // $form->field($model, 'test_signal', ['options' => ['class' => 'col-lg-2']])->textInput(['maxlength' => true]) ?>
    
    <div class="form-group col-lg-4">
    <?= $form->field($model, 'test_signal')->fileInput() ?>
  
	<?php 
	$file = Yii::getAlias('@frontend/web/uploads/test_signals/') . "$model->test_signal";
    $screen_path = '/uploads/test_signals/'.$model->test_signal;
	if (file_exists($file) && $model->test_signal){ ?>
		<div class="form-group field-company-company_name required">
		<?php 
        echo $model->test_signal;
        //Html::img($screen_path, ['width' => '200px', 'alt3'=> $model->firstname]);?>
         
		</div>	
	<?php } ?>
    </div>
    
    <?php // $form->field($model, 'data_sheet', ['options' => ['class' => 'col-lg-2']])->textInput(['maxlength' => true]) ?>
    <div class="form-group col-lg-4">
    <?= $form->field($model, 'data_sheet')->fileInput() ?>
  
	<?php 
	$file = Yii::getAlias('@frontend/web/uploads/data_sheets/') . "$model->data_sheet";
    $screen_path = '/uploads/data_sheets/'.$model->data_sheet;
	if (file_exists($file) && $model->data_sheet){ ?>
		<div class="form-group field-company-company_name required">
		<?php 
        echo $model->data_sheet;
        //Html::img($screen_path, ['width' => '200px', 'alt3'=> $model->firstname]);?>
         
		</div>	
	<?php } ?>
    </div>
    


    

</div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success w-100']) ?>
    </div>



    <?php ActiveForm::end(); ?>

</div>
