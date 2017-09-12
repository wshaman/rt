<?php
/**
 * Created by PhpStorm.
 * User: wshaman
 * Date: 9/11/17
 * Time: 1:57 PM
 */

namespace app\commands;

use app\models\News;
use app\models\User;
use Faker\Factory;
use yii\console\Controller;

class SeedController extends Controller
{
    private $faker;

    public function init()
    {
        $this->faker = Factory::create();
    }

    private function _row()
    {
        return [
            'title' => $this->faker->text(60),
            'content' => $this->faker->sentence(400, true),
            'status' => \app\components\Consts::STATUS_NEWS_PUBLISHED,
        ];
    }

    public function actionIndex($count=200)
    {
        for($i=0; $i<$count; $i++){
           $n = new News();
           $n->setAttributes($this->_row());
           if(!$n->validate()){
               var_dump($n->errors);
           }
           var_dump($n->save());
        }
    }

    public function actionUsers()
    {
        $user = new User();
        $user->skip_before_save = true;
        $user->email = 'admin@admin.com';
        $user->setPassword('admin');
        $user->username = 'admin';
        $user->status = $user::STATUS_ACTIVE;
        $user->save(false);
    }
}