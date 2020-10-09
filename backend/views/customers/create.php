<?php

use yii\helpers\Html;

?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Customer
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cog"></i>Customers</a></li>
    <li><a href="#">Customers</a></li>
  </ol>
</section>

<?= $this->render('_form', [
    'model' => $model, 'error' => $error
]) ?>

