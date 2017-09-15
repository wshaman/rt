<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\Dict;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\News */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'News');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?php echo \app\components\grid\PageSize::widget();?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterSelector' => 'select[name="per-page"]',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'title',
                'value' => function(\app\models\News $model, $key, $index){
                    return Html::a($model->title, Url::to(['site/view', 'id'=>$key]));
                },
                'format' => 'raw'
            ],
            'pre',
            [
                'attribute' => 'status',
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
                },
                'format' => 'raw'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
