<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\TransducersSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="transducers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'manufacturer') ?>

    <?= $form->field($model, 'model') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 're') ?>

    <?php // echo $form->field($model, 'z1k') ?>

    <?php // echo $form->field($model, 'z10k') ?>

    <?php // echo $form->field($model, 'le') ?>

    <?php // echo $form->field($model, 'leb') ?>

    <?php // echo $form->field($model, 'ke') ?>

    <?php // echo $form->field($model, 'rss') ?>

    <?php // echo $form->field($model, 'fs') ?>

    <?php // echo $form->field($model, 'qms') ?>

    <?php // echo $form->field($model, 'qes') ?>

    <?php // echo $form->field($model, 'qts') ?>

    <?php // echo $form->field($model, 'rms') ?>

    <?php // echo $form->field($model, 'mms') ?>

    <?php // echo $form->field($model, 'cms') ?>

    <?php // echo $form->field($model, 'vas') ?>

    <?php // echo $form->field($model, 'sd') ?>

    <?php // echo $form->field($model, 'bl') ?>

    <?php // echo $form->field($model, 'pmax') ?>

    <?php // echo $form->field($model, 'xmax') ?>

    <?php // echo $form->field($model, 'beta') ?>

    <?php // echo $form->field($model, 'uspl') ?>

    <?php // echo $form->field($model, 'bl2_re') ?>

    <?php // echo $form->field($model, 'revision') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'vocc') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'diameter_oa') ?>

    <?php // echo $form->field($model, 'height_oa') ?>

    <?php // echo $form->field($model, 'target_curve') ?>

    <?php // echo $form->field($model, 'test_signal') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'webpage') ?>

    <?php // echo $form->field($model, 'data_sheet') ?>

    <?php // echo $form->field($model, 'entered_by') ?>

    <?php // echo $form->field($model, 'entry_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
