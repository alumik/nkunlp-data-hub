<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CcDownloadSearch extends CcDownload
{
    public $driveName;
    public $prefixAndPath;

    public function rules(): array
    {
        return [
            [['id', 'id_cc_data', 'status'], 'integer'],
            [['driveName', 'prefixAndPath'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($params): ActiveDataProvider
    {
        $query = CcDownload::find();

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
        $dataProvider->sort->attributes['prefixAndPath'] = [
            'asc' => ['cc_storage.prefix' => SORT_ASC, 'cc_storage.path' => SORT_ASC],
            'desc' => ['cc_storage.prefix' => SORT_DESC, 'cc_storage.path' => SORT_DESC],
        ];

        $query->andFilterWhere([
            'id' => $this->id,
            'id_cc_data' => $this->id_cc_data,
            'status' => $this->status,
        ]);
        $query->leftJoin(CcStorage::tableName(), 'cc_download.id_storage = cc_storage.id');
        $query->leftJoin(Drive::tableName(), 'cc_storage.id_drive = drive.id');
        $query->leftJoin(YearMonth::tableName(), 'cc_storage.id_year_month = year_month.id');
        $query->andFilterWhere(['like', 'drive.name', $this->driveName]);
        $query->andFilterWhere([
            'like',
            'CONCAT(year_month.year, "-", year_month.month, "/", cc_storage.prefix, "/", cc_storage.path)',
            $this->prefixAndPath,
        ]);

        return $dataProvider;
    }
}
