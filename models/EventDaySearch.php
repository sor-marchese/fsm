<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EventDay;

/**
 * EventDaySearch represents the model behind the search form about `app\models\EventDay`.
 */
class EventDaySearch extends EventDay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eventDayId', 'eventId'], 'integer'],
            [['date', 'activity'], 'safe'],
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
        $query = EventDay::find();

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
            'eventDayId' => $this->eventDayId,
            'eventId' => $this->eventId,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'activity', $this->activity]);

        return $dataProvider;
    }
}
