<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Update Journal Category: <?php echo $model->journal_category_id; ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cog"></i>Blog</a></li>
    <li><a href="#">Journal Category</a></li>
  </ol>
</section>

<?php echo $this->render('_form', array("model" => $model)); ?>