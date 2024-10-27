<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Transducers2 $model */
/** @var yii\widgets\ActiveForm $form */
?></div>

<div class="transducers2-form">

    <?php $form = ActiveForm::begin(); ?></div>

    <div class="col-md-3"><?= $form->field($model, 'DataSource')->textarea(['rows' => 6]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Brand')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Model')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Type')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Status')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Dnom_in')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Re')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Fs')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Qm')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Qe')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Qt')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Rm')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Mm')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Cm')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Vas')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Sd')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BL')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Pe')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Xmax')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'CreepBeta')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Z1k')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Z10k')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'L2')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Le')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Ke')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'R2')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'USPL')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Beta')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Revision')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'EntryDate')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Vocc')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'MassOA')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'DiamOA')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'HeightOA')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'TargetCurve')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'TestSignal')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Cost')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'URL')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'DataSheet')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'entered_by')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'DataDate')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Km')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Xmax_geom')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Xmax_damage')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'n0')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Vd')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Res')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Cmes')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Lces')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Dd')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'SPL1W')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Depth')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'MotorH')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'MotorDiam')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'VCd')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'VCMass')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Vocc_est')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Vocc_rough')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Dnom_cm')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Znom')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'kLe')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'fLe')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'DiaphH')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Df')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'fpist')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'f4pi')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'f2pi')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'fmax')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Mair')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Mmd')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Zres')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'EBP')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Gamma')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Mpow')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'SPLmx')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Hc')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Hg')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'AspectR')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'LengthOA')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'WidthOA')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'F_HighRated')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'F_LowRated')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'VCMat')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'FormerMat')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'DiaphMat')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'SurrMat')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'SpidMat')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'FrameMat')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'MagMat')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'DiaphShape')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'MotorShape')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'MotorLength')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'MotorWidth')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'FlangeH')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'MagDiam')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'MagH')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'MagMass')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Bpeak')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BaffleCutoutDiam')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BaffleCutoutLength')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BaffleCutoutWidth')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BoltCircleDiam')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BoltCircleScrewDiam')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BoltCircleScrewQty')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'TerminalPairsQty')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'TempLowPerfRated')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'TempHighPerfRated')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'TempLowDamageRated')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'TempHighDamageRated')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'HumidityLowPerfRated')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'HumidityHighPerfRated')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'HumidityLowDamageRated')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'HumidityHighDamageRated')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Urms_100H_Max')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Urms_Max_Rated')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Pmax_Rated')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BL1')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BL2')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BL3')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BL4')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BL5')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BL6')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BL7')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'BL8')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'K1')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'K2')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'K3')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'K4')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'K5')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'K6')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'K7')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'K8')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Lx1')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Lx2')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Lx3')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Lx4')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Lx5')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Lx6')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Lx7')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Lx8')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Li1')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Li2')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Li3')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Li4')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Rmv1')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Rmv2')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Rmv3')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Rmv4')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Rtm')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Rtv')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'tauC')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'tauM')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Rv')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'AlphaBypass')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Ctm')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Ctv')->textInput() ?></div>

    <div class="col-md-3"><?= $form->field($model, 'DIY_Availability')->textarea(['rows' => 6]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Application')->textarea(['rows' => 6]) ?></div>

    <div class="col-md-3"><?= $form->field($model, 'Notes')->textarea(['rows' => 6]) ?></div>

    <div class="form-group">
        <div class="col-md-3"><?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?></div>
    </div>

    <?php ActiveForm::end(); ?></div>

</div>
