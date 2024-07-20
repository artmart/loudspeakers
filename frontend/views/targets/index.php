<?php
use frontend\models\Targets;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Targets';
$this->params['breadcrumbs'][] = $this->title;

use frontend\models\Types;
//use frontend\models\Status;


$types = Types::find()->orderBy('type')->all();
$types_arr = [];
foreach($types as $t){
    $types_arr[$t->id]= $t->type;
}
//var_dump($types_arr[2]);
//exit;
?>
<div class="Targets-index">


<div class="col-md-12 col-sm-12">
<div class="x_panel">
  <div class="x_title">
    <h2><?= Html::encode($this->title) ?></h2>
    <ul class="nav navbar-right panel_toolbox">
      <!--<li> <a href="/invite" target="_blank" class="btn btn-success"><i class="fa fa-plus"></i> Create New Invite</a></li>-->
      <?= Html::a('<i class="fa fa-plus"></i> Add', ['create'], ['class' => 'btn btn-success']) ?>
    </ul>
    <div class="clearfix"></div>
  </div>

  <div class="x_content">
    <div class="table-responsive">  



    <p>
        <?php // Html::a('Create Targets', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'target',
            'updated',
            //'entered_by',
            'entry_time',
            [
                'class' => ActionColumn::className(),
                'template'=>'{view} {update} {delete}', //
                'urlCreator' => function ($action, Targets $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
</div>
</div>
</div>

</div>
