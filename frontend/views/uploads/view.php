<style>
.scroll {
  overflow: auto;
  white-space: nowrap;
}

.table tbody tr th, td{
    min-width: 200px;
}   
</style>

<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
//use frontend\models\Campaigns;

use yii\helpers\ArrayHelper;
//use frontend\models\Importedcsvdata;

//$imported_csv_data = new Importedcsvdata();
//$imported_csv_data_fields = array_keys($imported_csv_data->attributes); 

$this->title = "File: " . $model->file_name;
$this->params['breadcrumbs'][] = ['label' => 'Uploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
//$statuses = ['1'=>'Uploaded', '2'=>'Mapped & Imported'];
//$campaigns =  ArrayHelper::map(Campaigns::find()->orderBy('campaign')->asArray()->all(), 'id', 'campaign');
?>
<div class="uploads-view">
<div class="row">
    <div class="col-lg-11">
    <h2><?= Html::encode($this->title) ?></h2>
    </div>
    <div class="col-lg-1">

        <?php // echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger',
            'data' => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post'],
        ]) ?>

    
    </div>
</div>
    <hr />
    <div id="message"></div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'user_id',
            'file_name',
            //'description',
            //['attribute' => 'campaign_id', 'value'=>function($model) use ($campaigns){return $campaigns[$model->campaign_id];}],
            
            'file',
            'upload_date',
            //'upload_type',
            //'status',
            //'total_records',
            //'report',
            //['attribute' => 'status', 'format' =>'raw', 'value'=>function($model) use ($statuses) {return  $statuses[$model->status];}],
            //'import_mapping:ntext',
        ],
    ]) ?>
</div>

<?php /*if($model->status == 1){ ?>
<div id="process_area">
<h1>CSV Mapping & Import</h1>
<center>
<div id="my_loader" style="display: none;"><img src="/images/ajaxloader.gif" /><span class="sr-only">Loading...</span> </div>
</center>
<hr />

<?php
$html = '';
$alias = Yii::getAlias("@frontend/web/uploads");
$path = $alias . DIRECTORY_SEPARATOR . $model->file;
    
  $file_data = fopen($path, 'r');
  $file_data1 = fopen($path, 'r');
  $file_header = fgetcsv($file_data1);
  $column_cnt = count($file_header);

  $html .= '<table class="table table-bordered"><tr>';

  for($count = 0; $count < $column_cnt; $count++)
  {
   $html .= '<th>
                <select name="set_column_data" class="form-control set_column_data" data-column_number="'.$count.'">
                 <option value="">- Select -</option>
                 <option value="first_name">First Name</option>
                 <option value="last_name">Last Name</option>
                 <option value="email">Email</option>
                 <option value="phone">Phone</option>
                </select>
               </th>';
  }
  $html .= '</tr>';
  $limit = 0;

  while(($row = fgetcsv($file_data)) !== FALSE  && ($limit<5)){
    $limit++;
    $html .= '<tr>';
    for($count = 0; $count < $column_cnt; $count++){$html .= '<td>'.$row[$count].'</td>';}
    $html .= '</tr>';
  }
  $html .= '</table>';
?>

<div class="panel panel-primary">
<div class="panel-heading">CSV Mapping & Import
    <button type="button" class="btn btn-success btn-xs pull-right" name="import" id="import" >Import</button>
</div>
  <div class="panel-body scroll">
  <?= $html;?>
  </div>
</div> 
</div>
<script>
$(document).ready(function(){

  var total_selection = 0;
  var first_name = 0;
  var last_name = 0;
  var email = 0;
  var phone = 0;
  var column_data = [];

  $('#import').attr('disabled', 'disabled');

  $(document).on('change', '.set_column_data', function(){
    var column_name = $(this).val();
    var column_number = $(this).data('column_number');
    if(column_name in column_data){
      alert('You have already define '+column_name+ ' column');
      $(this).val('');
      const entries = Object.entries(column_data);
      for(const [key, value] of entries){if(value == column_number){delete column_data[key];}}
      return false;
    }

    if(column_name != ''){
      const entries = Object.entries(column_data);
      for(const [key, value] of entries){if(value == column_number){delete column_data[key];}}
      column_data[column_name] = column_number;
    }//else{
      
      //column_data[column_name] = column_number;
    //}

    total_selection = Object.keys(column_data).length;

    if(total_selection > 0 && isset(column_data.phone)){
      $('#import').attr('disabled', false);    
      first_name = column_data.first_name;
      last_name = column_data.last_name;
      email = column_data.email;
      phone = column_data.phone;
    }else{
      $('#import').attr('disabled', 'disabled');
    }

  });
    
$(document).on('click', '#import', function(event){
    event.preventDefault();

    $.ajax({
      url:"<?php echo Yii::$app->getUrlManager()->createUrl('uploads/import')  ; ?>",
      method:"POST",
      data:{upload_id: <?=$model->id; ?>, campaign_id: <?=$model->campaign_id;?>, path: '<?=$model->file; ?>', first_row: <?=$model->the_first_row_is_header;?>, first_name:first_name, last_name:last_name, email:email, phone:phone},
      beforeSend:function(){
        $("#my_loader").css("display", "block");
        $('#import').attr('disabled', 'disabled');
        $('#import').text('Importing...');
      },
      success:function(data)
      {
        $('#import').attr('disabled', false);
        $("#my_loader").css("display", "none");
        location.reload(); 
        //$('#import').text('Import');
        //$('#process_area').css('display', 'none');
        //$('#upload_area').css('display', 'block');
        //$('#upload_form')[0].reset();
        //$('#message').html("<div class='alert alert-success'>"+data+"</div>");
        //$('html, body').animate({scrollTop: $("#message").offset().top}, 1000);
        //$('#message').delay(5000).fadeOut('slow');
      }
    })
});
  
function isset (ref) { return typeof ref !== 'undefined' }
  
});
</script> 
<?php } */?>