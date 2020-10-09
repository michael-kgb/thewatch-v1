<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create News
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo Yii::$app->urlManager->getBaseUrl() . "/news/index"; ?>"><i class="glyphicon glyphicon-bullhorn"></i>News</a></li>
    <li><a href="#">Create</a></li>
  </ol>
</section>

<?php echo $this->render('_form', array("model" => $model)); ?>
