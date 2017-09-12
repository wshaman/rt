<?php
/**
 * Created by PhpStorm.
 * User: wshaman
 * Date: 9/11/17
 * Time: 6:10 PM
 */

namespace app\components;

use Yii;
use app\components\F;

class Dict
{
    static function status($id=null){
        $statuses = [
            Consts::STATUS_NEWS_PUBLISHED => Yii::t('app', 'Published'),
            Consts::STATUS_NEWS_DRAFT => Yii::t('app', 'Draft'),
        ];
        if($id===null) return $statuses;
        return F::array_get($statuses, $id);
    }
}