<?php
/**
 * Created by PhpStorm.
 * User: wshaman
 * Date: 9/11/17
 * Time: 10:25 PM
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

use app\rbac\Resolver;
use app\rbac\ManagerEditAuthored;

class RbacController extends Controller
{
    public function actionInit()
    {
        $am = Yii::$app->authManager;
        $am->removeAll();

        $guest      = $am->createRole('guest');
        $reader     = $am->createRole('reader');
        $manager    = $am->createRole('manager');
        $admin      = $am->createRole('admin');

        $am->add($guest);
        $am->add($reader);
        $am->add($manager);
        $am->add($admin);

        $index          = $am->createPermission('index');
        $news_read      = $am->createPermission('view');
        $news_update    = $am->createPermission('update');   // CUD
        $profile        = $am->createPermission('profile');

        $am->add($index);
        $am->add($news_read);
        $am->add($news_update);
        $am->add($profile);

        $r = new Resolver();

        $am->add($r);

        $am->addChild($guest, $index);


        $am->addChild($manager, $news_read);

        $am->addChild($reader, $index);
        $am->addChild($reader, $news_read);
        $am->addChild($reader, $profile);

        //Менежеры,
//        $mea = new ManagerEditAuthored();
//        $am->add($mea);
//        $edit_authored = $am->createPermission('isAuthored');
//        $edit_authored->ruleName = $mea->name;
//        $am->add($mea);
//        $am->addChild($manager, $edit_authored);
    }
}