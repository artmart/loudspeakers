<?php
//require "vendor/autoload.php";

use yii\helpers\Html;
use yii\widgets\DetailView;
//use frontend\models\Types;
use frontend\models\User;
use frontend\assets\ChartsAsset;
use Shuchkin\SimpleCSV;
//use SciPhp\NumPhp as np;
//use common\components\ComplexNumber;


$this->title = $model->target;
$this->params['breadcrumbs'][] = ['label' => 'Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

ChartsAsset::register($this);
?>
<div class="Targets-view">


<div class="col-md-12 col-sm-12">
<div class="x_panel">
  <div class="x_title">
    <h2><?= Html::encode($this->title) ?></h2>
    <ul class="nav navbar-right panel_toolbox">
        <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post'],
        ]) ?>
    </p>
    </ul>
    <div class="clearfix"></div>
  </div>

  <div class="x_content">
<div class="col-md-3">
    <div class="table-responsive table-sm">  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'target',
            'updated',
            //'file_name',
            [
                'attribute' => 'target_curve',
                'format' => 'raw',
                //'name' =>'Download',
                'value'=>  function($data) {
                        //$alias = Yii::getAlias("@frontend/web/uploads/target_curves")."/".$data->target_curve;
                        $path1 ='/uploads/target_curves/'.$data->target_curve;
                        //$btn ='<button type="submit" onclick="window.location='.$path1.';">Download</button>';
                        $btn = '<a style="color: blue;" href="'.$path1.'" download>'.$data->file_name.'</a>';

                        return $btn;                    
                    } 
            ],
            [
                'attribute' => 'entered_by',
                'format' => 'raw',
                'value'=>  function($data) {
                        $user = User::findOne(['id' => $data->entered_by]);
                        return $user->firstname. " " . $user->lastname;                   
                    }, 
            ],
            'entry_time',
        ],
    ]) ?>
    
</div>
</div>
<div class="col-md-9">

<hr />
<div id="chart3"></div>

<?php 

//////////////////////////////////////////////////////////////////////////////////////
    $alias = Yii::getAlias("@frontend/web/uploads/target_curves");
    $path = $alias . DIRECTORY_SEPARATOR . $model->target_curve;
    
    //
if(file_exists($path) && $model->target_curve){
                   
    if ( $csv = SimpleCSV::import($path) ) {
        $json = json_encode($csv);
        
        foreach($csv as $r){
            if(isset($r[0]) && isset($r[1]))
          
            $chart_data[] = ['name'=>$r[0], 'y'=>floatval($r[1])]; 
        }
        //var_dump($csv);
        
        //$chart_data=[];
      //$model->target_curve
    }

?>


<script>
Highcharts.chart('chart3', {
    chart: {type: 'line'},
    title: {
        text: 'Target Curve',
        align: 'center'
    },
   
    xAxis: {type: 'category'},
    yAxis: {
        title: {text: ''}
    },
    legend: {enabled: false},
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                //enabled: true,
                format: '{point.y:.0f}'
            },
            marker: {
                enabled: false,
                states: {
                    hover: {
                        enabled: false
                    }
                }
            }
        }
    },    
    credits: {enabled: false},
    series: [
        {
            name: 'Target Curve',
            colorByPoint: true,
            data: <?=json_encode($chart_data);?>
        }
        ]
});
</script>

<?php } ?>

</div>

</div>
</div>
</div>

</div>
