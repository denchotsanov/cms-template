<?php
/**
 * Created by PhpStorm.
 * User: DTSHOME
 * Date: 22/2/2019
 * Time: 20:23 ч.
 */

namespace backend\models;

use yii\base\Model;
use yii\helpers\ArrayHelper;

class UserForm extends Model
{
    public $email;
    public $password;
    public $status = \common\models\User::STATUS_PENDING;
    public $role;


    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['status', 'in', 'range' => [\common\models\User::STATUS_ACTIVE, \common\models\User::STATUS_DELETED]],

            [['role','success'],'safe'],
        ];
    }

    public function createNewUser()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = 'user'.time();
        $user->email = $this->email;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? ArrayHelper::merge(['success'=>true],$user) : ['error'=>$user->getFirstError()];
    }



}