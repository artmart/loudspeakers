<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->firstname . " " . $model->lastname;
if(Yii::$app->user->identity->user_group==1){
    $this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
}else{$this->params['breadcrumbs'][] = 'Users';}
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$statuses = ['10' => 'Active', '9' => 'Inactive'];
$usergroups = ['1' => 'Administrator', '2' => 'Staff', '3' => 'Manager'];
?>
<div class="user-view">
<?php /*
<div class="row clearfix">
    <h1 class="col-sm-9"><?= Html::encode($this->title) ?></h1>
    <p class="col-sm-3 d-flex justify-content-end">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
<hr />
*/ ?>

<div class="col-md-12 col-sm-12">
<div class="x_panel">
  <div class="x_title">
    <h2><?= Html::encode($this->title) ?></h2>
    <ul class="nav navbar-right panel_toolbox">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </ul>
    <div class="clearfix"></div>
  </div>

  <div class="x_content">
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'firstname',
            'lastname',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            //'status',
            ['attribute' => 'status', 'value' =>  $statuses[$model->status]],
            ['attribute' => 'user_group', 'value' =>  $usergroups[$model->user_group]],
            'created_at:date', 
            [
                'attribute' => 'profile_photo',        
                'format' => 'raw',
                'value'=>  function($model) {
                       // $arr_values = ['Pending'=>'alert-warning', 'Completed'=>'alert-primary'];
                       // return  '<div class="alert '.$arr_values[$data->status].' mb-0 p-1" role="alert">'.$data->status.'</div>';  
                        		
                        $file = Yii::getAlias('@frontend/web/uploads/') . "$model->profile_photo";
                        $screen_path = '/uploads/'.$model->profile_photo;
                		if (file_exists($file) && $model->profile_photo){ 
                			return Html::img($screen_path, ['width' => '200px', 'alt3'=> $model->firstname]);
                		 }                      
                    }, 
            ],
            //'updated_at',
            //'verification_token',
        ],
    ]) ?>
  </div>
  </div>
</div>
</div>
</div>