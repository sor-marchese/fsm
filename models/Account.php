<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property integer $personId
 *
 * @property Person $person
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'authKey'], 'required'],
            [['personId'], 'integer'],
            [['username', 'email', 'password', 'authKey', 'accessToken'], 'string', 'max' => 255],
            ['email', 'email'],
            [['personId'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['personId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'personId' => 'Person ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'personId']);
    }

    public function convertToHash()
    {
        Yii::trace("Converting '$this->password' to hash...", $category = 'registration');
        if (!empty($this->password))
        {
              $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }
    }
}
