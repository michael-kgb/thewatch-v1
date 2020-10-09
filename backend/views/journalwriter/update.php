<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Update Journal Writer: <?php echo $model->journal_author_id; ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
    <li><a href="#">Journal Writer</a></li>
  </ol>
</section>

<?php echo $this->render('_form_edit', array("model" => $model)); ?>