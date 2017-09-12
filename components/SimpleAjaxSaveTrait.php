<?php
/**
 * Created by PhpStorm.
 * User: wshaman
 * Date: 9/13/17
 * Time: 12:24 AM
 */

namespace app\components;


trait SimpleAjaxSaveTrait
{
    protected function _checkSaveSimple(\yii\db\ActiveRecord &$model, $post)
    {
        if(F::array_get($post, '__type') == 'simple'){
            foreach ($post as $item => $value){
                if($item == '__type') continue;
                $model->setAttribute($item, $value);
            }
            //@todo: Add validation here
            $model->save();
            return true;
        }
        return false;
    }
}