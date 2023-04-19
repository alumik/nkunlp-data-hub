<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CcDataSearch extends CcData
{
    public $yearMonthStr;

    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['uri', 'yearMonthStr'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($params): ActiveDataProvider
    {
        $query = CcData::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['yearMonthStr'] = [
            'asc' => ['year_month.year' => SORT_ASC, 'year_month.month' => SORT_ASC, 'id' => SORT_ASC],
            'desc' => ['year_month.year' => SORT_DESC, 'year_month.month' => SORT_DESC, 'id' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['cc_data.id' => $this->id]);
        $query->andFilterWhere(['like', 'cc_data.uri', $this->uri]);
        $query->leftJoin(YearMonth::tableName(), 'cc_data.id_year_month = year_month.id');
        $query->andFilterWhere(['like', 'CONCAT(year_month.year, "-", year_month.month)', $this->yearMonthStr]);


        return $dataProvider;
    }
}
