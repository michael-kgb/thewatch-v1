<?php

use yii\helpers\Html;

?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Store
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
    <li><a href="#">Stores</a></li>
  </ol>
</section>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

