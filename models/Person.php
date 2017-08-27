<?php

namespace app\models;
use yii\data\ActiveDataProvider;
use yii\db\Query;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property integer $personId
 * @property string $name
 * @property string $surname
 * @property string $gender
 * @property string $employment
 * @property string $email
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 *
 * @property Assignment[] $assignments
 * @property Slot[] $slots
 * @property Competence[] $competences
 * @property Role[] $roles
 * @property PersonCity[] $personCities
 * @property City[] $cities
 * @property PersonUnavailable[] $personUnavailables
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'gender', 'employment', 'email', 'password'], 'required'],
            [['gender', 'employment'], 'string'],
            [['name', 'surname', 'email', 'authKey', 'accessToken'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'personId' => 'Person ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'gender' => 'Gender',
            'employment' => 'Employment',
            'email' => 'Email',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignments()
    {
        return $this->hasMany(Assignment::className(), ['personId' => 'personId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlots()
    {
        return $this->hasMany(Slot::className(), ['slotId' => 'slotId'])->viaTable('assignment', ['personId' => 'personId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompetences()
    {
        return $this->hasMany(Competence::className(), ['personId' => 'personId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Role::className(), ['roleId' => 'roleId'])->viaTable('competence', ['personId' => 'personId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonCities()
    {
        return $this->hasMany(PersonCity::className(), ['personId' => 'personId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['cityId' => 'cityId'])->viaTable('person_city', ['personId' => 'personId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonUnavailables()
    {
        return $this->hasMany(PersonUnavailable::className(), ['personId' => 'personId']);
    }

    /*
    * Converts the given password to hash for safe storage in the db
    */
    public function convertToHash()
    {
        Yii::trace("Converting '$this->password' to hash...", $category = 'registration');
        if (!empty($this->password))
        {
              $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }
    }

    /**
     * @return \yii\data\ActiveDataProvider
     */
    public function getPeopleForView()
    {
        $query = Person::find()->all();

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'surname' => SORT_ASC,
                ]
            ],
        ]);

        //$ids = $provider->getKeys();
        return $provider;
    }
}
