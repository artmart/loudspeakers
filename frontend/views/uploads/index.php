<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\models\User;
use frontend\models\Campaigns;

use yii\helpers\ArrayHelper;
//use frontend\models\States;
//use yii\widgets\ActiveForm;

$this->title = 'All Uploads';
$this->params['breadcrumbs'][] = $this->title;

$fullname = [];
$users = User::find()->orderBy('firstname')->asArray()->all(); 
foreach($users as $user){$fullname[$user['id']]= $user['firstname']. " " . $user['lastname'];}

//$statuses = ['1'=>'Uploaded', '2'=>'Mapped & Imported'];

//$campaigns =  ArrayHelper::map(Campaigns::find()->orderBy('campaign')->asArray()->all(), 'id', 'campaign');
?>

<?php // echo Html::dropDownList('action','',['d'=>'Delete','e'=>'Export'],['class'=>'form-control',])
//echo Html::dropDownList('state','', ArrayHelper::map(States::find()->orderBy('state')->all(), 'area_code', 'state'), ['class'=>'form-control selectpicker', 'prompt' => '- Select -']); 
?>

<div class="uploads-index">


<div class="col-md-12 col-sm-12">
<div class="x_panel">
  <div class="x_title">
    <h2><?= Html::encode($this->title) ?></h2>
    <ul class="nav navbar-right panel_toolbox">
      <!--<li> <a href="/invite" target="_blank" class="btn btn-success"><i class="fa fa-plus"></i> Create New Invite</a></li>-->
      <?= Html::a('<i class="fa fa-plus"></i> Upload New File', ['csvuploads/create'], ['class' => 'btn btn-success']) ?>
    </ul>
    <div class="clearfix"></div>
  </div>

  <div class="x_content">
   




<?php /*

    <div class="row">
    <div class="col-md-9">
    <h1 style="margin-top: 0px; margin-bottom: 0px;"><?= Html::encode($this->title) ?></h1>
    </div>
   
    <div class="col-md-3 pull-right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Upload New File', ['create'], ['class' => 'btn btn-success pull-right']) ?>
         <?php /*<button type="button" class="btn btn-primary pull-right" style="margin-right: 2px;" id="showhidebutton">Filter/Export</button>*//*?>
    </div>
    
    </div>
    <div class="clearfix"></div>
    <hr />
 */ ?>
    
    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
<!--
<div class="panel panel-primary" id="showhide">
<div class="panel-heading">Filter/Export</div>
  <div class="panel-body"> 
  <?php // yii\base\View::render('/uploads/export_form', ['model'=>$exportForm]); ?>
</div>
</div>
-->
<script>
/*
$(document).ready(function(){
    $("#showhide").hide();
    $("#showhidebutton").click(function(){
        $("#showhide").toggle();
        if($(this).text()=="Filter/Export"){$(this).text("Hide");}else{$(this).text("Filter/Export");}; 
    });
});*/
</script>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'grid',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'user_id',
          /*  ['class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($model, $key, $index, $column){
                        if($model->status == 2 && $model->total_records>0){return ['value' => $key];}
                        return ['disabled'=>true ]; /*'style' => ['display' => 'none']*//*
                    }
            ],*/
            ['attribute' => 'user_id', 'filter'=>$fullname, 'value'=>function($model) use ($fullname){return $fullname[$model->user_id];}],
            'file_name',
            //'description',
            //['attribute' => 'campaign_id', 'filter'=>$campaigns, 'value'=>function($model) use ($campaigns){return $campaigns[$model->campaign_id];}],
            //'file',
            'upload_date',
            //'upload_type',
            //'status',
            //['attribute' => 'status', 'filter'=>$statuses, 'format' =>'raw', 'value'=>function($model) use ($statuses) {return  $statuses[$model->status];}],
            //'total_records',
            //'import_mapping:ntext',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}{delete}'], //
        ],
    ]); ?>
 </div>   
<?php //ActiveForm::end(); //  Html::endForm();?> 
    <?php Pjax::end(); ?>
</div>

</div>
</div>
<script>
/*
 $('#form_id').submit(function(e){
    $("#form_id").submit(function(e){e.preventDefault();});
    //function bulkAction(a) {
        var keys = $('#grid').yiiGridView('getSelectedRows');
        if(keys.length==0){
            alert('Please select at least one row.');
            //$("#form_id").submit(function(){return false;});
            return false;
        }else{
           $('#form_id').submit(); 
        }
})
*/   
</script>
