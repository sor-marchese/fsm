<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use app\models\EventDay;

/**
 * This is the model class for table "event".
 *
 * @property integer $eventId
 * @property string $name
 * @property integer $cityId
 * @property string $start_date
 * @property string $end_date
 *
 * @property City $city
 * @property EventDay[] $eventDays
 */
class Event extends \yii\db\ActiveRecord
{
    // not in the db but needed for DATAPROVIDER!!!
    public $start_date;
    public $end_date;
    public $city;
    public $region;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'start_date', 'end_date'], 'required'],
            [['cityId'], 'integer'],
            ['end_date','compare','compareAttribute'=>'start_date','operator'=>'>'],
            [['name'], 'string', 'max' => 255],
            [['cityId'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['cityId' => 'cityId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eventId' => 'Event ID',
            'name' => 'Name',
            'cityId' => 'City ID',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['cityId' => 'cityId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventDays()
    {
        return $this->hasMany(EventDay::className(), ['eventId' => 'eventId']);
    }

    /**
     * @return Array of days to be saved in the DB
     */
    public function getSingleDays()
    {
        $startDate = new \DateTime($this->start_date);
        $endDate = new \DateTime($this->end_date);
        $days = array();

        $interval = new \DateInterval('P1D');
        // because period ignores the last day otherwise
        $endDate = $endDate->modify('+1 day');
        $dateRange = new \DatePeriod($startDate, $interval, $endDate);
        foreach ($dateRange as $day)
        {
            // $days[] = $day->format('Y-m-d');
            $days[] = $day->format('Y-m-d');
        }
        // dd($days); // DEBUG
        return $days;
    }

    /**
     * @return Array of start_date and end_date for current Event
     */
    public function getEventDates($eventId)
    {
        $eventDays = EventDay::find()->innerJoin('event', 'event_day.eventId = event.eventId')->orderBy(['date'=>SORT_ASC])->all();
        $start = reset($eventDays)->date;
        $end = end($eventDays)->date;
        $days = array('startDate' => $start, 'endDate' => $end);
        // dd($days); // DEBUG
        return $days;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventsForView()
    {
        // $query = Event::find()->innerJoin('city', 'event.cityId = city.cityId');
        $query = Event::find()->select(['event.eventId', 'event.name', 'city.name AS city', 'city.region AS region',
            'MIN(event_day.date) AS start_date', 'MAX(event_day.date) AS end_date']
            )->innerJoin('city', 'event.cityId = city.cityId'
            )->innerJoin('event_day', 'event.eventId = event_day.eventId');

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            // 'sort' => [
            //     'defaultOrder' => [
            //         'name' => SORT_ASC,
            //     ]
            // ],
        ]);
        // dd($provider); // DEBUG
        //$ids = $provider->getKeys();
        return $provider;
    }
}
