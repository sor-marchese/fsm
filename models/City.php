<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $cityId
 * @property string $name
 *
 * @property Event[] $events
 * @property PersonCity[] $personCities
 * @property Person[] $people
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cityId' => 'City ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['cityId' => 'cityId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonCities()
    {
        return $this->hasMany(PersonCity::className(), ['cityId' => 'cityId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['personId' => 'personId'])->viaTable('person_city', ['cityId' => 'cityId']);
    }
}
