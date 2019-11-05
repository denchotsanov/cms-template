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
     * @return array|ActiveRecord[]
     */
    public static function getLanguages(){
        return Language::find()->where(['status'=>self::STATUS_ACTIVE])->all();
    }

    public function getFlagList() {
        return ['ad','ae','af','ag','ai','al','am','ao','aq','ar','as','at','au','aw','ax','az','ba','bb','bd','be',
          'bf','bg','bh','bi','bj','bl','bm','bn','bo','bq','br','bs','bt','bv','bw','by','bz','ca','cc','cd','cf','cg',
          'ch','ci','ck','cl','cm','cn',
          'co',
          'cr',
          'cu',
          'cv',
          'cw',
          'cx',
          'cy',
          'cz cz cz',
          'de de de',
          'dj dj dj',
          'dk dk dk',
          'dm dm dm',
          'do do do',
          'dz dz dz',
          'ec ec ec',
          'ee ee ee',
          'eg eg eg',
          'eh eh eh',
          'er er er',
          'es es es',
          'et et et',
          'fi fi fi',
          'fj fj fj',
          'fk fk fk',
          'fm fm fm',
          'fo fo fo',
          'fr fr fr',
          'ga ga ga',
          'gb gb gb',
          'gd gd gd',
          'ge ge ge',
          'gf gf gf',
          'gg gg gg',
          'gh gh gh',
          'gi gi gi',
          'gl gl gl',
          'gm gm gm',
          'gn gn gn',
          'gp gp gp',
          'gq gq gq',
          'gr gr gr',
          'gs gs gs',
          'gt gt gt',
          'gu gu gu',
          'gw gw gw',
          'gy gy gy',
          'hk hk hk',
          'hm hm hm',
          'hn hn hn',
          'hr hr hr',
          'ht ht ht',
          'hu hu hu',
          'id id id',
          'ie ie ie',
          'il il il',
          'im im im',
          'in in in',
          'io io io',
          'iq iq iq',
          'ir ir ir',
          'is is is',
          'it it it',
          'je je je',
          'jm jm jm',
          'jo jo jo',
          'jp jp jp',
          'ke ke ke',
          'kg kg kg',
          'kh kh kh',
          'ki ki ki',
          'km km km',
          'kn kn kn',
          'kp kp kp',
          'kr kr kr',
          'kw kw kw',
          'ky ky ky',
          'kz kz kz',
          'la la la',
          'lb lb lb',
          'lc lc lc',
          'li li li',
          'lk lk lk',
          'lr lr lr',
          'ls ls ls',
          'lt lt lt',
          'lu lu lu',
          'lv lv lv',
          'ly ly ly',
          'ma ma ma',
          'mc mc mc',
          'md md md',
          'me me me',
          'mf mf mf',
          'mg mg mg',
          'mh mh mh',
          'mk mk mk',
          'ml ml ml',
          'mm mm mm',
          'mn mn mn',
          'mo mo mo',
          'mp mp mp',
          'mq mq mq',
          'mr mr mr',
          'ms ms ms',
          'mt mt mt',
          'mu mu mu',
          'mv mv mv',
          'mw mw mw',
          'mx mx mx',
          'my my my',
          'mz mz mz',
          'na na na',
          'nc nc nc',
          'ne ne ne',
          'nf nf nf',
          'ng ng ng',
          'ni ni ni',
          'nl nl nl',
          'no no no',
          'np np np',
          'nr nr nr',
          'nu nu nu',
          'nz nz nz',
          'om om om',
          'pa pa pa',
          'pe pe pe',
          'pf pf pf',
          'pg pg pg',
          'ph ph ph',
          'pk pk pk',
          'pl pl pl',
          'pm pm pm',
          'pn pn pn',
          'pr pr pr',
          'ps ps ps',
          'pt pt pt',
          'pw pw pw',
          'py py py',
          'qa qa qa',
          're re re',
          'ro ro ro',
          'rs rs rs',
          'ru ru ru',
          'rw rw rw',
          'sa sa sa',
          'sb sb sb',
          'sc sc sc',
          'sd sd sd',
          'se se se',
          'sg sg sg',
          'sh sh sh',
          'si si si',
          'sj sj sj',
          'sk sk sk',
          'sl sl sl',
          'sm sm sm',
          'sn sn sn',
          'so so so',
          'sr sr sr',
          'ss ss ss',
          'st st st',
          'sv sv sv',
          'sx sx sx',
          'sy sy sy',
          'sz sz sz',
          'tc tc tc',
          'td td td',
          'tf tf tf',
          'tg tg tg',
          'th th th',
          'tj tj tj',
          'tk tk tk',
          'tl tl tl',
          'tm tm tm',
          'tn tn tn',
          'to to to',
          'tr tr tr',
          'tt tt tt',
          'tv tv tv',
          'tw tw tw',
          'tz tz tz',
          'ua ua ua',
          'ug ug ug',
          'um',
          'us',
          'uy',
          'uz',
          'va',
          'vc',
          've',
          'vg',
          'vi',
          'vn',
          'vu',
          'wf',
          'ws',
          'ye',
          'yt',
          'za',
          'zm',
          'zw',
          'eu',
          'gb-eng',
          'gb-sct',
          'gb-wls',
          'un',
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