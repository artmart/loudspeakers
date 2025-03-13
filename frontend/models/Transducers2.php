<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "transducers2".
 *
 * @property int $id
 * @property string $DataSource
 * @property string $Brand
 * @property string $Model
 * @property int $Type
 * @property int $Status
 * @property float $Dnom_in
 * @property float|null $Re
 * @property float|null $Fs
 * @property float|null $Qm
 * @property float|null $Qe
 * @property float|null $Qt
 * @property float|null $Rm
 * @property float|null $Mm
 * @property float|null $Cm
 * @property float|null $Vas
 * @property float|null $Sd
 * @property float|null $BL
 * @property float|null $Pe
 * @property float|null $Xmax
 * @property float|null $CreepBeta
 * @property float|null $Z1k
 * @property float|null $Z10k
 * @property float|null $L2
 * @property float|null $Le
 * @property float|null $Ke
 * @property float|null $R2
 * @property float|null $USPL
 * @property float|null $Beta
 * @property string $Revision
 * @property string|null $EntryDate
 * @property float|null $Vocc
 * @property float|null $MassOA
 * @property float|null $DiamOA
 * @property float|null $HeightOA
 * @property string $TargetCurve
 * @property string $TestSignal
 * @property float|null $Cost
 * @property string $URL
 * @property string|null $DataSheet
 * @property int $entered_by
 * @property string|null $DataDate
 * @property float|null $Km
 * @property float|null $Xmax_geom
 * @property float|null $Xmax_damage
 * @property float|null $n0
 * @property float|null $Vd
 * @property float|null $Res
 * @property float|null $Cmes
 * @property float|null $Lces
 * @property float|null $Dd
 * @property float|null $SPL1W
 * @property float|null $Depth
 * @property float|null $MotorH
 * @property float|null $MotorDiam
 * @property float|null $VCd
 * @property float|null $VCMass
 * @property float|null $Vocc_est
 * @property float|null $Vocc_rough
 * @property float|null $Dnom_cm
 * @property float|null $Znom
 * @property float|null $kLe
 * @property float|null $fLe
 * @property float|null $DiaphH
 * @property float|null $Df
 * @property float|null $fpist
 * @property float|null $f4pi
 * @property float|null $f2pi
 * @property float|null $fmax
 * @property float|null $Mair
 * @property float|null $Mmd
 * @property float|null $Zres
 * @property float|null $EBP
 * @property float|null $Gamma
 * @property float|null $Mpow
 * @property float|null $SPLmx
 * @property float|null $Hc
 * @property float|null $Hg
 * @property float|null $AspectR
 * @property float|null $LengthOA
 * @property float|null $WidthOA
 * @property float|null $F_HighRated
 * @property float|null $F_LowRated
 * @property string|null $VCMat
 * @property string|null $FormerMat
 * @property string|null $DiaphMat
 * @property string|null $SurrMat
 * @property string|null $SpidMat
 * @property string|null $FrameMat
 * @property string|null $MagMat
 * @property string|null $DiaphShape
 * @property string|null $MotorShape
 * @property float|null $MotorLength
 * @property float|null $MotorWidth
 * @property float|null $FlangeH
 * @property float|null $MagDiam
 * @property float|null $MagH
 * @property float|null $MagMass
 * @property float|null $Bpeak
 * @property float|null $BaffleCutoutDiam
 * @property float|null $BaffleCutoutLength
 * @property float|null $BaffleCutoutWidth
 * @property float|null $BoltCircleDiam
 * @property float|null $BoltCircleScrewDiam
 * @property float|null $BoltCircleScrewQty
 * @property int|null $TerminalPairsQty
 * @property float|null $TempLowPerfRated
 * @property float|null $TempHighPerfRated
 * @property float|null $TempLowDamageRated
 * @property float|null $TempHighDamageRated
 * @property float|null $HumidityLowPerfRated
 * @property float|null $HumidityHighPerfRated
 * @property float|null $HumidityLowDamageRated
 * @property float|null $HumidityHighDamageRated
 * @property float|null $Urms_100H_Max
 * @property float|null $Urms_Max_Rated
 * @property float|null $Pmax_Rated
 * @property float|null $BL1
 * @property float|null $BL2
 * @property float|null $BL3
 * @property float|null $BL4
 * @property float|null $BL5
 * @property float|null $BL6
 * @property float|null $BL7
 * @property float|null $BL8
 * @property float|null $K1
 * @property float|null $K2
 * @property float|null $K3
 * @property float|null $K4
 * @property float|null $K5
 * @property float|null $K6
 * @property float|null $K7
 * @property float|null $K8
 * @property float|null $Lx1
 * @property float|null $Lx2
 * @property float|null $Lx3
 * @property float|null $Lx4
 * @property float|null $Lx5
 * @property float|null $Lx6
 * @property float|null $Lx7
 * @property float|null $Lx8
 * @property float|null $Li1
 * @property float|null $Li2
 * @property float|null $Li3
 * @property float|null $Li4
 * @property float|null $Rmv1
 * @property float|null $Rmv2
 * @property float|null $Rmv3
 * @property float|null $Rmv4
 * @property float|null $Rtm
 * @property float|null $Rtv
 * @property float|null $tauC
 * @property float|null $tauM
 * @property float|null $Rv
 * @property float|null $AlphaBypass
 * @property float|null $Ctm
 * @property float|null $Ctv
 * @property string|null $DIY_Availability
 * @property string|null $Application
 * @property string|null $Notes
 *
 * @property User $enteredBy
 * @property Status $status
 * @property Types $type
 */
class Transducers2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transducers2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['DataSource', 'Type', 'Status', 'Dnom_in', 'TargetCurve', 'TestSignal', 'URL', 'entered_by'], 'required'],
            [['DataSource', 'DIY_Availability', 'Application', 'Notes'], 'string'],
            [['entered_by', 'TerminalPairsQty', 'upload_id'], 'integer'],
            [['Dnom_in', 'Re', 'Fs', 'Qm', 'Qe', 'Qt', 'Rm', 'Mm', 'Cm', 'Vas', 'Sd', 'BL', 'Pe', 'Xmax', 'CreepBeta', 'Z1k', 'Z10k', 'L2', 'Le', 'Ke', 'R2', 'USPL', 'Beta', 'Vocc', 'MassOA', 'DiamOA', 'HeightOA', 'Cost', 'Km', 'Xmax_geom', 'Xmax_damage', 'n0', 'Vd', 'Res', 'Cmes', 'Lces', 'Dd', 'SPL1W', 'Depth', 'MotorH', 'MotorDiam', 'VCd', 'VCMass', 'Vocc_est', 'Vocc_rough', 'Dnom_cm', 'Znom', 'kLe', 'fLe', 'DiaphH', 'Df', 'fpist', 'f4pi', 'f2pi', 'fmax', 'Mair', 'Mmd', 'Zres', 'EBP', 'Gamma', 'Mpow', 'SPLmx', 'Hc', 'Hg', 'AspectR', 'LengthOA', 'WidthOA', 'F_HighRated', 'F_LowRated', 'MotorLength', 'MotorWidth', 'FlangeH', 'MagDiam', 'MagH', 'MagMass', 'Bpeak', 'BaffleCutoutDiam', 'BaffleCutoutLength', 'BaffleCutoutWidth', 'BoltCircleDiam', 'BoltCircleScrewDiam', 'BoltCircleScrewQty', 'TempLowPerfRated', 'TempHighPerfRated', 'TempLowDamageRated', 'TempHighDamageRated', 'HumidityLowPerfRated', 'HumidityHighPerfRated', 'HumidityLowDamageRated', 'HumidityHighDamageRated', 'Urms_100H_Max', 'Urms_Max_Rated', 'Pmax_Rated', 'BL1', 'BL2', 'BL3', 'BL4', 'BL5', 'BL6', 'BL7', 'BL8', 'K1', 'K2', 'K3', 'K4', 'K5', 'K6', 'K7', 'K8', 'Lx1', 'Lx2', 'Lx3', 'Lx4', 'Lx5', 'Lx6', 'Lx7', 'Lx8', 'Li1', 'Li2', 'Li3', 'Li4', 'Rmv1', 'Rmv2', 'Rmv3', 'Rmv4', 'Rtm', 'Rtv', 'tauC', 'tauM', 'Rv', 'AlphaBypass', 'Ctm', 'Ctv'], 'number'],
            [['EntryDate', 'DataDate'], 'safe'],
            [['Brand', 'Model', 'Revision', 'URL'], 'string', 'max' => 500],
            [['Type', 'TargetCurve', 'TestSignal', 'DataSheet'], 'string', 'max' => 255],
            [['Status', 'VCMat', 'FormerMat', 'DiaphMat', 'SurrMat', 'SpidMat', 'FrameMat', 'MagMat', 'DiaphShape', 'MotorShape'], 'string', 'max' => 100],
            //[['Status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['Status' => 'id']],
            //[['Type'], 'exist', 'skipOnError' => true, 'targetClass' => Types::class, 'targetAttribute' => ['Type' => 'id']],
            [['entered_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['entered_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'upload_id' => 'Upload ID',
            'DataSource' => 'Data Source',
            'Brand' => 'Brand',
            'Model' => 'Model',
            'Type' => 'Type',
            'Status' => 'Status',
            'Dnom_in' => 'Dnom In',
            'Re' => 'Re',
            'Fs' => 'Fs',
            'Qm' => 'Qm',
            'Qe' => 'Qe',
            'Qt' => 'Qt',
            'Rm' => 'Rm',
            'Mm' => 'Mm',
            'Cm' => 'Cm',
            'Vas' => 'Vas',
            'Sd' => 'Sd',
            'BL' => 'Bl',
            'Pe' => 'Pe',
            'Xmax' => 'Xmax',
            'CreepBeta' => 'Creep Beta',
            'Z1k' => 'Z1k',
            'Z10k' => 'Z10k',
            'L2' => 'L2',
            'Le' => 'Le',
            'Ke' => 'Ke',
            'R2' => 'R2',
            'USPL' => 'Uspl',
            'Beta' => 'Beta',
            'Revision' => 'Revision',
            'EntryDate' => 'Entry Date',
            'Vocc' => 'Vocc',
            'MassOA' => 'Mass Oa',
            'DiamOA' => 'Diam Oa',
            'HeightOA' => 'Height Oa',
            'TargetCurve' => 'Target Curve',
            'TestSignal' => 'Test Signal',
            'Cost' => 'Cost',
            'URL' => 'Url',
            'DataSheet' => 'Data Sheet',
            'entered_by' => 'Entered By',
            'DataDate' => 'Data Date',
            'Km' => 'Km',
            'Xmax_geom' => 'Xmax Geom',
            'Xmax_damage' => 'Xmax Damage',
            'n0' => 'n0',
            'Vd' => 'Vd',
            'Res' => 'Res',
            'Cmes' => 'Cmes',
            'Lces' => 'Lces',
            'Dd' => 'Dd',
            'SPL1W' => 'Spl1w',
            'Depth' => 'Depth',
            'MotorH' => 'Motor H',
            'MotorDiam' => 'Motor Diam',
            'VCd' => 'V Cd',
            'VCMass' => 'Vc Mass',
            'Vocc_est' => 'Vocc Est',
            'Vocc_rough' => 'Vocc Rough',
            'Dnom_cm' => 'Dnom Cm',
            'Znom' => 'Znom',
            'kLe' => 'K Le',
            'fLe' => 'F Le',
            'DiaphH' => 'Diaph H',
            'Df' => 'Df',
            'fpist' => 'Fpist',
            'f4pi' => 'F4pi',
            'f2pi' => 'F2pi',
            'fmax' => 'Fmax',
            'Mair' => 'Mair',
            'Mmd' => 'Mmd',
            'Zres' => 'Zres',
            'EBP' => 'Ebp',
            'Gamma' => 'Gamma',
            'Mpow' => 'Mpow',
            'SPLmx' => 'SPLmx',
            'Hc' => 'Hc',
            'Hg' => 'Hg',
            'AspectR' => 'Aspect R',
            'LengthOA' => 'Length Oa',
            'WidthOA' => 'Width Oa',
            'F_HighRated' => 'F High Rated',
            'F_LowRated' => 'F Low Rated',
            'VCMat' => 'Vc Mat',
            'FormerMat' => 'Former Mat',
            'DiaphMat' => 'Diaph Mat',
            'SurrMat' => 'Surr Mat',
            'SpidMat' => 'Spid Mat',
            'FrameMat' => 'Frame Mat',
            'MagMat' => 'Mag Mat',
            'DiaphShape' => 'Diaph Shape',
            'MotorShape' => 'Motor Shape',
            'MotorLength' => 'Motor Length',
            'MotorWidth' => 'Motor Width',
            'FlangeH' => 'Flange H',
            'MagDiam' => 'Mag Diam',
            'MagH' => 'Mag H',
            'MagMass' => 'Mag Mass',
            'Bpeak' => 'Bpeak',
            'BaffleCutoutDiam' => 'Baffle Cutout Diam',
            'BaffleCutoutLength' => 'Baffle Cutout Length',
            'BaffleCutoutWidth' => 'Baffle Cutout Width',
            'BoltCircleDiam' => 'Bolt Circle Diam',
            'BoltCircleScrewDiam' => 'Bolt Circle Screw Diam',
            'BoltCircleScrewQty' => 'Bolt Circle Screw Qty',
            'TerminalPairsQty' => 'Terminal Pairs Qty',
            'TempLowPerfRated' => 'Temp Low Perf Rated',
            'TempHighPerfRated' => 'Temp High Perf Rated',
            'TempLowDamageRated' => 'Temp Low Damage Rated',
            'TempHighDamageRated' => 'Temp High Damage Rated',
            'HumidityLowPerfRated' => 'Humidity Low Perf Rated',
            'HumidityHighPerfRated' => 'Humidity High Perf Rated',
            'HumidityLowDamageRated' => 'Humidity Low Damage Rated',
            'HumidityHighDamageRated' => 'Humidity High Damage Rated',
            'Urms_100H_Max' => 'Urms 100h Max',
            'Urms_Max_Rated' => 'Urms Max Rated',
            'Pmax_Rated' => 'Pmax Rated',
            'BL1' => 'Bl1',
            'BL2' => 'Bl2',
            'BL3' => 'Bl3',
            'BL4' => 'Bl4',
            'BL5' => 'Bl5',
            'BL6' => 'Bl6',
            'BL7' => 'Bl7',
            'BL8' => 'Bl8',
            'K1' => 'K1',
            'K2' => 'K2',
            'K3' => 'K3',
            'K4' => 'K4',
            'K5' => 'K5',
            'K6' => 'K6',
            'K7' => 'K7',
            'K8' => 'K8',
            'Lx1' => 'Lx1',
            'Lx2' => 'Lx2',
            'Lx3' => 'Lx3',
            'Lx4' => 'Lx4',
            'Lx5' => 'Lx5',
            'Lx6' => 'Lx6',
            'Lx7' => 'Lx7',
            'Lx8' => 'Lx8',
            'Li1' => 'Li1',
            'Li2' => 'Li2',
            'Li3' => 'Li3',
            'Li4' => 'Li4',
            'Rmv1' => 'Rmv1',
            'Rmv2' => 'Rmv2',
            'Rmv3' => 'Rmv3',
            'Rmv4' => 'Rmv4',
            'Rtm' => 'Rtm',
            'Rtv' => 'Rtv',
            'tauC' => 'Tau C',
            'tauM' => 'Tau M',
            'Rv' => 'Rv',
            'AlphaBypass' => 'Alpha Bypass',
            'Ctm' => 'Ctm',
            'Ctv' => 'Ctv',
            'DIY_Availability' => 'Diy Availability',
            'Application' => 'Application',
            'Notes' => 'Notes',
        ];
    }

    /**
     * Gets query for [[EnteredBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnteredBy()
    {
        return $this->hasOne(User::class, ['id' => 'entered_by']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'Status']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Types::class, ['id' => 'Type']);
    }
}
