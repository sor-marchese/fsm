<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event_day".
 *
 * @property integer $eventDayId
 * @property integer $eventId
 * @property string $date
 * @property string $activity
 *
 * @property Event $event
 * @property Slot[] $slots
 */
class EventDay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_day';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eventId', 'date', 'activity'], 'required'],
            [['eventId'], 'integer'],
            [['date'], 'safe'],
            [['activity'], 'string'],
            [['eventId'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['eventId' => 'eventId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eventDayId' => Yii::t('app', 'Event Day ID'),
            'eventId' => Yii::t('app', 'Event ID'),
            'date' => Yii::t('app', 'Date'),
            'activity' => Yii::t('app', 'Activity'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['eventId' => 'eventId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlots()
    {
        return $this->hasMany(Slot::className(), ['eventDayId' => 'eventDayId']);
    }
}
