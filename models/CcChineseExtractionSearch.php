<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CcChineseExtraction;

/**
 * CcChineseExtractionSearch represents the model behind the search form of `app\models\CcChineseExtraction`.
 */
class CcChineseExtractionSearch extends CcChineseExtraction
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_cc_download', 'id_storage'], 'integer'],
            [['started_at', 'finished_at'], 'safe'],
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
        $query = CcChineseExtraction::find();

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
            'id_cc_download' => $this->id_cc_download,
            'id_storage' => $this->id_storage,
            'started_at' => $this->started_at,
            'finished_at' => $this->finished_at,
        ]);

        return $dataProvider;
    }
}
