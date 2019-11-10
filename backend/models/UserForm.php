<?php
/**
 * Created by PhpStorm.
 * User: DTSHOME
 * Date: 22/2/2019
 * Time: 20:23 ч.
 */

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class UserForm extends Model
{
    public $email;
    public $password;
    public $status = User::STATUS_INACTIVE;
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

            [
                'status',
                'in',
                'range' => [
                    User::STATUS_ACTIVE,
                    User::STATUS_DELETED,
                    User::STATUS_BANED,
                    User::STATUS_INACTIVE,
                    User::STATUS_LOCKED,
                    User::STATUS_PASSWORD_RECOVER
                ]
            ],

            [['role', 'success'], 'safe'],
        ];
    }

    public function createNewUser()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = 'user' . time();
        $user->email = $this->email;
        $user->status = $this->status;
        $user->setPassword($this->password);
        if ($this->status == User::STATUS_INACTIVE) {
            $user->generateEmailVerificationToken();
        }
        $user->generateAuthKey();
        if ($user->save()) {
            $this->sendEmail($user);
            return ArrayHelper::merge(['success' => true], $user);
        } else {
            return ['error' => $user->getFirstError()];
        }
    }

    public function getAllRole()
    {
        $roleResult = [];
        $roleModel = Yii::$app->authManager->getRoles();

        foreach ($roleModel as $key => $role) {
            $roleResult[$key] = $role->name;
        }
        return $roleResult;
    }

    protected function sendEmail($user)
    {
        if ($this->status !== User::STATUS_INACTIVE) {
            return false;
        }
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

}