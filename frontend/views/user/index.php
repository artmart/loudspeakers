<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
<?php /*
<div class="row">
    <h1 class="col-sm-10"><?= Html::encode($this->title) ?></h1>
    <p class="col-sm-2 d-flex justify-content-end">
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i>  Add', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
<hr />
*/ ?>


<div class="col-md-12 col-sm-12">
<div class="x_panel">
  <div class="x_title">
    <h2>Users</h2>
    <ul class="nav navbar-right panel_toolbox">
      <!--<li> <a href="/invite" target="_blank" class="btn btn-success"><i class="fa fa-plus"></i> Create New Invite</a></li>-->
      <?= Html::a('<i class="fa fa-plus"></i> Add', ['create'], ['class' => 'btn btn-success']) ?>
    </ul>
    <div class="clearfix"></div>
  </div>

  <div class="x_content">
    <div class="table-responsive">   
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            'firstname',
            'lastname',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            //'user_group',
            [
                'attribute' => 'user_group',
                'filter'=>['1' => 'Administrator', '2' => 'User'],
                'format' => 'raw',
                'value'=>function($data) {
                    $arr = ['1' => 'Administrator', '2' => 'User'];
                    return $arr[$data->user_group];
                    },  
            ],
            [
                'attribute' => 'status',
                'filter'=>['10' => 'Active', '9' => 'Inactive'],
                 'format' => 'raw',
                'value'=>  function($data) {return ($data->status==10)?'Active':'Inactive';}, 
            ],
            
            //'created_at',
            //'updated_at',
            //'verification_token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>
</div>
</div>
</div>