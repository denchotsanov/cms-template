<?php
/**
 * User: dencho
 */

namespace common\models;


use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Language extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            ['code', 'unique'],
            [['code', 'name', 'status'], 'safe'],
            [['code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 16],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['name', 'status'], 'safe', 'on' => 'update'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('admin', 'Name'),
            'code' => Yii::t('admin', 'Code'),
            'status' => Yii::t('admin', 'Status'),
        ];
    }
}