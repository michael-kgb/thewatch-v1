<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\MapAsset;

MapAsset::register($this);
?>

<!--<script async="true" src="//ssp.adskom.com/tags/third-party-async/NjY2NDM4MWItMzM5ZS00MTA4LWIyNzYtNzk5NWU4YTc2OGYw"></script>-->

<section id="breadcrumb">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>
<section class="ptop1">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 gotham-medium fsize-2 pbottom3 text-center">
                STORE
            </div>
        </div>
    </div>

<!--    <div style="padding-left: 5%; padding-right: 5%; background-color: #f0f0f0; margin-bottom: 5%;">
        <div class="mapcontainer" style="background-color: #f0f0f0; padding-top: 3%; padding-bottom: 3%;">
            <div class="map" style="background-color: #f0f0f0;">
            </div>
        </div>
    </div>-->


    <div class="clearfix"></div>
    <div class="container">
        <?php
        $stores = \backend\models\Stores::find()
					->orderBy('store_location')
					->where(["store_status" => "active"])
					->andWhere(["IN", "store_type", "retail", "distribution", "monostrore"])
					->all();
        $location = "";
        $first = 0;
        $i = 1;
		$j = 1;
        foreach ($stores as $row) {
            if ($location != strtoupper($row->store_location)) {
                
                if ($first != 0) {
                    echo '</div>';
                }
                $first++;
                $location = strtoupper($row->store_location);
                ?>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 gotham-medium" style="padding-bottom: 1%;" id="city-<?php echo $i; ?>">
                        <div class="hidden-xs title-contact-us" style="border-bottom: 1px solid black; font-style: bold; margin-bottom: 2%; padding-bottom: 3%;">
                            <?php echo strtoupper($row->store_location); ?>
                        </div>

                        <table width="100%" class="hidden-lg hidden-md hidden-sm margin-bottom-10">
                            <tr>
                                <td class="collection-name">
                                    <span class="collection-name col-xs-2 clearleft clearright">
                                        <?php echo strtoupper($row->store_location); ?>
                                    </span>
                                </td>
                                <td class="border-collection" style="padding-top: 6px;">
                                    <div class="col-lg-12 col-md-10 col-sm-10 col-xs-12 product-header border-collection"></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="clearfix"></div>  
                    <?php
                    $i++;
					$j = 1;
                }
                ?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 margin-bottom-web-5 margin-bottom-10 <?php echo $j; ?>">
                    <div class="gotham-medium"><?php echo $row->store_name; ?></div><br/>
                    -<br/>
                    <div class="myprofile store-list">
                        <?php echo $row->store_address; ?><br/>
                        <?php echo $row->store_contact_number; ?>
                    </div>
                </div>
				<?php 
				if($j % 4 == 0){
					echo '<div class="clearfix"></div>';
				}
					$j++; 
				?>
                <?php
            }
            ?>
        </div>
</section>

<script>
    function submit() {
        $('#btn-submit').click();
    }
</script>