<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ServerMgmtSearch extends ServerMgmt
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['server', 'device', 'task', 'notes'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ServerMgmt::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['server' => SORT_ASC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'server', $this->server])
            ->andFilterWhere(['like', 'device', $this->device])
            ->andFilterWhere(['like', 'task', $this->task])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
