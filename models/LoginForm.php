<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    //public $username;
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';

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
            // email and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // email must be a valid email address
            ['email' , 'email'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

//     public function rules()
// {
//     return [
//         // person data, email and password are all required in "register" scenario
//         [['name', 'surname', 'gender', 'employment', 'email', 'password'], 'required', 'on' => self::SCENARIO_REGISTER],
//         // email and password are required in "login" scenario
//         [['email', 'password'], 'required', 'on' => self::SCENARIO_LOGIN],
//         // rememberMe must be a boolean value
//         ['rememberMe', 'boolean', 'on' => self::SCENARIO_LOGIN],
//         // password is validated by validatePassword()
//         ['password', 'validatePassword', 'on' => self::SCENARIO_LOGIN],
//         // email must be a valid email address
//         ['email' , 'email'],
//     ];
// }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Registers a new user.
     * @return bool whether the user is registered successfully
     */
    public function register()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            //$this->_user = User::findByUsername($this->username);
            $this->_user = User::findByEmail($this->email);
        }
        return $this->_user;
    }
}
