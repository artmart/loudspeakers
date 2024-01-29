<?php

/** @var yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody();

/*

style="background-image: url('/img/login1.jpg'); 
  background-color: #cccccc; 
  height: 100%; 
  background-position: center; 
  background-repeat: no-repeat; 
  background-size: cover;"
  */

 ?>

<main role="main">
    <div class="container">
    <div class="mt-5 offset-lg-3 col-lg-6">
        <?= $content ?>
    </div>
    </div>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
