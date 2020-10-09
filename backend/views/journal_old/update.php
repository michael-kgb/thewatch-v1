<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Update Journal: <?php echo $model->journalDetail->journal_detail_title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
    <li><a href="#">Journal</a></li>
  </ol>
</section>

<?php echo $this->render('_form_edit', array("model" => $model)); ?>