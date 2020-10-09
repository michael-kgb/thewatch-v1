<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\KontesSeoContent */

$this->title = $model->kontes_seo_id;
$this->params['breadcrumbs'][] = ['label' => 'Blog Competition Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kontes_seo_name:ntext',
            'kontes_seo_hp:ntext',
            'kontes_seo_email:ntext',
            'kontes_seo_address:ntext',
            'kontes_seo_url:ntext',
            'kontes_seo_fb:ntext',
            'kontes_seo_ig:ntext',
            'kontes_seo_status:ntext',
            
        ],
    ]) ?>

            </div>
        </div>
    </section>

