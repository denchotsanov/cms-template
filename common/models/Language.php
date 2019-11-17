<?php
/**
 * User: dencho
 */

namespace common\models;


use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Language extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    public static function tableName()
    {
        return '{{%language}}';
    }

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


    /**
     *  Return all active Languages
     *
     * @return array[]
     */
    public static function getLanguages(){
        $language = Language::find()
            ->where(['status'=>self::STATUS_ACTIVE])
            ->all();
        return ArrayHelper::map($language, 'code', 'name');
    }

    public function getFlagList() {
        return [
            'ad','ae','af','ag','ai','al','am','ao','aq','ar','as','at','au','aw','ax','az','ba','bb','bd','be',
            'bf','bg','bh','bi','bj','bl','bm','bn','bo','bq','br','bs','bt','bv','bw','by','bz','ca','cc','cd','cf','cg',
            'ch','ci','ck','cl','cm','cn','co','cr','cu','cv','cw','cx','cy','cz','de','dj','dk','dm','do','dz','ec','ee',
            'eg','eh','er','es','et','fi','fj','fk','fm','fo','fr','ga','gb','gd','ge','gf','gg','gh','gi','gl','gm','gn',
            'gp','gq','gr','gs','gt','gu','gw','gy','hk','hm','hn','hr','ht','hu','id','ie','il','im','in','io','iq','ir',
            'is','it','je','jm','jo','jp','ke','kg','kh','ki','km','kn','kp','kr','kw','ky','kz','la','lb','lc','li','lk',
            'lr','ls','lt','lu','lv','ly','ma','mc','md','me','mf','mg','mh','mk','ml','mm','mn','mo','mp','mq','mr','ms',
            'mt','mu','mv','mw','mx','my','mz','na','nc','ne','nf','ng','ni','nl','no','np','nr','nu','nz','om','pa','pe',
            'pf','pg','ph','pk','pl','pm','pn','pr','ps','pt','pw','py','qa','re','ro','rs','ru','rw','sa','sb','sc','sd',
            'se','sg','sh','si','sj','sk','sl','sm','sn','so','sr','ss','st','sv','sx','sy','sz','tc','td','tf','tg','th',
            'tj','tk','tl','tm','tn','to','tr','tt','tv','tw','tz','ua','ug','um','us','uy','uz','va','vc','ve','vg','vi',
            'vn','vu','wf','ws','ye','yt','za','zm','zw','eu','gb-eng','gb-sct','gb-wls','un'
        ];
    }
    public function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('admin','Active'),
            self::STATUS_DELETED => Yii::t('admin','Deleted'),
        ];
    }

}