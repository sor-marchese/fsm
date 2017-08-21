<?php

namespace app\models;

use Yii;
use app\models\Person;
use app\models\Role;

/**
 * This is the model class for table "competence".
 *
 * @property integer $personId
 * @property integer $roleId
 * @property string $level
 *
 * @property Person $person
 * @property Role $role
 */
class Competence extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'competence';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['personId', 'roleId', 'level'], 'required'],
            [['personId', 'roleId'], 'integer'],
            [['level'], 'string'],
            [['personId'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['personId' => 'personId']],
            [['roleId'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['roleId' => 'roleId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'personId' => 'Person ID',
            'roleId' => 'Role ID',
            'level' => 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['personId' => 'personId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return Person::find()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['roleId' => 'roleId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return Role::find()->all();
    }
}
