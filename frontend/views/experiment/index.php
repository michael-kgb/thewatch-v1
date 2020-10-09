<?php
include '../shared/head_param.php';
include '../shared/head_products.php';
include '../shared/head_global.php';

echo '<style>';
	include '../shared/shared.css'; 
echo '</style>';

$now = date("Y-m-d H:i:s");
$brand_start_date = '2019-02-07 00:00:00';
$brand_end_date = '2019-02-15 00:00:00';
?>

<section class="ptop1">
    <div class="container">
        <div class="row">

					<?php
					echo Yii::$app->view->renderFile('@app/shared/brand_detail_description.php', array(
						"image" => $data[2],
						"title"=> $data[0],
						"description" => $data[1]
					));
					?>
					
					<div class="clear"></div>
					
					<?php 
					include '../shared/breadcrumb.php'; 

					if($current_date >= $brand_start_date && $current_date <= $brand_end_date){

						if (count($products) > 0) {

							include '../shared/product_list.php';
							include '../shared/footer_pagination.php';
						
						} else { 
							
							include '../shared/product_not_found.php';
						} 
						
					} else { 

						include '../shared/product_coming_soon.php';
					} 
					?>
            	
        </div>
    </div>
</section>

