<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;

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
            $days[] = $day->format('Y-m-d');
        }
        // dd($days); // DEBUG
        return $days;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventsForView()
    {
        $query = Event::find()->innerJoin('city', 'event.cityId = city.cityId');

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_ASC,
                ]
            ],
        ]);

        //$ids = $provider->getKeys();
        return $provider;
    }
}
