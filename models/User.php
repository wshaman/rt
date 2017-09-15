<?php

namespace app\models;

/**
 * Class User
 * @package app\models
 * @property integer role_name
 *
 */
class User extends \nkostadinov\user\models\User
{
    public $skip_before_save = false;

    public function beforeSave($insert)
    {
        if($this->skip_before_save) return true;
        return parent::beforeSave($insert);
    }

    public function name()
    {
        return ($this->username) ? $this->username : $this->email;
    }
//    public static function isGuest()
//    {
//        return false;
//    }
}
