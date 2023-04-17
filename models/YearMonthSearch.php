<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class YearMonthSearch extends YearMonth
{
    public function rules(): array
    {
        return [
            [['year', 'month', 'cc_code'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($params): ActiveDataProvider
    {
        $query = YearMonth::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'month', $this->month])
            ->andFilterWhere(['like', 'cc_code', $this->cc_code]);

        return $dataProvider;
    }
}
