<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\HomebannerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="homebanner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'homebanner_id') ?>

    <?= $form->field($model, 'homebanner_name') ?>

    <?= $form->field($model, 'homebanner_images') ?>

    <?= $form->field($model, 'homebanner_created_date') ?>

    <?= $form->field($model, 'homebanner_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
