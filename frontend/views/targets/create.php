<?php
use yii\helpers\Html;

$this->title = 'Create New Target';
$this->params['breadcrumbs'][] = ['label' => 'Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Targets-create">
<!--
    <h1><?php // Html::encode($this->title) ?></h1>
-->
<div class="col-md-12 col-sm-12">
<div class="x_panel">
  <div class="x_title">
    <h2><?= Html::encode($this->title) ?></h2>
    <ul class="nav navbar-right panel_toolbox">
      <!--<li> <a href="/invite" target="_blank" class="btn btn-success"><i class="fa fa-plus"></i> Create New Invite</a></li>-->
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
</div>
</div>
