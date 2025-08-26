<?php
//use backend\models\Endofdayfigures;
//use yii\widgets\ListView;
//use yii\widgets\Pjax;
use frontend\assets\ItemsAsset;
ItemsAsset::register($this);

$this->title = 'Loudspeaker Database';
$this->params['breadcrumbs'][] = $this->title;

?>
<script>

function filtrsort()
{$('#listing_container').html('');
    $('#page').val(0);
    page = 0;
    loadnewdata();
}
</script>

<div class="x_panel">
<main class="search row">

<style>
/* Hide the spin buttons in WebKit browsers */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Hide spin buttons in Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }

 .input-container {
    position: relative;
    display: inline-block;
}
.sort-icon {
    position: absolute;
    right: 10px; /* Adjust as needed */
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}

.noUi-horizontal .noUi-handle {
  width: 5px;
  height: 37px;
  right: 0px;
  top: -2px;
  color: black;
  background: black;
}

.noUi-handle {
  border: 1px solid #000;
  border-radius: 0px;
  background: #FFF;
  cursor: default;
  box-shadow: none; /*inset 0 0 1px #FFF,inset 0 1px 0px #EBEBEB,0 3px 6px -3px #BBB;*/
}

.noUi-handle:before, .noUi-handle:after {
display: none;
}
.noUi-target{
  border-radius: 0px;  
  border: none;
  background: #a7aaac;
  box-shadow: none;
  height: 33px;
}

.noUi-connect {
  background: var(--blue);
}

</style>

<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Transducers2;
use yii\helpers\ArrayHelper;

$tds2 = Transducers2::find()->distinct()->all();
$Brands = ArrayHelper::map($tds2,'Brand','Brand');
$Types = ArrayHelper::map($tds2,'Type','Type');

//var_dump($model->height_oa_sort);
?>
<!--<section class="results1">-->
<div class="transducers2-search w-100">

<?php $form = ActiveForm::begin(['id' => 'form_id', 'action' => ['index'], 'method' => 'post',  'options' => ['data-pjax' => false]]); ?>

<input type="hidden" id="page" name="page" value="0">

<div class="row">
<div class="col-md-12">
    <div class="col-md-3">
        <?php // $form->field($model, 'Brand') ?>

        <?= $form->field($model, 'Brand')->dropDownList($Brands, ['multiple' => true, 'class'=>'selectpicker form-control', 'selected' => true, 'onchange'=>'filtrsort()']); ?>
   
    </div>
    <div class="col-md-6">
        <?php // $form->field($model, 'Type') ?>
        <?= $form->field($model, 'Type')->dropDownList($Types, ['multiple' => true, 'class'=>'selectpicker form-control', 'selected' => true, 'onchange'=>'filtrsort()']); ?>
    </div>
    <div class="col-md-3">  
    <?=$this->render('slider_field', ['model' => $model, 'field' => 'cost', 'label'=>'Cost', 'short_label'=>'$', 'mesure'=>'USD', 'max'=>'1000', 
                                      'vmin'=>$model->cost_min, 'vmax'=>$model->cost_max, 'vsort'=>$model->cost_sort]); ?>
    </div>
</div>

</div>  
<div class="row">
<div class="col-md-12">
    <div class="col-md-3">  
    <?=$this->render('slider_field', ['model' => $model, 'field'=>'mass_oa', 'label'=>'Mass OA', 'short_label'=>'MMS', 'mesure'=>'g', 'max'=>'50', 
                                      'vmin'=>$model->mass_oa_min, 'vmax'=>$model->mass_oa_max, 'vsort'=>$model->mass_oa_sort]); ?>
    </div>
    <div class="col-md-3">  
    <?=$this->render('slider_field', ['model' => $model, 'field' => 'diam_oa', 'label'=>'Diam OA', 'short_label'=>'', 'mesure'=>'mm', 'max'=>'1000', 
                                      'vmin'=>$model->diam_oa_min, 'vmax'=>$model->diam_oa_max, 'vsort'=>$model->diam_oa_sort]); ?>
    </div>
    <div class="col-md-3">  
    <?=$this->render('slider_field', ['model' => $model, 'field' => 'height_oa', 'label'=>'Height OA', 'short_label'=>'', 'mesure'=>'mm', 'max'=>'500', 
                                      'vmin'=>$model->height_oa_min, 'vmax'=>$model->height_oa_max, 'vsort'=>$model->height_oa_sort]); ?>
    </div>
    <div class="col-md-3">  
    <?=$this->render('slider_field', ['model' => $model, 'field' => 'pmax_rated', 'label'=>'Pmax Rated', 'short_label'=>'Pmax', 'mesure'=>'W', 'max'=>'10000', 
                                      'vmin'=>$model->pmax_rated_min, 'vmax'=>$model->pmax_rated_max, 'vsort'=>$model->pmax_rated_sort]); ?>
    </div>

    <?php /*
    <div class="col-md-3">  
    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary w-100', 'onclick'=>'loadnewdata()', 'style'=>'margin-top: 25px; background: var(--blue);']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>    
    </div> */ ?>
    
</div>
</div>
<hr />
    <?php ActiveForm::end(); ?>

</div>

<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="allitems">

<div id="listing_container"></div>
   <div id="wait" style="display:none;position:absolute;top:50%;left:50%;padding:2px; z-index: 2000;">Loading...</div>   
</div>
</main>
</div>

<script>
$("#form_id").submit(function(){return false;});
$("#wait").css("display", "none");

var page = 0;

function loadnewdata()
{
    var data=$("#form_id").serialize(); 
    //data.push({ name: 'page', value: page });
     $.ajax({ 
        type: 'post',
        url: 'site/showlisting',
        data: data,
              //cache: false,
            beforeSend: function(){$("#wait").css("display", "block");},
            success: function(data){
                $("#wait").css("display", "none");
                var existing_content = $('#listing_container').html();
                 //const  div = document.getElementById("listing_container");
                //div.append(data);
                //$('#listing_container').replaceWith('<div id="listing_container">'+existing_content+data+'</div>');
               $("#listing_container").append(data);
                //$('#listing_container').html(data);
                //var length = $(data).find(".photos_and_graphs").length;
               // if(length==15){
                    
                    
                 //$('#listing_container').replaceWith('<div id="listing_container">'+existing_content+data+'</div><div class="d-flex justify-content-center row"><button type="button" class="btn btn-primary" style="margin-top: 25px; background: var(--blue);" onclick="loadnewdata()">Show More</button></div>');
                 //$('html, body').animate({scrollTop: $("#listing_container").offset().top}, 1000);
                // }else{
                 //   $('#listing_container').replaceWith('<div id="listing_container">'+existing_content+data+'</div>');
                 
                // }
                 page++;
                 $('#page').val(page);
                 
              },
              complete: function (data) {
                  //_card.initialize_all_new_cards(); 
                  _graph_mini.initialize_all_new_graphs();
                  _inf_baffle.fetch_json()
                  _highlight.initialize_all_new_specs()
              },
              dataType: "html"
     });
}

var counter=0;
        $(window).scroll(function () {
            if ($(window).scrollTop() == $(document).height() - $(window).height() && counter < 2) {
                loadnewdata();
            }
        });

/*
setInterval(
  function ()
  {
    if(($(document).height() - $(window).height() - $(document).scrollTop()) < 500){
       loadnewdata();
    }
  },
  500
);
*/
// Run the initial listing load.
loadnewdata();


/*

$("#form_id").submit(function(){return false;});
$("#wait").css("display", "none");
function calculate(){
var data=$("#form_id").serialize(); 
$.ajax({
    type: 'post',
    url: 'site/showlisting',
    data: data,
    beforeSend: function(){$("#wait").css("display", "block");},
    success: function (dat) {
         $("#wait").css("display", "none");
            $( '#results' ).html(dat);
    $('html, body').animate({scrollTop: $("#results").offset().top}, 1000);
    }
});
}*/
</script>