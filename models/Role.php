<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property integer $Id
 * @property string $name
 *
 * @property Competence[] $competences
 * @property Person[] $people
 * @property Slot[] $slots
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 42],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompetences()
    {
        return $this->hasMany(Competence::className(), ['role' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['id' => 'person'])->viaTable('competence', ['role' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlots()
    {
        return $this->hasMany(Slot::className(), ['role' => 'Id']);
    }
}
