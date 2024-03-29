<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CcStorageSearch extends CcStorage
{
    public $driveName;
    public $yearMonthStr;

    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['driveName', 'prefix', 'path', 'yearMonthStr'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($params): ActiveDataProvider
    {
        $query = CcStorage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $dataProvider->sort->attributes['driveName'] = [
            'asc' => ['drive.name' => SORT_ASC, 'id' => SORT_ASC],
            'desc' => ['drive.name' => SORT_DESC, 'id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['yearMonthStr'] = [
            'asc' => ['year_month.year' => SORT_ASC, 'year_month.month' => SORT_ASC, 'id' => SORT_ASC],
            'desc' => ['year_month.year' => SORT_DESC, 'year_month.month' => SORT_DESC, 'id' => SORT_DESC],
        ];

        $query->andFilterWhere([
            'cc_storage.id' => $this->id,
        ]);
        $query->andFilterWhere(['like', 'cc_storage.prefix', $this->prefix])
            ->andFilterWhere(['like', 'cc_storage.path', $this->path]);
        $query->leftJoin(Drive::tableName(), 'cc_storage.id_drive = drive.id');
        $query->leftJoin(YearMonth::tableName(), 'cc_storage.id_year_month = year_month.id');
        $query->andFilterWhere(['like', 'drive.name', $this->driveName]);
        $query->andFilterWhere(['like', 'CONCAT(year_month.year, "-", year_month.month)', $this->yearMonthStr]);

        return $dataProvider;
    }
}
