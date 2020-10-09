<?php

use yii\helpers\Html;

?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Shipping Cost
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cog"></i>Shipping</a></li>
    <li><a href="#">Shipping Cost</a></li>
  </ol>
</section>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

