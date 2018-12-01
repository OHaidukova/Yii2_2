<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tasks;

/**
 * TasksSearch represents the model behind the search form of `app\models\tables\Tasks`.
 */
class TasksSearch extends Tasks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_developer', 'id_initiator', 'id_status', 'id_project'], 'integer'],
            [['number', 'name', 'details', 'date_create', 'date_resolve'], 'safe'],
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
        $query = Tasks::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2
            ]
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
            'id_developer' => $this->id_developer,
            'date_create' => $this->date_create,
            'date_resolve' => $this->date_resolve,
            'id_status' => $this->id_status,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'details', $this->details]);

        return $dataProvider;
    }
}