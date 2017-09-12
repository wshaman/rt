<?php
/**
 * Created by PhpStorm.
 * User: wshaman
 * Date: 9/11/17
 * Time: 10:32 PM
 */

namespace app\rbac;

use Yii;
use yii\rbac\Rule;

class Resolver extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest) {
            $group = \Yii::$app->user->identity->group;
            if ($group === 'admin') return true;
            if ($item->name === 'admin') {
                return $group == 'admin';
            } elseif ($item->name === 'manager') {
                return $group == 'admin' || $group == 'manager';
            } elseif ($item->name === 'reader') {
                return $group == 'admin' || $group == 'reader';
            }
        }
        return true;
    }
}