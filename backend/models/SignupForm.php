<?php
namespace backend\models;
use common\models\User;
use yii\base\Model;
use yii\rbac\Role;

/**
 * Created by PhpStorm.
 * User: DTSHOME
 * Date: 7/2/2019
 * Time: 23:19 ч.
 */

class SignupForm extends Model
{
    public $fullname;
    public $email;
    public $password;
    public $confirmPassword;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['fullname', 'trim'],
            ['fullname', 'required'],
            ['fullname', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['confirmPassword', 'required'],
            ['confirmPassword', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     * @throws \yii\base\Exception
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();

        $user->username = 'user'. time();
        $user->email = $this->email;

        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}