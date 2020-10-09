<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KontesSeoContent */

$this->title = 'Create Kontes Seo Content';
$this->params['breadcrumbs'][] = ['label' => 'Kontes Seo Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kontes-seo-content-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
