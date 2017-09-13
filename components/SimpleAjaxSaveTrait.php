<?php
/**
 * Created by PhpStorm.
 * User: wshaman
 * Date: 9/13/17
 * Time: 12:24 AM
 */

namespace app\components;

use Yii;

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

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($this->_checkSaveSimple($model, Yii::$app->request->post())){
            return json_encode(['message' => 'OK']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }
}