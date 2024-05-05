<?php
use yii\helpers\Html;

$this->title = 'Update Transducer';// . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="Targets-update">
<!--
    <h1><?php // Html::encode($this->title) ?></h1>
    -->
<div class="col-md-12 col-sm-12">
<div class="x_panel">
  <div class="x_title">
    <?= $this->render('_form', ['model' => $model]) ?>
  </div>
</div>
</div>
</div>