<?php
/**
 * Created by PhpStorm.
 * User: wshaman
 * Date: 9/12/17
 * Time: 12:54 AM
 */

namespace app\rbac;
use yii\rbac\Rule;


class ManagerEditAuthored extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param string|integer $user   the user ID.
     * @param Item           $item   the role or permission that this rule is associated with
     * @param array          $params parameters passed to ManagerInterface::checkAccess().
     *
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        if (\Yii::$app->user->identity->role_name == 'admin') {
            return true;
        }
        return isset($params['author_id']) ? \Yii::$app->user->id == $params['author_id'] : false;
    }
}