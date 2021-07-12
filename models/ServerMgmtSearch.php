<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ServerMgmt;

/**
 * ServerMgmtSearch represents the model behind the search form of `app\models\ServerMgmt`.
 */
class ServerMgmtSearch extends ServerMgmt
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_device', 'mounted'], 'integer'],
            [['server', 'task', 'notes'], 'safe'],
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
        $query = ServerMgmt::find()->orderBy('server, task');

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
            'id_device' => $this->id_device,
            'mounted' => $this->mounted,
        ]);

        $query->andFilterWhere(['like', 'server', $this->server])
            ->andFilterWhere(['like', 'task', $this->task])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
