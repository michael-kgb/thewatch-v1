<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stores-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'store_id') ?>

    <?= $form->field($model, 'store_name') ?>

    <?= $form->field($model, 'store_separator') ?>

    <?= $form->field($model, 'store_location') ?>

    <?= $form->field($model, 'store_address') ?>

    <?php // echo $form->field($model, 'store_thumbnail') ?>

    <?php // echo $form->field($model, 'store_contact_person') ?>

    <?php // echo $form->field($model, 'store_contact_number') ?>

    <?php // echo $form->field($model, 'store_sequence') ?>

    <?php // echo $form->field($model, 'store_created_date') ?>

    <?php // echo $form->field($model, 'store_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
