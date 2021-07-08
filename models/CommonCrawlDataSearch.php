<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CommonCrawlDataSearch extends CommonCrawlData
{
    public function rules()
    {
        return [
            [['id', 'size', 'process_state', 'download_state', 'id_worker'], 'integer'],
            [['uri', 'started_at', 'finished_at', 'archive'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CommonCrawlData::find();

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
            'size' => $this->size,
            'started_at' => $this->started_at,
            'finished_at' => $this->finished_at,
            'process_state' => $this->process_state,
            'download_state' => $this->download_state,
            'id_worker' => $this->id_worker,
        ]);

        $query->andFilterWhere(['like', 'uri', $this->uri])
            ->andFilterWhere(['like', 'archive', $this->archive . '%', false]);

        return $dataProvider;
    }
}
