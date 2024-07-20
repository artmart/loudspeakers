<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Targets;

/**
 * TargetsSearch represents the model behind the search form of `frontend\models\Targets`.
 */
class TargetsSearch extends Targets
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entered_by'], 'integer'],
            [['target', 'entry_time', 'updated'], 'safe'],
            //[['size', 're', 'z1k', 'z10k', 'le', 'leb', 'ke', 'rss', 'fs', 'qms', 'qes', 'qts', 'rms', 'mms', 'cms', 'vas', 'sd', 'bl', 'pmax', 'xmax', 'beta', 'uspl', 'bl2_re', 'vocc', 'weight', 'diameter_oa', 'height_oa', 'cost'], 'number'],
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
        $query = Targets::find();

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
            /*'type' => $this->type,
            'size' => $this->size,
            'status' => $this->status,
            're' => $this->re,
            'z1k' => $this->z1k,
            'z10k' => $this->z10k,
            'le' => $this->le,
            'leb' => $this->leb,
            'ke' => $this->ke,
            'rss' => $this->rss,
            'fs' => $this->fs,
            'qms' => $this->qms,
            'qes' => $this->qes,
            'qts' => $this->qts,
            'rms' => $this->rms,
            'mms' => $this->mms,
            'cms' => $this->cms,
            'vas' => $this->vas,
            'sd' => $this->sd,
            'bl' => $this->bl,
            'pmax' => $this->pmax,
            'xmax' => $this->xmax,
            'beta' => $this->beta,
            'uspl' => $this->uspl,
            'bl2_re' => $this->bl2_re,
            
            'vocc' => $this->vocc,
            'weight' => $this->weight,
            'diameter_oa' => $this->diameter_oa,
            'height_oa' => $this->height_oa,
            'cost' => $this->cost,*/
            'updated' => $this->updated,
            'entered_by' => $this->entered_by,
            'entry_time' => $this->entry_time,
        ]);

        $query->andFilterWhere(['like', 'target', $this->target])
            //->andFilterWhere(['like', 'model', $this->model])
            //->andFilterWhere(['like', 'revision', $this->revision])
            ->andFilterWhere(['like', 'target_curve', $this->target_curve]);
            //->andFilterWhere(['like', 'test_signal', $this->test_signal])
            //->andFilterWhere(['like', 'webpage', $this->webpage])
            //->andFilterWhere(['like', 'data_sheet', $this->data_sheet]);

        return $dataProvider;
    }
}
