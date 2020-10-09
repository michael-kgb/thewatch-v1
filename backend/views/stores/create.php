<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Store
  </h1>
  <ol class="breadcrumb">
      <li><a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/stores/index"><i class="glyphicon glyphicon-shopping-cart"></i>Stores</a></li>
    <li><a href="#">Create</a></li>
  </ol>
</section>

<?php echo $this->render('_form', array("model" => $model)); ?>