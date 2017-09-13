<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\components\Dict;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'name',
//            'auth_key',
//            'password_hash',
             'email:email',
            [
                'attribute' => 'status',
                'type' => 'dropdown',
                'items' => Dict::user_status(),
                'href' => function($model, $key, $index){
                    return Url::to(['admin/user/update', 'id'=> $key], true);
                },
                'class' => 'app\components\grid\AutoSaveColumn',
                'filter' => Dict::user_status(),
                'value' => function(\app\models\News $model, $key, $index){
                    return Dict::user_status($model->status);
                }
            ],
             'created_at:datetime',
            // 'updated_at',
            // 'confirmed_on',
            // 'register_ip',
             'last_login:datetime',
             'last_login_ip',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}', 'buttonOptions' => ['class' => 'run-as-ajax']],
        ],
    ]); ?>
</div>
<div id="updateFormPopup" class="modal fade" role="dialog"
     data-save_url="<?php echo \yii\helpers\Url::to('/admin/user/save')?>">
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