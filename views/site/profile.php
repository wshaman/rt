<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Profile */


$this->params['breadcrumbs'][] = Yii::t('app', 'Profile');
?>
<div class="profile-update">

    <h1><?= Yii::$app->user->name() ?>'s settings</h1>

    <div class="profile-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'notify_email')->checkbox() ?>

        <?= $form->field($model, 'notify_browser')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>