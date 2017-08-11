<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $gender
 * @property string $employment
 *
 * @property Account[] $accounts
 * @property Assignment[] $assignments
 * @property Competence[] $competences
 * @property Role[] $roles
 * @property PersonCity[] $personCities
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
            [['name', 'surname', 'gender', 'employment'], 'required'],
            [['gender', 'employment'], 'string'],
            [['name', 'surname'], 'string', 'max' => 42],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'gender' => 'Gender',
            'employment' => 'Employment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['personId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignments()
    {
        return $this->hasMany(Assignment::className(), ['person' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompetences()
    {
        return $this->hasMany(Competence::className(), ['person' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Role::className(), ['Id' => 'role'])->viaTable('competence', ['person' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonCities()
    {
        return $this->hasMany(PersonCity::className(), ['person' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonUnavailables()
    {
        return $this->hasMany(PersonUnavailable::className(), ['person' => 'id']);
    }
}
