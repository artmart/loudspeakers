<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="uploads-search">
    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get', 'options' => ['data-pjax' => 1]]); ?>
    <?php // echo $form->field($model, 'id') ?>
    <?= $form->field($model, 'user_id') ?>
    <?= $form->field($model, 'file_name') ?>
    <?php // $form->field($model, 'description') ?>
    <?php // echo $form->field($model, 'file') ?>
    <?php // echo $form->field($model, 'upload_date') ?>
    <?php // echo $form->field($model, 'upload_type') ?>
    <?php //echo $form->field($model, 'status') ?>
    <?php // echo $form->field($model, 'import_mapping') ?>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>