<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\Response;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_PENDING = 1;
    const STATUS_BANED = 2;
    const STATUS_LOCKED = 3;
    const STATUS_PASSWORD_RECOVER = 4;
    const STATUS_ACTIVE = 10;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => time(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_PENDING],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key'=>$token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     * @throws \yii\base\Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();

    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @return array
     */
    public function getStatusList()
    {
        return [
            self::STATUS_DELETED => 'Denied',
            self::STATUS_PENDING => 'Pending',
            self::STATUS_BANED =>'Banned',
            self::STATUS_LOCKED =>'Locked',
            self::STATUS_PASSWORD_RECOVER =>'Password Recovery',
            self::STATUS_ACTIVE => 'Active',
        ];
    }
    public function getHtmlStatusList()
    {
        return [
            self::STATUS_DELETED => '<span class="label label-danger">Denied</span>',
            self::STATUS_PENDING => '<span class="label label-warning">Pending</span>',
            self::STATUS_BANED =>'<span class="label label-warning">Banned</span>',
            self::STATUS_LOCKED =>'<span class="label label-warning">Locked</span>',
            self::STATUS_PASSWORD_RECOVER =>'<span class="label label-warning">Password Recovery</span>',
            self::STATUS_ACTIVE => '<span class="label label-success">Active</span>',
        ];
    }

    public function getStatusLabel(){
        return $this->statusList[$this->status];
    }
    public function getHtmlStatusLabel(){
        return $this->htmlStatusList[$this->status];
    }

    public function getUserInfo($isJson=false){
        $model = [
            'id' =>$this->id,
            'username' => $this->email,
            'fullname' => $this->email,
            'avatar' => $this->getUserAvatarUrl(),
            'created' => date('M. Y',$this->created_at),
        ];

        if($isJson){
            return json_encode($model,true);
        }
        return $model;

    }

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
