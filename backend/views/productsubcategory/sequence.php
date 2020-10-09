<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
		Setting Product Category Sequence
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
      <li><a href="#">Images</a></li>
      <li><a href="#">Sequence</a></li>
    </ol>
</section>

<section class="content">
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php if(count($data) > 0){ ?>
            <ul id="sortable-product-category">
                <?php foreach ($data as $row){ ?>
                <li id="item-<?php echo $row->product_category_id; ?>" class="ui-state-default">
                    <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                    <img width="250" src="../../../frontend/web/img/category/<?php echo $row->product_category_images; ?>">
					<span style="margin-left: 2%;">Product Category Name : <?php echo $row->product_category_name; ?></span>
					<span style="margin-left: 2%; margin-top: 2%;">Product Category Status : <?php echo $row->product_category_status; ?></span>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div>
    </section>
</section>

<style>
#sortable-product-category { list-style-type: none; margin: 0; padding: 0; width: 60%; }
#sortable-product-category li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; }
#sortable-product-category li span { position: absolute; margin-left: -1.3em; }
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    background: none;
}
</style>