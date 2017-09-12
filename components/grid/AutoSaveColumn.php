<?php
/**
 * Created by PhpStorm.
 * User: wshaman
 * Date: 9/12/17
 * Time: 6:32 PM
 */

namespace app\components\grid;

use yii\grid\DataColumn;
use yii\helpers\Html;


class AutoSaveColumn extends DataColumn
{
    public $items = [];
    public $type;
    public $href;

    protected function renderDataCellContent($model, $key, $index)
    {
        $href = is_a($this->href, 'Closure') ?
            $this->href->call($this, $model, $key, $index) : $this->href;
        $options = ['class' => 'js__form_field_autosave', 'data-href'=>$href];
        switch ($this->type){
            case 'dropdown':
                return Html::dropDownList($this->attribute, $model->{$this->attribute}, $this->items, $options);
            default:
                return $model->{$this->attribute};
        }
    }
}