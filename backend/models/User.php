<?php
/**
 * Created by PhpStorm.
 * User: DTSHOME
 * Date: 16/2/2019
 * Time: 19:31 ч.
 */

namespace backend\models;

use common\models\User as CommonUser;

class User extends CommonUser {

    public $name;
    public $language;


}