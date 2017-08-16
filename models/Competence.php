<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "competence".
 *
 * @property integer $person
 * @property integer $role
 * @property string $level
 *
 * @property Person $person0
 * @property Role $role0
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
            [['person', 'role', 'level'], 'required'],
            [['person', 'role'], 'integer'],
            [['level'], 'string'],
            [['person'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person' => 'id']],
            [['role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person' => 'Person',
            'role' => 'Role',
            'level' => 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson0()
    {
        return $this->hasOne(Person::className(), ['id' => 'person']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole0()
    {
        return $this->hasOne(Role::className(), ['Id' => 'role']);
    }
}
