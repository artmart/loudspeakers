<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Transducers2Search $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="transducers2-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'DataSource') ?>

    <?= $form->field($model, 'Brand') ?>

    <?= $form->field($model, 'Model') ?>

    <?= $form->field($model, 'Type') ?>

    <?php // echo $form->field($model, 'Status') ?>

    <?php // echo $form->field($model, 'Dnom_in') ?>

    <?php // echo $form->field($model, 'Re') ?>

    <?php // echo $form->field($model, 'Fs') ?>

    <?php // echo $form->field($model, 'Qm') ?>

    <?php // echo $form->field($model, 'Qe') ?>

    <?php // echo $form->field($model, 'Qt') ?>

    <?php // echo $form->field($model, 'Rm') ?>

    <?php // echo $form->field($model, 'Mm') ?>

    <?php // echo $form->field($model, 'Cm') ?>

    <?php // echo $form->field($model, 'Vas') ?>

    <?php // echo $form->field($model, 'Sd') ?>

    <?php // echo $form->field($model, 'BL') ?>

    <?php // echo $form->field($model, 'Pe') ?>

    <?php // echo $form->field($model, 'Xmax') ?>

    <?php // echo $form->field($model, 'CreepBeta') ?>

    <?php // echo $form->field($model, 'Z1k') ?>

    <?php // echo $form->field($model, 'Z10k') ?>

    <?php // echo $form->field($model, 'L2') ?>

    <?php // echo $form->field($model, 'Le') ?>

    <?php // echo $form->field($model, 'Ke') ?>

    <?php // echo $form->field($model, 'R2') ?>

    <?php // echo $form->field($model, 'USPL') ?>

    <?php // echo $form->field($model, 'Beta') ?>

    <?php // echo $form->field($model, 'Revision') ?>

    <?php // echo $form->field($model, 'EntryDate') ?>

    <?php // echo $form->field($model, 'Vocc') ?>

    <?php // echo $form->field($model, 'MassOA') ?>

    <?php // echo $form->field($model, 'DiamOA') ?>

    <?php // echo $form->field($model, 'HeightOA') ?>

    <?php // echo $form->field($model, 'TargetCurve') ?>

    <?php // echo $form->field($model, 'TestSignal') ?>

    <?php // echo $form->field($model, 'Cost') ?>

    <?php // echo $form->field($model, 'URL') ?>

    <?php // echo $form->field($model, 'DataSheet') ?>

    <?php // echo $form->field($model, 'entered_by') ?>

    <?php // echo $form->field($model, 'DataDate') ?>

    <?php // echo $form->field($model, 'Km') ?>

    <?php // echo $form->field($model, 'Xmax_geom') ?>

    <?php // echo $form->field($model, 'Xmax_damage') ?>

    <?php // echo $form->field($model, 'n0') ?>

    <?php // echo $form->field($model, 'Vd') ?>

    <?php // echo $form->field($model, 'Res') ?>

    <?php // echo $form->field($model, 'Cmes') ?>

    <?php // echo $form->field($model, 'Lces') ?>

    <?php // echo $form->field($model, 'Dd') ?>

    <?php // echo $form->field($model, 'SPL1W') ?>

    <?php // echo $form->field($model, 'Depth') ?>

    <?php // echo $form->field($model, 'MotorH') ?>

    <?php // echo $form->field($model, 'MotorDiam') ?>

    <?php // echo $form->field($model, 'VCd') ?>

    <?php // echo $form->field($model, 'VCMass') ?>

    <?php // echo $form->field($model, 'Vocc_est') ?>

    <?php // echo $form->field($model, 'Vocc_rough') ?>

    <?php // echo $form->field($model, 'Dnom_cm') ?>

    <?php // echo $form->field($model, 'Znom') ?>

    <?php // echo $form->field($model, 'kLe') ?>

    <?php // echo $form->field($model, 'fLe') ?>

    <?php // echo $form->field($model, 'DiaphH') ?>

    <?php // echo $form->field($model, 'Df') ?>

    <?php // echo $form->field($model, 'fpist') ?>

    <?php // echo $form->field($model, 'f4pi') ?>

    <?php // echo $form->field($model, 'f2pi') ?>

    <?php // echo $form->field($model, 'fmax') ?>

    <?php // echo $form->field($model, 'Mair') ?>

    <?php // echo $form->field($model, 'Mmd') ?>

    <?php // echo $form->field($model, 'Zres') ?>

    <?php // echo $form->field($model, 'EBP') ?>

    <?php // echo $form->field($model, 'Gamma') ?>

    <?php // echo $form->field($model, 'Mpow') ?>

    <?php // echo $form->field($model, 'SPLmx') ?>

    <?php // echo $form->field($model, 'Hc') ?>

    <?php // echo $form->field($model, 'Hg') ?>

    <?php // echo $form->field($model, 'AspectR') ?>

    <?php // echo $form->field($model, 'LengthOA') ?>

    <?php // echo $form->field($model, 'WidthOA') ?>

    <?php // echo $form->field($model, 'F_HighRated') ?>

    <?php // echo $form->field($model, 'F_LowRated') ?>

    <?php // echo $form->field($model, 'VCMat') ?>

    <?php // echo $form->field($model, 'FormerMat') ?>

    <?php // echo $form->field($model, 'DiaphMat') ?>

    <?php // echo $form->field($model, 'SurrMat') ?>

    <?php // echo $form->field($model, 'SpidMat') ?>

    <?php // echo $form->field($model, 'FrameMat') ?>

    <?php // echo $form->field($model, 'MagMat') ?>

    <?php // echo $form->field($model, 'DiaphShape') ?>

    <?php // echo $form->field($model, 'MotorShape') ?>

    <?php // echo $form->field($model, 'MotorLength') ?>

    <?php // echo $form->field($model, 'MotorWidth') ?>

    <?php // echo $form->field($model, 'FlangeH') ?>

    <?php // echo $form->field($model, 'MagDiam') ?>

    <?php // echo $form->field($model, 'MagH') ?>

    <?php // echo $form->field($model, 'MagMass') ?>

    <?php // echo $form->field($model, 'Bpeak') ?>

    <?php // echo $form->field($model, 'BaffleCutoutDiam') ?>

    <?php // echo $form->field($model, 'BaffleCutoutLength') ?>

    <?php // echo $form->field($model, 'BaffleCutoutWidth') ?>

    <?php // echo $form->field($model, 'BoltCircleDiam') ?>

    <?php // echo $form->field($model, 'BoltCircleScrewDiam') ?>

    <?php // echo $form->field($model, 'BoltCircleScrewQty') ?>

    <?php // echo $form->field($model, 'TerminalPairsQty') ?>

    <?php // echo $form->field($model, 'TempLowPerfRated') ?>

    <?php // echo $form->field($model, 'TempHighPerfRated') ?>

    <?php // echo $form->field($model, 'TempLowDamageRated') ?>

    <?php // echo $form->field($model, 'TempHighDamageRated') ?>

    <?php // echo $form->field($model, 'HumidityLowPerfRated') ?>

    <?php // echo $form->field($model, 'HumidityHighPerfRated') ?>

    <?php // echo $form->field($model, 'HumidityLowDamageRated') ?>

    <?php // echo $form->field($model, 'HumidityHighDamageRated') ?>

    <?php // echo $form->field($model, 'Urms_100H_Max') ?>

    <?php // echo $form->field($model, 'Urms_Max_Rated') ?>

    <?php // echo $form->field($model, 'Pmax_Rated') ?>

    <?php // echo $form->field($model, 'BL1') ?>

    <?php // echo $form->field($model, 'BL2') ?>

    <?php // echo $form->field($model, 'BL3') ?>

    <?php // echo $form->field($model, 'BL4') ?>

    <?php // echo $form->field($model, 'BL5') ?>

    <?php // echo $form->field($model, 'BL6') ?>

    <?php // echo $form->field($model, 'BL7') ?>

    <?php // echo $form->field($model, 'BL8') ?>

    <?php // echo $form->field($model, 'K1') ?>

    <?php // echo $form->field($model, 'K2') ?>

    <?php // echo $form->field($model, 'K3') ?>

    <?php // echo $form->field($model, 'K4') ?>

    <?php // echo $form->field($model, 'K5') ?>

    <?php // echo $form->field($model, 'K6') ?>

    <?php // echo $form->field($model, 'K7') ?>

    <?php // echo $form->field($model, 'K8') ?>

    <?php // echo $form->field($model, 'Lx1') ?>

    <?php // echo $form->field($model, 'Lx2') ?>

    <?php // echo $form->field($model, 'Lx3') ?>

    <?php // echo $form->field($model, 'Lx4') ?>

    <?php // echo $form->field($model, 'Lx5') ?>

    <?php // echo $form->field($model, 'Lx6') ?>

    <?php // echo $form->field($model, 'Lx7') ?>

    <?php // echo $form->field($model, 'Lx8') ?>

    <?php // echo $form->field($model, 'Li1') ?>

    <?php // echo $form->field($model, 'Li2') ?>

    <?php // echo $form->field($model, 'Li3') ?>

    <?php // echo $form->field($model, 'Li4') ?>

    <?php // echo $form->field($model, 'Rmv1') ?>

    <?php // echo $form->field($model, 'Rmv2') ?>

    <?php // echo $form->field($model, 'Rmv3') ?>

    <?php // echo $form->field($model, 'Rmv4') ?>

    <?php // echo $form->field($model, 'Rtm') ?>

    <?php // echo $form->field($model, 'Rtv') ?>

    <?php // echo $form->field($model, 'tauC') ?>

    <?php // echo $form->field($model, 'tauM') ?>

    <?php // echo $form->field($model, 'Rv') ?>

    <?php // echo $form->field($model, 'AlphaBypass') ?>

    <?php // echo $form->field($model, 'Ctm') ?>

    <?php // echo $form->field($model, 'Ctv') ?>

    <?php // echo $form->field($model, 'DIY_Availability') ?>

    <?php // echo $form->field($model, 'Application') ?>

    <?php // echo $form->field($model, 'Notes') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
