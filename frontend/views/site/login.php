<?php
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;


?>
<style>
.btn-primary{
    background-color: #30bc99;
    border-color: #30bc99;
}


#loginpic {
  height: 200px;
  background-image: url('/img/login.jpg'); 
  background-color: #cccccc; 
  background-position: center; 
  background-repeat: no-repeat; 
  background-size: cover;
}

</style>
<div class="site-login">
<div class="row justify-content-md-center">
<div class="col-lg-4">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr />
    <!--<p>Please fill out the following fields to login:</p>-->
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?php // echo $form->field($model, 'rememberMe')->checkbox() ?>
            <div style="color:#999;margin:1em 0">
                <?= Html::a('Forgot Password? ', ['site/request-password-reset']) ?>.
                <?php /*
                <br />
                Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                <br />  
                Not yet member? <?= Html::a('Signup now', ['site/signup']) ?>.
                */ ?>           
            </div>
            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        
    </div>

</div>
</div>
</div>
