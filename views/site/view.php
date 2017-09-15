<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p style="text-align: right"><i>by <?php echo $model->author ? $model->author->name() : '??';?> on <?php echo $model->created;?></i></p>
    <p style="text-align: justify"><?php echo $model->content;?></p>
</div>
