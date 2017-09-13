<?php
/**
 * Created by PhpStorm.
 * User: wshaman
 * Date: 9/11/17
 * Time: 6:10 PM
 */

namespace app\components;

use nkostadinov\user\models\User;
use Yii;
use app\components\F;

class Dict
{
    static function status($id=null)
    {
        $statuses = [
            Consts::STATUS_NEWS_PUBLISHED => Yii::t('app', 'Published'),
            Consts::STATUS_NEWS_DRAFT => Yii::t('app', 'Draft'),
        ];
        if($id===null) return $statuses;
        return F::array_get($statuses, $id);
    }

    static function user_status($id=null)
    {
            $statuses = [
            User::STATUS_ACTIVE => Yii::t('app', 'Active'),
            User::STATUS_DELETED => Yii::t('app', 'Deleted'),
        ];
        if($id===null) return $statuses;
        return F::array_get($statuses, $id);
    }
}