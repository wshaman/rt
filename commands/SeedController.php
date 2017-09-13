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
        $now = time();
        $users = [
            ['auth_key' => '2d4-7O2iHHxAZc4kIz7AlIPNvp5bnbiY', 'password_hash'=>'$2y$13$X2yxIhAuvz54ZKwGHZw58eqI22UJAChgaE01NUNgH6.rKX1GaRR0a', 'email'=>'admin@admin.com', 'role_name'=>'admin'],
            ['auth_key' => '4aJeVTq5uWnxi3Rx5D7TdZjcXeyx5oNZ', 'password_hash'=>'$2y$13$r6v5rPYWhpbkirUJTKv7tOeEyJHAQVDvR2fXkrgDeCYX.YriYCOQO', 'email'=>'manager@manager.com', 'role_name'=>'manager'],
            ['auth_key' => 'E-yEOphMKLcilU13D38WGA8uhgwH-J-r', 'password_hash'=>'$2y$13$FftLuN8r8IMVKeaIA5JZqO95g8/cY37XxS7tOJkQKpyAFrFXpdbvq', 'email'=>'reader@reader.com', 'role_name'=>'reader']
        ];
        $data = [
            'status' => 1,
            'created_at' => $now,
            'updated_at' => $now,
            'confirmed_on' => $now,
            'last_login' => $now,
            'last_login_ip' => '127.0.0.1',
            'register_ip' => '127.0.0.1',
            ];
        foreach ($users as $user) {
            $rows = array_merge($user, $data);
            \Yii::$app->db->createCommand()->insert('{{%user}}', $rows)->execute();
        }
    }
}