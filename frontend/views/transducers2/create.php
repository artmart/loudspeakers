<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Transducers2 $model */

$this->title = 'Create Transducers2';
$this->params['breadcrumbs'][] = ['label' => 'Transducers2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transducers2-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
