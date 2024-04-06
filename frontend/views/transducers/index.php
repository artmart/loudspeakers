<?php

use frontend\models\Transducers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var frontend\models\TransducersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Transducers';
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
<div class="transducers-index">


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
        <?php // Html::a('Create Transducers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'manufacturer',
            'model',
            //'type',
            [
                'attribute' => 'type',
                'filter'=>$types_arr, //['1'=>'Active', '2'=>'Discontinued', '3'=>'Preliminary or Vintage'],
                'format' => 'raw',
                'value'=>  function($data) use ($types_arr) {
                       //var_dump($types_arr);
                        return $types_arr[$data->type];                      
                    }, 
            ],
            //'size',
            //'status',
            [
                'attribute' => 'status',
                'filter'=>['1'=>'Active', '2'=>'Discontinued', '3'=>'Preliminary or Vintage'],
                'format' => 'raw',
                'value'=>  function($data) {
                        $arr_values = ['1'=>'Active', '2'=>'Discontinued', '3'=>'Preliminary or Vintage'];
                        return $arr_values[$data->status];                      
                    }, 
            ],
            //'re',
            //'z1k',
            //'z10k',
            //'le',
            //'leb',
            //'ke',
            //'rss',
            //'fs',
            //'qms',
            //'qes',
            //'qts',
            //'rms',
            //'mms',
            //'cms',
            //'vas',
            //'sd',
            //'bl',
            //'pmax',
            //'xmax',
            //'beta',
            //'uspl',
            //'bl2_re',
            //'revision',
            //'updated',
            //'vocc',
            //'weight',
            //'diameter_oa',
            //'height_oa',
            //'target_curve',
            //'test_signal',
            //'cost',
            //'webpage',
            //'data_sheet',
            //'entered_by',
            'entry_time',
            [
                'class' => ActionColumn::className(),
                'template'=>'{view} {update} {delete}', //
                'urlCreator' => function ($action, Transducers $model, $key, $index, $column) {
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
