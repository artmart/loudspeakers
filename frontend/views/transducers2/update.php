<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Transducers2 $model */

$this->title = 'Update Transducers2: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transducers2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transducers2-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
