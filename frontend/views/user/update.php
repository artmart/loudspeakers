<?php
use yii\helpers\Html;

$this->title = 'Update User: ' . $model->firstname . " " . $model->lastname;
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
if(Yii::$app->user->identity->user_group==1){
    $this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
}else{$this->params['breadcrumbs'][] = 'Users';}
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">
<?php /*
    <h1><?= Html::encode($this->title) ?></h1>
    <hr />
 */ ?>   
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
</div>