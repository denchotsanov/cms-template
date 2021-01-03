<?php
/*
 * @author Dencho Tsanov <dencho@tsanov.eu>
 * @licence MIT License
 * @copyright Copyright (c) 2021. Dencho Tsanov. All rights reserved.
 */

namespace backend\models;

use yii\base\Model;

class UserForm extends Model
{
    public $email;
    public $password;
    public $status = User::STATUS_PENDING;
    public $role;


    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email',
                'unique',
                'targetClass' => '\common\models\User',
                'message' => 'This email address has already been taken.'
            ],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            [['role', 'success', 'status'], 'safe'],
        ];
    }

    public function createNewUser()
    {

        if (!$this->validate()) {
            return false;
        }
        $user = new User();
        $user->username = 'user' . time();
        $user->email = $this->email;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save();
    }
}
