<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $this->context->action->id; ?> <?php echo $this->context->id; ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><?php echo $this->context->id; ?></a></li>
    <li><a href="#"><?php echo $this->context->action->id; ?></a></li>
  </ol>
</section>

<?php echo $this->render('_form_edit', array("model" => $model, "productAttributeCombination" => $productAttributeCombination, "productRelated" => $productRelated, "id" => $id, "products" => $products, "productDetail" => $productDetail, "productImage" => $productImage)); ?>
