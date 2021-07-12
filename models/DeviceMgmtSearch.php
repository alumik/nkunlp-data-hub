<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class DeviceMgmtSearch extends DeviceMgmt
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'archive', 'cc_code', 'notes'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = DeviceMgmt::find();

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

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'archive', $this->archive])
            ->andFilterWhere(['like', 'cc_code', $this->cc_code])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
