<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use app\components\F;
use app\components\Dict;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\News */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success run-as-ajax']) ?>
    </p>

    <?= GridView::widget([

        'options' => [
            'id' => 'newsTableEditor',
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterSelector' => 'select[name="per-page"]',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'pre',
//            'content:html',
//            'status',
            [
                'attribute' => 'status',
                'type' => 'dropdown',
                'items' => Dict::status(),
                'href' => function($model, $key, $index){
                    return Url::to(['admin/site/update', 'id'=> $key], true);
                },
                'class' => 'app\components\grid\AutoSaveColumn',
                'filter' => Dict::status(),
                'value' => function(\app\models\News $model, $key, $index){
                    return Dict::status($model->status);
                }
            ],
            [
                'attribute' => 'created',
                'filter' => \kartik\daterange\DateRangePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'created',
                    'convertFormat'=>true,
                    'pluginOptions'=>[
                        'yearRange' => '2010:'.strftime('%Y'),
                        'timePicker'=>false,
                        'format'=>'d-m-Y'
                    ]
                ]),
                'value' => function(\app\models\News $model, $key, $index){
                    return $model->created;
//                    return F::date_format($model->created);
                },
                'format' => 'raw'
            ],
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}',
                'buttonOptions' => ['class' => 'run-as-ajax']],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<!--<input type="hidden" id="url__news_form" value="--><?php //echo Url::to(['admin/site/update', 'id'=>'__id__']);?><!--">-->

<div id="updateFormPopup" class="modal fade" role="dialog"
     data-save_url="<?php echo \yii\helpers\Url::to('/admin/site/save')?>">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">News editor</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-modal-save" data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>