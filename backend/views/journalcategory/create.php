<?php

use yii\helpers\Html;

?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Journal Category
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cog"></i>Journal</a></li>
    <li><a href="#">Journal Category</a></li>
  </ol>
</section>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

