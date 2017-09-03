<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person_city".
 *
 * @property integer $personId
 * @property integer $cityId
 *
 * @property City $city
 * @property Person $person
 */
class PersonCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['personId', 'cityId'], 'required'],
            [['personId', 'cityId'], 'integer'],
            [['cityId'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['cityId' => 'cityId']],
            [['personId'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['personId' => 'personId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'personId' => 'Person ID',
            'cityId' => 'City ID',
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
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['personId' => 'personId']);
    }
}
