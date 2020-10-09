<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\KontesSeoContent */

$this->title = $model->order_event_name;
$this->params['breadcrumbs'][] = ['label' => 'Order View', 'url' => ['index']];
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
            'order_event_name:ntext',
            'order_event_gender:ntext',
            'order_event_phone:ntext',
            'order_event_birth:ntext',
            'order_event_email:ntext',
            'order_event_address:ntext',
            'order_event_product_name:ntext',
            'order_event_product_attribute:ntext',
            'order_event_quantity:ntext',
            'order_event_product_attribute:ntext',
            'order_event_price:ntext',
            'order_event_original_price:ntext',
            'order_event_create_date:ntext',
            
        ],
    ]) ?>

            </div>
        </div>
    </section>

