<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Competence;

/**
 * CompetenceSearch represents the model behind the search form about `app\models\Competence`.
 */
class CompetenceSearch extends Competence
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person', 'role'], 'integer'],
            [['level'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Competence::find();

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
            'person' => $this->person,
            'role' => $this->role,
        ]);

        $query->andFilterWhere(['like', 'level', $this->level]);

        return $dataProvider;
    }
}
