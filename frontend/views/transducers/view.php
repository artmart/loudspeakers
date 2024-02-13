<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Transducers $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transducers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transducers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'manufacturer',
            'model',
            'type',
            'size',
            'status',
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
            'webpage',
            'data_sheet',
            'entered_by',
            'entry_time',
        ],
    ]) ?>

</div>
