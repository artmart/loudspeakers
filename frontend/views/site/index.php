<?php
//use backend\models\Endofdayfigures;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use frontend\assets\ItemsAsset;
ItemsAsset::register($this);

$this->title = 'Loudspeaker Database';
$this->params['breadcrumbs'][] = $this->title;





?>


<?php Pjax::begin(['id'=>'pjax_id']); ?>
   

<div class="x_panel">
   <main class="search row">
   <section class="col-md-12">
    <?php echo $this->render('/transducers2/_search', ['model' => $searchModel]); ?>
   </section>
   
   <section class="col-md-12">
   <div class="allitems">
<?php
/*
echo ListView::widget([
     'dataProvider' => $dataProvider,
     'itemOptions' => ['class' => 'item'],
     'itemView' => '_item_view',
     'pager' => ['class' => \kop\y2sp\ScrollPager::className()]
]);

*/
echo ListView::widget([
     //'options' => ['class' => 'list-view'],
     'dataProvider' => $dataProvider,
     'itemOptions' => ['tag' => false, 'class' => 'item'],
     'itemView' => '_item_view',
     //'summary' => '',
     'layout' => '{items}{pager}',
     'pager' => [
          'class' => \kop\y2sp\ScrollPager::className(),
          'item' => 'article',
          //'next' => '.next a',
          //'paginationSelector' => '.list-view .pagination',
          'triggerText' => Yii::t('app', '<div class="col-md-12"><div class="btn btn-success">Show more</div></div>'),
          //'triggerTemplate' => '<span class="reveal-btn">{text}</span>',
          //'noneLeftText' => '',
          //'noneLeftTemplate' => '',
          //'spinnerSrc' => '',
          //'spinnerTemplate' => '',
          /*'linkPager'     => [
               'prevPageCssClass' => 'btn-link prev',
               'nextPageCssClass' => 'btn-link next',
               'prevPageLabel' => '<span class="prev-page">prev</span>',
               'nextPageLabel' => '<span class="next-page">next</span>',
          ],*/
          //'linkPagerOptions'     => [
          //     'class' => 'pagination',
          //],
          //'linkPagerWrapperTemplate' => '<div class="button-news-more"><div class="wrapper"><div class="paging">{pager}</div></div></div>',
          //'eventOnPageChange' => 'function() {{{ias}}.hidePagination(); _card.initialize_all_new_cards(); _graph_mini.initialize_all_new_graphs();}',
          'eventOnRendered'=> 'function() {_card.initialize_all_new_cards(); _graph_mini.initialize_all_new_graphs();}',
          //'eventOnReady' => 'function() {{{ias}}.restorePagination(); _card.initialize_all_new_cards(); _graph_mini.initialize_all_new_graphs();}', /**/
     ],
]);

?>
</div>
</section>
</main>
</div>
<?php Pjax::end(); ?>

<!--
  <div class="container mt-4">
    <h1 class="mb-4">Loudspeaker Database</h1>
    <div class="row">
      <div class="col-md-3">
        <div class="filter-box">
          <h5>Filters</h5>
          <label>Power (W)</label>
          <div class="position-relative mb-2" style="height: 40px;">
            <canvas id="powerHistogram" width="300" height="40" style="position: absolute; z-index: 1;"></canvas>
            <div id="powerSlider" style="position: relative; z-index: 2;"></div>
          </div>
          <div class="slider-value d-flex gap-2">
            <input type="number" id="powerMin" class="form-control form-control-sm" style="width: 80px;">
            <span>-</span>
            <input type="number" id="powerMax" class="form-control form-control-sm" style="width: 80px;">
          </div>

          <label class="mt-3">Sensitivity (dB)</label>
          <div class="position-relative mb-2" style="height: 40px;">
            <canvas id="sensitivityHistogram" width="300" height="40" style="position: absolute; z-index: 1;"></canvas>
            <div id="sensitivitySlider" style="position: relative; z-index: 2;"></div>
          </div>
          <div class="slider-value d-flex gap-2">
            <input type="number" id="sensitivityMin" class="form-control form-control-sm" style="width: 80px;">
            <span>-</span>
            <input type="number" id="sensitivityMax" class="form-control form-control-sm" style="width: 80px;">
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <input id="searchBox" class="form-control mb-3" placeholder="Search...">
        
        
        <table id="speakerTable" class="table table-striped">
          <thead><tr><th>Brand</th><th>Model</th><th>Type</th><th>Power</th><th>Sensitivity</th></tr></thead>
        </table>
      </div>
    </div>
  </div>
-->

<script>
//function ffff(){alert("OK");}
</script>
<?php
/*$this->registerJs(
	   '$(document).on("pjax:end", function (event) {
        _card.initialize_all_new_cards();
         _graph_mini.initialize_all_new_graphs();
        
    }).trigger("pjax:end"); $.pjax.reload({container: "#pjax_id", async: false}); '
    
    );*/
    //
    ?>

