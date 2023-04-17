<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CcFilterSearch extends CcFilter
{
    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name', 'parameters'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($params): ActiveDataProvider
    {
        $query = CcFilter::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'parameters', $this->parameters]);

        return $dataProvider;
    }
}
