<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;


class UserStatusUpdate extends Model
{

    public $userId;
    public $status;

    public function rules()
    {
        return [
            [['userId', 'status'], 'required' ],
            [['userId', 'status'], 'integer' ],
            ['status',
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
        ];
    }

    public function update(){

        $model = User::find()->where(['id'=> $this->userId])->one();
        if(!$model){
            throw new NotFoundHttpException(Yii::t('admin','User not exist'));
        }

        $model->status = $this->status;
        return $model->save();
    }
}