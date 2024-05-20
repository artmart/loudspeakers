<?php
//require "vendor/autoload.php";

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Types;
use frontend\models\User;
use frontend\assets\ChartsAsset;
use Shuchkin\SimpleCSV;
use SciPhp\NumPhp as np;
use common\components\ComplexNumber;

//$complex1 = new ComplexNumber(2, 3); 
//$complex2 = new ComplexNumber(1, -2); 
  
//$quotient = $complex1->divide($complex2); 
//$magnitude = $complex1->magnitude(); 
//$conjugate = $complex1->conjugate(); 
  
//echo "Quotient: $quotient, Magnitude: $magnitude, Conjugate: $conjugate"; 



$this->title = $model->model;
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
<div class="col-md-9">

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
$sd = $model->sd/10000;
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
//$frequencies = logspace(log10($start_freq), log($stop_freq, 10), 2 * $points);

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
        $xx = round(1000*pow(2,$i/$ppo));
    if($xx<=1000){
        $freq_array[] = $xx;
    }
    
    }
    return array_unique($freq_array);

}


$start_freq = 20;
$stop_freq = 1000;
$resolution = 48;
$points = ceil($resolution * log($stop_freq / $start_freq, 2) + log($stop_freq / $start_freq, 10));





//$freq = np::logspace(2, 5, 4, true, 2); //$frequencies = logspace(log10($start_freq), log($stop_freq, 10), 2 * $points);
 
 function logspace2($start,$end,$num)
{
    $arr=array();
    $logMin=log($start);
    $logMax=log($end);
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
 
 //logspace2($start_freq, $stop_freq, $resolution); // 
 
//$freq = generate_freq_list($start_freq, $stop_freq, $resolution); //(10, 3000, 48*8); //($start_freq, $stop_freq, $resolution); // isospace($start_freq, $stop_freq, $resolution);
//$freq = isospace($start_freq, $stop_freq, $resolution);
//var_dump($freq);
//exit;

///////////////////////////////

$re2 = 0;
$le2 = 0.001;
$kms = $mms*Pow($fs*2*M_PI, 2); //1000/$cms; //  // Kms = Mms * (self.fs * 2 * np.pi)**2

//$freq = 100; /////??????
//$_1i = 1;


$rho0 = 1.18;                                       
$c = 345;                                                
$refI = pow(10, -12); // 10^-12;
$P0 = 100000;
$gamma = 1.4;
$refp = 0.00002;// 20e-6;
$SourceSpace = 2;
$distance = 1;



$impedance_data = [];
$frequency_response_data = [];

//$freq1 = [10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 11000, 12000, 13000, 14000, 15000, 16000, 17000, 18000, 19000, 20000];
//$freq2 = [10, 50, 100, 500, 1000, 5000, 10000, 15000, 20000];

//$freq = $freq1; 

$categories = [];

//asort($freq);
$freq = [20,20.3,20.6,20.9,21.2,21.5,21.8,22.1,22.4,22.7,23,23.3,23.6,23.9,24.3,24.6,25,25.4,25.8,26.1,26.5,26.8,27.2,27.6,28,28.5,29,29.5,30,30.3,30.7,31.1,31.5,32,32.5,33,33.5,34,34.5,35,35.5,36,36.5,37,37.5,38.1,38.7,39.3,40,40.6,41.2,41.8,42.5,43.1,43.7,44.3,45,45.6,46.2,46.8,47.5,48.1,48.7,49.3,50,50.7,51.5,52.2,53,53.7,54.5,55.2,56,57,58,59,60,60.7,61.5,62.2,63,64,65,66,67,68,69,70,71,72,73,74,75,76.2,77.5,78.7,80,81.2,82.5,83.7,85,86.2,87.5,88.7,90,91.2,92.5,93.7,95,96.2,97.5,98.7,100,101,103,104,106,107,109,110,112,113,115,116,118,120,121,123,125,127,128,130,132,134,136,138,140,142,145,147,150,152,155,157,160,162,165,167,170,172,175,177,180,182,185,187,190,192,195,197,200,203,206,209,212,215,218,221,224,227,230,233,236,239,243,246,250,254,258,261,265,268,272,276,280,285,290,295,300,303,307,311,315,320,325,330,335,340,345,350,355,360,365,370,375,381,387,393,400,406,412,418,425,431,437,443,450,456,462,468,475,481,487,493,500,507,515,522,530,537,545,552,560,570,580,590,600,607,615,622,630,640,650,660,670,680,690,700,710,720,730,740,750,762,775,787,800,812,825,837,850,862,875,887,900,912,925,937,950,962,975,987,1000,1010,1030,1040,1060,1070,1090,1100,1120,1130,1150,1160,1180,1200,1210,1230,1250,1270,1280,1300,1320,1340,1360,1380,1400,1420,1450,1470,1500,1520,1550,1570,1600,1620,1650,1670,1700,1720,1750,1770,1800,1820,1850,1870,1900,1920,1950,1970,2000,2030,2060,2090,2120,2150,2180,2210,2240,2270,2300,2330,2360,2390,2430,2460,2500,2540,2580,2610,2650,2680,2720,2760,2800,2850,2900,2950,3000,3030,3070,3110,3150,3200,3250,3300,3350,3400,3450,3500,3550,3600,3650,3700,3750,3810,3870,3930,4000,4060,4120,4180,4250,4310,4370,4430,4500,4560,4620,4680,4750,4810,4870,4930,5000,5070,5150,5220,5300,5370,5450,5520,5600,5700,5800,5900,6000,6070,6150,6220,6300,6400,6500,6600,6700,6800,6900,7000,7100,7200,7300,7400,7500,7620,7750,7870,8000,8120,8250,8370,8500,8620,8750,8870,9000,9120,9250,9370,9500,9620,9750,9870,10000,10100,10300,10400,10600,10700,10900,11000,11200,11300,11500,11600,11800,12000,12100,12300,12500,12700,12800,13000,13200,13400,13600,13800,14000,14200,14500,14700,15000,15200,15500,15700,16000,16200,16500,16700,17000,17200,17500,17700,18000,18200,18500,18700,19000,19200,19500,
19700,20000];

$tickPositions = [20, 30, 40, 50, 60, 70, 80, 90, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 15000, 19000, 20000];

//var_dump($freq);
//exit;

$k = 0;

//$freq = [100];

foreach($freq as $f){

//for($f=0.1; $f<=200; $f=$f+1){
    $z_electrical[$k] = new ComplexNumber($re, 2*M_PI*$f*$le);
    $z_mechanical[$k] = new ComplexNumber($rms, 2*M_PI*$f*$mms-1/(2*M_PI*$f*$cms));
    
    
    
        $complex1 = new ComplexNumber($bl*$bl, 0);
    $z_me[$k] = $complex1->divide($z_mechanical[$k]); 
    $z[$k] = new ComplexNumber($z_electrical[$k]->getReal()+$z_me[$k]->getReal(), $z_electrical[$k]->getImaginary()+$z_me[$k]->getImaginary());
    
    $magnitude[$k] = $z[$k]->magnitude();
    //$categories[] =  $f; 

    //$impedance_data[] = ['name'=>"$f", 'x'=>intval($f), 'y'=>floatval($magnitude[$k])];
    //$impedance_data[] = [$f, floatval($magnitude[$k])];
    $impedance_data[] = floatval($magnitude[$k]);
    
 ///////////////////////////////////////////////////////////////  
 
 
$complex2 = new ComplexNumber($bl, 0);  
//$I_1V     // 1 ./ Z; 		// This means to take each impedance value (complex) and invert it. If the value was 2 + 3i then its 1/(2+3i)

$f_mechac = $complex2->divide($z[$k]);  
    

//$f_mechac = $bl * I_1V 	// multiply the above by Bl from the database


/////

// Electrical impedance of electrical side of the transformer
// Z_elec = s*Le + Re + (Re2+1e-12)*s*(Le2+1e-12) / ((Re2+1e-12) +  s*(Le2+1e-12));
// Mechanical impedance of mechanical side of the transfomer
// Z_mec = s*Mms + Rms + Kms./s;
//$Z_rad_c = 1;
//$Z_enc_r = 1;  
$Z_ac    =  1; //$Z_rad_c + $Z_enc_r;                                               // Total Acoustic Impedance or cone + rear enclosure
$Z_ac_m  =  pow($sd, 2)*$Z_ac; 

////

$u_mechac[$k] = $f_mechac->divide($z_mechanical[$k]); // $f_mechac ./ $u_mechac; 		// you should have u_mechac as an intermediate value from Impedance math. Use that and divide (element-by-element) f_mechac / u_mechac

$p_ac[$k] = $u_mechac[$k]->multiply(new ComplexNumber($sd, 0)); // $u_mechac[$k]->multiply(new ComplexNumber($Z_ac_m/$sd, 0));           // you should have Z_ac_m from impedance math. Divide by Sd from the database

$U_ac[$k] = $p_ac[$k]->divide(new ComplexNumber($Z_ac, 0)); 


$w = 2*M_PI*$f;
$s = new ComplexNumber(0, $w);//1i*$w;

// element by element division
$p_far[$k] = $U_ac[$k]->multiply($s)->multiply(new ComplexNumber(($rho0/$SourceSpace/M_PI/$distance), 0));  		// rho0 = 1.18; s = i*2*pi*frequency; SourceSpace = 2; Distance = 1;

//p_far is what you want to plot in dB.
//0.0022 + 0.0113i

//$p_far_plot[$k] = new ComplexNumber(20*0.0022/0.00002, 20*0.0113/0.00002); // new ComplexNumber(20*log($p_far[$k]->magnitude(), 10)/0.00002, 20*atan($p_far[$k]->getImaginary()/$p_far[$k]->getReal())/0.00002); // 20*log($p_far[$k], 10);
//$frequency_response_data[] = $p_far_plot;

$suffix = 'i';
   $complexObject = new Complex\Complex($p_far[$k]->getReal()/0.00002, $p_far[$k]->getImaginary()/0.00002, $suffix);
  //  print_r(atan($p_far[$k]->getImaginary()/$p_far[$k]->getReal())); echo "<br />";
 $gggg = $complexObject->log10();
 //echo new ComplexNumber($gggg)->magnitude();   
    //echo  20*$gggg->abs();
    //$frequency_response_data[] = [$f, 20*$gggg->abs()]; //$p_far_plot[$k]->magnitude()];
 //var_dump($p_far); 
 //$frequency_response_data[] = $p_far_plot[$k]->magnitude();
 $frequency_response_data[] = 20*$gggg->abs();
 
 
 ////////////////////////////////////   
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


//$sum = $complex1->add($complex2); 
//$difference = $complex1->subtract($complex2); 
//$product = $complex1->multiply($complex2); 







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
<hr />
<div id="chart3"></div>
<script>
Highcharts.chart('chart1', {
    chart: {type: 'spline'},
    title: {
        text: 'Impedance',
        align: 'center'
    },
   
    xAxis: {//type: 'category',
    //categories: <?=json_encode($freq);?>, 
    //max: 20000,
    //min: 0,
    //crosshair: true,
    //tickPositions: <?=json_encode($tickPositions);?>,
    gridLineWidth: '1',
    //lineWidth: 1,
    //alignTicks: true,
    /*labels: {
                formatter: function() {
                    return this.value.toString().substring(0, 6);
                },    
    */
    
    },
    yAxis: {
        title: {text: ''},

    },
    legend: {enabled: false},
    credits: {enabled: false},
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                //enabled: true,
                format: '{point.y:.0f}'
            },

              	//boostThreshold:100000,
                //turboThreshold: 100000,

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
    series: [
        {
            //boostThreshold: 0,
            name: 'Impedance',
            //type: 'logarithmic',
            //colorByPoint: true,
            data: <?=json_encode($impedance_data);?>
        }
        ]
});



Highcharts.chart('chart2', {
    chart: {type: 'spline', "zoomType":"x",},
    title: {
        text: 'Frequency Response',
        align: 'center'
    },
   
    xAxis: {//type: 'category',
    //categories: <?=json_encode($freq);?>, 
    //max: 500,
    min: 0,

    //crosshair: true,
    

    //tickPositions: <?=json_encode($tickPositions);?>,
    gridLineWidth: '1',
    ordinal: true, 
//Interval: 100,
    //tickInterval: 100,
    //lineWidth: 1,
    //alignTicks: true,
    /*labels: {
                formatter: function() {
                    return this.value.toString().substring(0, 6);
                },    
    */
    
    },
    yAxis: {
        title: {text: ''},
    },
    legend: {enabled: false},
    credits: {enabled: false},
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                //enabled: true,
                format: '{point.y:.0f}'
            },
             //pointStart: 0,
            //pointInterval: 100, // one hour
            //relativeXValue: true,
            //pointIntervalUnit: 100,

             
              	//boostThreshold:100000,
                //turboThreshold: 100000,


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
    series: [
        {
            //boostThreshold: 0,
            name: 'Frequency Response',
            //type: 'logarithmic',
            //colorByPoint: true,
            data: <?=json_encode($frequency_response_data);?>
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
