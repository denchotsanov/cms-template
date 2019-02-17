<?php
/**
 * Created by PhpStorm.
 * User: DTSHOME
 * Date: 16/2/2019
 * Time: 19:31 ч.
 */

namespace backend\models;


use Yii;

class User extends \common\models\User
{

    public function getUserAvatarUrl(){

//@todo: да го добавя при релация с профилна таблица
//        if(strpos($this->avatar,'http')!== false){
//            return $this->avatar;
//        }
//        if($this->crop_avatar){
//            return Yii::$app->request->baseUrl .'/uploads/avatars/'.$this->crop_avatar;
//        }
//        if($this->avatar){
//            return Yii::$app->request->baseUrl .'/uploads/avatars/'.$this->avatar;
//        }

        return Yii::$app->request->baseUrl .'/img/avatar5.png';
    }
}