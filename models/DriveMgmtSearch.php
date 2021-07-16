<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class DriveMgmtSearch extends DriveMgmt
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'location', 'notes'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = DriveMgmt::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['name' => SORT_ASC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
