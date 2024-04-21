<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Types;
use frontend\models\User;
use frontend\assets\ChartsAsset;
use Shuchkin\SimpleCSV;

use common\components\ComplexNumber;

//$complex1 = new ComplexNumber(2, 3); 
//$complex2 = new ComplexNumber(1, -2); 
  
//$quotient = $complex1->divide($complex2); 
//$magnitude = $complex1->magnitude(); 
//$conjugate = $complex1->conjugate(); 
  
//echo "Quotient: $quotient, Magnitude: $magnitude, Conjugate: $conjugate"; 



$this->title = $model->model;
$this->params['breadcrumbs'][] = ['label' => 'Transducers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

ChartsAsset::register($this);
?>
<div class="transducers-view">


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
<div class="col-md-4">
    <div class="table-responsive table-sm">  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'manufacturer',
            //'model',
            //'type',
            [
                'attribute' => 'type',
                'format' => 'raw',
                'value'=>  function($data) {
                        $type = Types::findOne(['id' => $data->type]);
                        return $type->type;                      
                    }, 
            ],
            
            
            'size',
            //'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value'=>  function($data) {
                        $arr_values = ['1'=>'Active', '2'=>'Discontinued', '3'=>'Preliminary or Vintage'];
                        return $arr_values[$data->status];                      
                    }, 
            ],
            're',
            'z1k',
            'z10k',
            'le',
            'leb',
            'ke',
            'rss',
            'fs',
            'qms',
            'qes',
            'qts',
            'rms',
            'mms',
            'cms',
            'vas',
            'sd',
            'bl',
            'pmax',
            'xmax',
            'beta',
            'uspl',
            'bl2_re',
            'revision',
            'updated',
            'vocc',
            'weight',
            'diameter_oa',
            'height_oa',
            'target_curve',
            'test_signal',
            'cost',
            //'webpage',
            [
                'attribute' => 'webpage',
                'format' => 'url', 
            ],
            'data_sheet',
            //'entered_by',
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
<div class="col-md-8">

<?php 
$re = $model->re;
//            'z1k',
//            'z10k',
$le = $model->le/1000;
//            'leb',
//            'ke',
//            'rss',
$fs = $model->fs;
//            'qms',
//            'qes',
//            'qts',
$rms = $model->rms;
$mms = $model->mms/1000;
$cms = $model->cms/1000;
//           'vas',
$sd = $model->sd;
$bl = $model->bl;
//            'pmax',
//            'xmax',
//            'beta',
//            'uspl',
//            'bl2_re',
//            'revision',
//            'updated',
//            'vocc',
//            'weight',
//            'diameter_oa',
//            'height_oa',
//            'test_signal',
//            'cost',






//////My Code/////

function logspace($start,$end,$num)
{
    $arr = [];
    $logMin=$start;
    $logMax=$end;
    $delta=($logMax-$logMin)/$num;
    $accDelta=0;

    for($i=0;$i<=$num;$i++)
    {
        $num_i=pow(M_E,$logMin+$accDelta);
        $arr[]=$num_i;
        $accDelta+=$delta;
    }        
return $arr;
}


function iso_round($value, $roundTo)
{
    $mod = $value % $roundTo;
    return $value+($mod<($roundTo/2)?-$mod:$roundTo-$mod);
}




function iso_round1($value, $roundTo,$type='round')
    {
        $mod = $value%$roundTo;
        if($type=='round'){
            return $value+($mod<($roundTo/2)?-$mod:$roundTo-$mod);
        }elseif($type=='floor'){
            return $value+($mod<($roundTo/2)?-$mod:-$mod);
        }elseif($type=='ceil'){
            return $value+($mod<($roundTo/2)?$roundTo-$mod:$roundTo-$mod);
        }

    }



function getClosest($search, $arr) {
   $closest = null;
   foreach ($arr as $item) {
      if ($closest === null || abs($search - $closest) > abs($item - $search)) {
         $closest = $item;
      }
   }
   return $closest;
}
//////////////////////



function isospace($start_freq, $stop_freq, $resolution){
#% ISOSPACE generates logarithmically spaced frequencies with ISO preferred numbers 
#% starting at START_FREQ and ending at STOP_FREQ. The spacing between numbers is
#% such that RESOLUTION has units of points per octave.
#% 
#% Author:    Ryan Mihelich
#% Company:   HARP Consulting LLC
#% Date:      December 5, 2023
#%
#% Copyright (c) 2023 HARP Consulting LLC
#%
#% -------------------------------------------------------------------------

#% Generate logarithmically spaced frequencies with ISO preferred numbers.
$allowed = [0.5, 1, 3, 6, 12, 24, 48, 96, 192, 384];
#% set the resolution to the closest valid value

foreach($allowed as $alow){
    $d[] = abs($alow-$resolution);
}


//$d = abs($allowed - $resolution);
$dd = min($d);
$resolution = getClosest($dd, $allowed); //    $allowed[array_search($dd, $allowed)];

#% Calculate the number of points needed for the desired resolution.
$points = ceil($resolution * log($stop_freq / $start_freq, 2) + log($stop_freq / $start_freq, 10));

#% Generate a logarithmically spaced vector with twice the calculated points.
$frequencies = logspace(log10($start_freq), log($stop_freq, 10), 2 * $points);

#% Check if the resolution is supported (ISO preferred numbers).
if(in_array($resolution, $allowed)){ // ismember($resolution, $allowed)
    #% Round each frequency to the nearest preferred number.
	$cnt = count($frequencies);
    for($idx = 1; $idx<=$cnt; $idx++){ 
	// idx = 1:length(frequencies)
        $frequencies[$idx-1] = round($frequencies[$idx-1]); //iso_round  , $resolution
    }
    
    #% Remove duplicate frequencies to ensure uniqueness.
    $unique_frequencies = array_unique($frequencies); // unique($frequencies);
    foreach($unique_frequencies as $k=>$u){
        if($u>0){
            $frequencies[$k] = $u;
        }
        
    }
    
    #% Remove zero values, if any.
    //$unique_frequencies = $unique_frequencies(unique_frequencies > 0);
    
    #% Return the final frequency vector.
    //$frequencies = unique_frequencies(:);
    return $frequencies;
}else{
    #% Error for unsupported preferred number resolution.
    echo  'Unsupported preferred number resolution.';

}

}


function generate_freq_list($freq_start, $freq_end, $ppo){

    //ppo means points per octave
   
    $numStart = ceil(log($freq_start/1000, 2)*$ppo);
    $numEnd = ceil(log($freq_end/1000, 2)*$ppo);
    
    for($i=$numStart; $i<=$numEnd + 1; $i=$i+1){
    
    $freq_array[] = round(1000*pow(2,$i/$ppo));
    
    }
    return $freq_array;

}


$start_freq = 10;
$stop_freq = 20000;

$resolution = 100;
 
$freq = generate_freq_list($start_freq, $stop_freq, $resolution); //(10, 3000, 48*8); //($start_freq, $stop_freq, $resolution); // isospace($start_freq, $stop_freq, $resolution);

//var_dump($freq);
//exit;

///////////////////////////////

$re2 = 0;
$le2 = 0.001;
$kms = $mms*Pow($fs*2*M_PI, 2); //1000/$cms; //  // Kms = Mms * (self.fs * 2 * np.pi)**2

//$freq = 100; /////??????
$_1i = 1;


$rho0 = 1.18;                                       
$c = 345;                                                
$refI = pow(10, -12); // 10^-12;
$P0 = 100000;
$gamma = 1.4;
$refp = 0.00002;// 20e-6;
$SourceSpace = 2;
$Ditance = 1;

$k = 0;
$impedance_data = [];

//$freq = [10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 11000, 12000, 13000, 14000, 15000, 16000, 17000, 18000, 19000, 20000];



foreach ($freq as $f) {

//for($f=0.1; $f<=200; $f=$f+1){
    $z_electrical[$k] = new ComplexNumber($re, 2*M_PI*$f*$le);
    $z_mechanical[$k] = new ComplexNumber($rms, 2*M_PI*$f*$mms-1/(2*M_PI*$f*$cms));
        $complex1 = new ComplexNumber($bl*$bl, 0);
    $z_me[$k] = $complex1->divide($z_mechanical[$k]); 
    $z[$k] = new ComplexNumber( $z_electrical[$k]->getReal()+$z_me[$k]->getReal(), $z_electrical[$k]->getImaginary()+$z_me[$k]->getImaginary());
    
    $magnitude[$k] = $z[$k]->magnitude(); 
    
    $impedance_data[] = ['name'=>"$f", 'y'=>floatval($magnitude[$k])];
    
    $k++;
    
    
    
    
    
    
    
    
    
    
    
    
    
    

  //$w[] = 2*M_PI*$f;

}

//var_dump($magnitude);

/*
//$w = 2*M_PI*$freq;
$s = $w; // $_1i*$w;
#% Electrical impedance of electrical side of the transformer
$Z_elec = $s*$le + $re + ($re2+pow(10, -12))*$s*($le2+pow(10, -12)) / (($re2+pow(10, -12)) +  $s*($le2+pow(10, -12)));
#% Mechanical impedance of mechanical side of the transfomer
$Z_mech = $s*$mms + $rms + $kms/$s;
$Z_ac    =  $Z_rad_c + $Z_enc_r;                               #% Total Acoustic Impedance or cone + rear enclosure
$Z_ac_m  =  $sd^2*$Z_ac;                                       #% Mechanical Impedance of Acoustic Circuit
$Z_mechac = $Z_mech + $Z_ac_m;                                 #% Total mechanical impedance
$Z_mechac_e = pow($bl,2)/$Z_mechac;                            #% Total electrical impedance due to mechanical and acoustic circuit elements
$Z = $Z_elec + $Z_mechac_e;                                    #% Total electrical Impedance including mechanical and acoustic circuit elements
$I_1V = 1 / $Z;                                                #% Electrical current at 1V Input
$f_mechac = $bl*$I_1V;                                         #% Mechanical Force on Mechanical-acoustical Circuit
$u_mechac = $f_mechac / $Z_mechac;                             #% Mechanical Velocity
$p_ac = $u_mechac*$Z_ac_m/$sd;                                 #% Acoustic pressure in circuit at 1V input
$U_ac = $p_ac / $Z_ac;                                         #% Acoustic volume velocity in circuit at 1V input
$p_far = $U_ac * ($rho0*$s/$SourceSpace/M_PI/$Distance);       #% Acoustic pressure under specified conditions



*/

//$complex1 = new ComplexNumber(2, 3); 
//$complex2 = new ComplexNumber(1, -2); 
  
//$quotient = $complex1->divide($complex2); 
//$magnitude = $complex1->magnitude(); 
//$conjugate = $complex1->conjugate(); 









///////////////////////////////////////////////
#% Date:      December 5, 2023
#%
#% Copyright (c) 2023 HARP Consulting LLC
#%
#% -------------------------------------------------------------------------

#% Generate logarithmically spaced frequencies with ISO preferred numbers.
//$allowed = [0.5, 1, 3, 6, 12, 24, 48, 96, 192, 384];
#% set the resolution to the closest valid value
//$d = abs($allowed - $resolution);
//$resolution = $allowed(d == min(d));

#% Calculate the number of points needed for the desired resolution.
//$points = ceil($resolution * log2($stop_freq / $start_freq) + log10($stop_freq / $start_freq));

#% Generate a logarithmically spaced vector with twice the calculated points.
//$frequencies = logspace(log10($start_freq), log10($stop_freq), 2 * $points);

?>
<hr />
 <div id="chart1"></div>
<hr />

 <div id="chart2"></div>
<script>
Highcharts.chart('chart1', {
    chart: {type: 'line'},
    title: {
        text: 'Impedance',
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
            }
        }
    },
    credits: {enabled: false},
    plotOptions: {
			series: {
              	//boostThreshold:100000,
                turboThreshold: 100000
              }
            },
    series: [
        {
            //boostThreshold: 0,
            name: 'Impedance',
            colorByPoint: true,
            data: <?=json_encode($impedance_data);?>
        }
        ]
});

</script>



<?php 

//////////////////////////////////////////////////////////////////////////////////////
    $alias = Yii::getAlias("@frontend/web/uploads/target_curves");
    $path = $alias . DIRECTORY_SEPARATOR . $model->target_curve;
    
    //$path1 = Yii::getAlias("@frontend").'/web/uploads/target_curves/'.$file_target_curve;
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
Highcharts.chart('chart2', {
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
