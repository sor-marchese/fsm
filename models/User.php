<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Account;
use yii\web\IdentityInterface;

class User extends \app\models\Person implements \yii\web\IdentityInterface
{


    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';

    // Needed???
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_LOGIN] = ['email', 'password'];
        $scenarios[self::SCENARIO_REGISTER] = ['name', 'surname', 'gender', 'employment', 'email', 'password'];
        return $scenarios;
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // person data, email and password are all required in "register" scenario
            [['name', 'surname', 'gender', 'employment', 'email', 'password'], 'required', 'on' => self::SCENARIO_REGISTER],
            // email must be a valid email address
            ['email' , 'email'],
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

      /**
      * Finds user by username
      *
      * @param string $username
      * @return static|null
      */
    // public static function findByUsername($username)
    // {
    //     return static::findOne(['username' => $username]);
    // }

    /**
    * Finds user by email
    *
    * @param string $email
    * @return static|null
    */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->personId;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
      Yii::trace('Validating password: '. $password .' for user: ' . $this->email, $category = 'login');
      $hash = $this->password;
      return Yii::$app->getSecurity()->validatePassword($password, $hash);
    }

}

// OLD CODE
// public $id;
// public $username;
// public $password;
// public $authKey;
// public $accessToken;

//
// private static $users = [
//     '100' => [
//         'id' => '100',
//         'username' => 'admin',
//         'password' => 'admin',
//         'authKey' => 'test100key',
//         'accessToken' => '100-token',
//     ],
//     '101' => [
//         'id' => '101',
//         'username' => 'demo',
//         'password' => 'demo',
//         'authKey' => 'test101key',
//         'accessToken' => '101-token',
//     ],
// ];


//
// /**
//  * @inheritdoc
//  */
// public static function findIdentity($id)
// {
//     return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
// }
//
// /**
//  * @inheritdoc
//  */
// public static function findIdentityByAccessToken($token, $type = null)
// {
//     foreach (self::$users as $user) {
//         if ($user['accessToken'] === $token) {
//             return new static($user);
//         }
//     }
//
//     return null;
// }
//

// /**
//  * Finds user by username
//  *
//  * @param string $username
//  * @return static|null
//  */
// public static function findByUsername($username)
// {
//     foreach (self::$users as $user) {
//         if (strcasecmp($user['username'], $username) === 0) {
//             return new static($user);
//         }
//     }
//
//     return null;
// }
