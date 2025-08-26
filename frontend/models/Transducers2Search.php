<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Transducers2;

/**
 * Transducers2Search represents the model behind the search form of `frontend\models\Transducers2`.
 */
class Transducers2Search extends Transducers2
{
    
    public $height_oa_min;
    public $height_oa_max;
    public $height_oa_sort;
    
    public $cost_min;
    public $cost_max;
    public $cost_sort;
    
    public $mass_oa_min;
    public $mass_oa_max;
    public $mass_oa_sort;
    
    public $diam_oa_min;
    public $diam_oa_max;
    public $diam_oa_sort;
    
    public $pmax_rated_min;
    public $pmax_rated_max;
    public $pmax_rated_sort;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'Status', 'entered_by', 'TerminalPairsQty'], 'integer'], //, 
            [['DataSource',  'Model', 'Revision', 'EntryDate', 'TargetCurve', 'TestSignal', 'URL', 'DataSheet', 'DataDate', 'VCMat', 'FormerMat', 'DiaphMat', 'SurrMat', 'SpidMat', 'FrameMat', 'MagMat', 'DiaphShape', 'MotorShape', 'DIY_Availability', 'Application', 'Notes'], 'safe'],
            [['Dnom_in', 'Re', 'Fs', 'Qm', 'Qe', 'Qt', 'Rm', 'Mm', 'Cm', 'Vas', 'Sd', 'BL', 'Pe', 'Xmax', 'CreepBeta', 'Z1k', 'Z10k', 'L2', 'Le', 'Ke', 'R2', 'USPL', 'Beta', 'Vocc', 'MassOA', 'DiamOA', 'HeightOA', 'Cost', 'Km', 'Xmax_geom', 'Xmax_damage', 'n0', 'Vd', 'Res', 'Cmes', 'Lces', 'Dd', 'SPL1W', 'Depth', 'MotorH', 'MotorDiam', 'VCd', 'VCMass', 'Vocc_est', 'Vocc_rough', 'Dnom_cm', 'Znom', 'kLe', 'fLe', 'DiaphH', 'Df', 'fpist', 'f4pi', 'f2pi', 'fmax', 'Mair', 'Mmd', 'Zres', 'EBP', 'Gamma', 'Mpow', 'SPLmx', 'Hc', 'Hg', 'AspectR', 'LengthOA', 'WidthOA', 'F_HighRated', 'F_LowRated', 'MotorLength', 'MotorWidth', 'FlangeH', 'MagDiam', 'MagH', 'MagMass', 'Bpeak', 'BaffleCutoutDiam', 'BaffleCutoutLength', 'BaffleCutoutWidth', 'BoltCircleDiam', 'BoltCircleScrewDiam', 'BoltCircleScrewQty', 'TempLowPerfRated', 'TempHighPerfRated', 'TempLowDamageRated', 'TempHighDamageRated', 'HumidityLowPerfRated', 'HumidityHighPerfRated', 'HumidityLowDamageRated', 'HumidityHighDamageRated', 'Urms_100H_Max', 'Urms_Max_Rated', 'Pmax_Rated', 'BL1', 'BL2', 'BL3', 'BL4', 'BL5', 'BL6', 'BL7', 'BL8', 'K1', 'K2', 'K3', 'K4', 'K5', 'K6', 'K7', 'K8', 'Lx1', 'Lx2', 'Lx3', 'Lx4', 'Lx5', 'Lx6', 'Lx7', 'Lx8', 'Li1', 'Li2', 'Li3', 'Li4', 'Rmv1', 'Rmv2', 'Rmv3', 'Rmv4', 'Rtm', 'Rtv', 'tauC', 'tauM', 'Rv', 'AlphaBypass', 'Ctm', 'Ctv'], 'number'],
            [['Brand', 'Type'], 'each', 'rule' => ['safe']],
        
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Transducers2::find();
        //var_dump($this->Brand);
        //exit;
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'Type' => $this->Type,
            'Status' => $this->Status,
            'Dnom_in' => $this->Dnom_in,
            'Re' => $this->Re,
            'Fs' => $this->Fs,
            'Qm' => $this->Qm,
            'Qe' => $this->Qe,
            'Qt' => $this->Qt,
            'Rm' => $this->Rm,
            'Mm' => $this->Mm,
            'Cm' => $this->Cm,
            'Vas' => $this->Vas,
            'Sd' => $this->Sd,
            'BL' => $this->BL,
            'Pe' => $this->Pe,
            'Xmax' => $this->Xmax,
            'CreepBeta' => $this->CreepBeta,
            'Z1k' => $this->Z1k,
            'Z10k' => $this->Z10k,
            'L2' => $this->L2,
            'Le' => $this->Le,
            'Ke' => $this->Ke,
            'R2' => $this->R2,
            'USPL' => $this->USPL,
            'Beta' => $this->Beta,
            'EntryDate' => $this->EntryDate,
            'Vocc' => $this->Vocc,
            //'MassOA' => $this->MassOA,
            //'DiamOA' => $this->DiamOA,
            //'HeightOA' => $this->HeightOA,
            //'Cost' => $this->Cost,
            'entered_by' => $this->entered_by,
            'DataDate' => $this->DataDate,
            'Km' => $this->Km,
            'Xmax_geom' => $this->Xmax_geom,
            'Xmax_damage' => $this->Xmax_damage,
            'n0' => $this->n0,
            'Vd' => $this->Vd,
            'Res' => $this->Res,
            'Cmes' => $this->Cmes,
            'Lces' => $this->Lces,
            'Dd' => $this->Dd,
            'SPL1W' => $this->SPL1W,
            'Depth' => $this->Depth,
            'MotorH' => $this->MotorH,
            'MotorDiam' => $this->MotorDiam,
            'VCd' => $this->VCd,
            'VCMass' => $this->VCMass,
            'Vocc_est' => $this->Vocc_est,
            'Vocc_rough' => $this->Vocc_rough,
            'Dnom_cm' => $this->Dnom_cm,
            'Znom' => $this->Znom,
            'kLe' => $this->kLe,
            'fLe' => $this->fLe,
            'DiaphH' => $this->DiaphH,
            'Df' => $this->Df,
            'fpist' => $this->fpist,
            'f4pi' => $this->f4pi,
            'f2pi' => $this->f2pi,
            'fmax' => $this->fmax,
            'Mair' => $this->Mair,
            'Mmd' => $this->Mmd,
            'Zres' => $this->Zres,
            'EBP' => $this->EBP,
            'Gamma' => $this->Gamma,
            'Mpow' => $this->Mpow,
            'SPLmx' => $this->SPLmx,
            'Hc' => $this->Hc,
            'Hg' => $this->Hg,
            'AspectR' => $this->AspectR,
            'LengthOA' => $this->LengthOA,
            'WidthOA' => $this->WidthOA,
            'F_HighRated' => $this->F_HighRated,
            'F_LowRated' => $this->F_LowRated,
            'MotorLength' => $this->MotorLength,
            'MotorWidth' => $this->MotorWidth,
            'FlangeH' => $this->FlangeH,
            'MagDiam' => $this->MagDiam,
            'MagH' => $this->MagH,
            'MagMass' => $this->MagMass,
            'Bpeak' => $this->Bpeak,
            'BaffleCutoutDiam' => $this->BaffleCutoutDiam,
            'BaffleCutoutLength' => $this->BaffleCutoutLength,
            'BaffleCutoutWidth' => $this->BaffleCutoutWidth,
            'BoltCircleDiam' => $this->BoltCircleDiam,
            'BoltCircleScrewDiam' => $this->BoltCircleScrewDiam,
            'BoltCircleScrewQty' => $this->BoltCircleScrewQty,
            'TerminalPairsQty' => $this->TerminalPairsQty,
            'TempLowPerfRated' => $this->TempLowPerfRated,
            'TempHighPerfRated' => $this->TempHighPerfRated,
            'TempLowDamageRated' => $this->TempLowDamageRated,
            'TempHighDamageRated' => $this->TempHighDamageRated,
            'HumidityLowPerfRated' => $this->HumidityLowPerfRated,
            'HumidityHighPerfRated' => $this->HumidityHighPerfRated,
            'HumidityLowDamageRated' => $this->HumidityLowDamageRated,
            'HumidityHighDamageRated' => $this->HumidityHighDamageRated,
            'Urms_100H_Max' => $this->Urms_100H_Max,
            'Urms_Max_Rated' => $this->Urms_Max_Rated,
            //'Pmax_Rated' => $this->Pmax_Rated,
            'BL1' => $this->BL1,
            'BL2' => $this->BL2,
            'BL3' => $this->BL3,
            'BL4' => $this->BL4,
            'BL5' => $this->BL5,
            'BL6' => $this->BL6,
            'BL7' => $this->BL7,
            'BL8' => $this->BL8,
            'K1' => $this->K1,
            'K2' => $this->K2,
            'K3' => $this->K3,
            'K4' => $this->K4,
            'K5' => $this->K5,
            'K6' => $this->K6,
            'K7' => $this->K7,
            'K8' => $this->K8,
            'Lx1' => $this->Lx1,
            'Lx2' => $this->Lx2,
            'Lx3' => $this->Lx3,
            'Lx4' => $this->Lx4,
            'Lx5' => $this->Lx5,
            'Lx6' => $this->Lx6,
            'Lx7' => $this->Lx7,
            'Lx8' => $this->Lx8,
            'Li1' => $this->Li1,
            'Li2' => $this->Li2,
            'Li3' => $this->Li3,
            'Li4' => $this->Li4,
            'Rmv1' => $this->Rmv1,
            'Rmv2' => $this->Rmv2,
            'Rmv3' => $this->Rmv3,
            'Rmv4' => $this->Rmv4,
            'Rtm' => $this->Rtm,
            'Rtv' => $this->Rtv,
            'tauC' => $this->tauC,
            'tauM' => $this->tauM,
            'Rv' => $this->Rv,
            'AlphaBypass' => $this->AlphaBypass,
            'Ctm' => $this->Ctm,
            'Ctv' => $this->Ctv,
        ]);

        $query->andFilterWhere(['like', 'DataSource', $this->DataSource])
            //->andFilterWhere(['like', 'Brand', $this->Brand])
            ->andFilterWhere(['like', 'Model', $this->Model])
            ->andFilterWhere(['like', 'Revision', $this->Revision])
            ->andFilterWhere(['like', 'TargetCurve', $this->TargetCurve])
            ->andFilterWhere(['like', 'TestSignal', $this->TestSignal])
            ->andFilterWhere(['like', 'URL', $this->URL])
            ->andFilterWhere(['like', 'DataSheet', $this->DataSheet])
            ->andFilterWhere(['like', 'VCMat', $this->VCMat])
            ->andFilterWhere(['like', 'FormerMat', $this->FormerMat])
            ->andFilterWhere(['like', 'DiaphMat', $this->DiaphMat])
            ->andFilterWhere(['like', 'SurrMat', $this->SurrMat])
            ->andFilterWhere(['like', 'SpidMat', $this->SpidMat])
            ->andFilterWhere(['like', 'FrameMat', $this->FrameMat])
            ->andFilterWhere(['like', 'MagMat', $this->MagMat])
            ->andFilterWhere(['like', 'DiaphShape', $this->DiaphShape])
            ->andFilterWhere(['like', 'MotorShape', $this->MotorShape])
            ->andFilterWhere(['like', 'DIY_Availability', $this->DIY_Availability])
            ->andFilterWhere(['like', 'Application', $this->Application])
            ->andFilterWhere(['like', 'Notes', $this->Notes]);
            
        $query->andFilterWhere(['like', 'DataSource', $this->DataSource])
            ->andFilterWhere(['in', 'Brand', $this->Brand])
            ->andFilterWhere(['in', 'Type', $this->Type]);
            
        $query->andFilterWhere(['between', 'Cost', $this->cost_min, $this->cost_max])
              ->andFilterWhere(['between', 'DiamOA', $this->diam_oa_min, $this->diam_oa_max])
              ->andFilterWhere(['between', 'HeightOA', $this->height_oa_min, $this->height_oa_max])
              ->andFilterWhere(['between', 'MassOA', $this->mass_oa_min, $this->mass_oa_max])
              ->andFilterWhere(['between', 'Pmax_Rated', $this->pmax_rated_min, $this->pmax_rated_max]);   

        return $dataProvider;
    }
}
