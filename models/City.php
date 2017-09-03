<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $cityId
 * @property string $name
 * @property string $province
 * @property string $region
 * @property integer $cap
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
            [['name', 'province', 'region', 'cap'], 'required'],
            [['cap'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['province'], 'string', 'max' => 2],
            [['region'], 'string', 'max' => 3],
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
            'province' => 'Province',
            'region' => 'Region',
            'cap' => 'Cap',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return City::find()
            ->select('region')
            ->distinct()
            ->orderBy('region')
            ->all();
    }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getCitiesForRegion($region)
    // {
    //     return City::find()
    //         ->where(['region' => $region])
    //         ->orderBy('name')
    //         ->all();
    // }
    //
    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getProvinces()
    // {
    //     return City::find()
    //         ->select('province')
    //         ->distinct()
    //         ->orderBy('province')
    //         ->all();
    // }
    //
    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getCitiesForProvince($province)
    // {
    //     return City::find()
    //         ->where(['province' => $province])
    //         ->orderBy('name')
    //         ->all();
    // }
}
