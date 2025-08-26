<?php
$data_woofer = json_encode(["re"    =>$model->Re,   //6.0,
                            "bl"    =>$model->BL,  //13.5,
                            "mmd"   =>$model->Mmd, //59.2,
                            "rms"   =>$model->Rm, //2.2,
                            "cms"   =>$model->Cm, //490.0,
                            "sd"    =>$model->Sd*10000, //340.0,
                            "le"    =>$model->Le, //1.38,
                            "fs"    =>$model->Fs, //28.5,
                            "qts"   =>$model->Qt, //0.35,
                            "xmax"  =>$model->Xmax*1000, //3.5,
                            "pmax"  =>$model->Pmax_Rated, //160,
                            "spl1w" =>$model->SPL1W, //88.5,
                            "z"     =>$model->Zres, //8
                            
                            "mms"   =>$model->Mm,
                            ]);
?>

<article class="woofer_card ribbon-container col-md-4" data-woofer-id="<?=$model->id;?>" data-woofer='<?=$data_woofer;?>'>
<a href="/transducers2/view?id=<?=$model->id;?>">
<div class="photos_and_graphs">
    <div class="photo">
          <img alt="<?=$model->Brand.' '.$model->Model.' '.$model->Type;?>" loading="lazy" src="/img/noimage.jpg" data-photo2="/img/nodata.png"/> 
        <?php /*<img alt="<?=$model->Brand.' '.$model->Model.' '.$model->Type;?>" loading="lazy" src="/img/noimage.jpg" onmouseover="this.src='/img/nodata.png'" onmouseout="this.src='/img/noimage.jpg'">
        */ ?>
    </div>
    <div class="graph">
        <div data-graph-size="mini" data-enclosure-type="inf_baffle" data-woofer-id="<?=$model->id;?>" data-woofer='<?=$data_woofer;?>'>
        <div data-graph="spl"></div>
        </div>
    </div>
</div>
</a>
<table class="driver_data">
<thead>
    <tr>
        <th class="brand_ref_imp">
            <a href="/transducers2/view?id=<?=$model->id;?>">
                <h4><span style="white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  display: block;
  width: 180px; float: left;"><?=$model->Brand;?></span> 
            <span style="white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  display: block;
  width: 130px; float: left;"><?=$model->Model;?></span></h4>
            </a>
            <span data-highlight="z"><b><?=$model->Re;?></b> Ω</span>
        </th>
    </tr>
</thead>
<tbody>
    <tr>
        <td class="size_type">
            <span data-highlight="size"><b><?=$model->Dnom_in;?></b>″</span> <span data-highlight="type"><?=$model->Type;?></span>
        </td>
    </tr>
    <tr>
        <td class="symbol">
            <span data-highlight="fs">f<span class="sub">S</span></span>
        </td>
        <td class="value">
            <span data-highlight="fs"><b><?=$model->Fs;?></b> Hz</span>
        </td>
    </tr>
    <tr>
        <td class="symbol">
            <span data-highlight="sd">S<span class="sub">D</span></span>
        </td>
        <td class="value">
            <span data-highlight="sd"><b><?=round($model->Sd*10000, 1);?></b> cm²</span>
        </td>
    </tr>
    <tr>
        <td class="fr">
        <span data-highlight="fr"><b><?=$model->F_LowRated;?></b> - <b><?=$model->F_HighRated;?>  </b> Hz</span>
        </td>
    </tr>
    <tr>
        <td class="symbol">
            <span data-highlight="qts">Q<span class="sub">TS</span></span>
        </td>
        <td class="value">
            <span data-highlight="qts"><b><?=$model->Qt;?></b></span>
        </td>
    </tr>
    <tr>
        <td class="symbol">
            <span data-highlight="xmax">x<span class="sub">max</span></span>
        </td>
        <td class="value">
            <span data-highlight="xmax"><b><?=round($model->Xmax*1000, 1);?></b> mm</span>
        </td>
    </tr>
    <tr>
        <td class="symbol">
            <span data-highlight="spl1w">SPL<span class="sub">1W</span></span>
        </td>
        <td class="value">
            <span data-highlight="spl1w"><b><?=round($model->SPL1W, 1);?></b> dB</span>
        </td>
    </tr>
    <tr>
        <td class="symbol">
            <span data-highlight="blre">Bl/√R<span class="sub">E</span></span>
        </td>
        <td class="value">
            <span data-highlight="blre"><b><?=$model->BL;?></b></span>
        </td>
    </tr>
    <tr>
        <td class="symbol">
            <span data-highlight="pmax">P<span class="sub">max</span></span>
        </td>
        <td class="value">
            <span data-highlight="pmax"><b><?=$model->Pmax_Rated;?></b> W</span>
        </td>
    </tr>
</tbody>
</table>
</article>