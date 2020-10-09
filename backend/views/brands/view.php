<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View Brand 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Brands</a></li>
        <li><a href="#">view</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('brand_name'); ?> : </label>
                            <div class="col-lg-10">
                                <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->brand_name; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('brand_created_date'); ?> : </label>
                            <div class="col-lg-10">
                                <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->brand_created_date; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('brand_status'); ?> : </label>
                            <div class="col-lg-10">
                                <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->brand_status; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('brands_menu_type'); ?> : </label>
                            <div class="col-lg-10">
                                <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->brands_menu_type; ?></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('brand_logo'); ?> : </label>
                            <div class="col-lg-2">
                                <img height="100px" src="/frontend/web/img/brands/black/<?php echo $model->brand_logo; ?>">
                            </div>
                            <label for="inputEmail3" class="col-lg-2 control-label">Brand Banner : </label>
                            <div class="col-lg-4">
                                <?php
                                $brandbanner = \backend\models\BrandsBanner::find()->where(['brands_brand_id' => $model->brand_id])->one();
                                if (!empty($brandbanner)) {
                                    ?>
                                    <img height="100px" src="/frontend/web/img/brand_identity/<?php echo $brandbanner->brand_banner_small_banner; ?>">
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group" style="padding-top: 50px;">
                            <label for="inputEmail3" class="col-lg-2 control-label">Brand Banner Detail : </label>
                            <div class="col-lg-10">
                                <?php
                                $brandbannerdetail = \backend\models\BrandsBannerDetail::find()->where(['brands_brand_id' => $model->brand_id])->all();
                                foreach ($brandbannerdetail as $row) {
                                    ?>
                                    <div class="col-sm-4" style="padding-bottom: 30px;">
                                        <img height="150px" src="/img/brand_banner/<?php echo $model->brand_id . '/' . $row->brands_banner_detail_slide_image; ?>">
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
						<div class="form-group" style="padding-top: 50px;">
                            <label for="inputEmail3" class="col-lg-2 control-label">Brand Collection : </label>
                            <div class="col-lg-10">
                                <?php $brandsCollection = backend\models\BrandsCollection::find()->orderBy('brands_sequence ASC')->where(['brands_brand_id' => $model->brand_id, 'brands_collection_status' => 1])->all(); ?>
                                <?php if(count($brandsCollection) > 0){ ?>
                                <ul id="sortable">
                                    <?php foreach ($brandsCollection as $collection){ ?>
                                    <li id="item-<?php echo $collection->brands_collection_id; ?>" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $collection->brands_collection_name; ?></li>
                                    <?php } ?>
                                </ul>
                                <?php } ?>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button onclick="location.href = '<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/brands/index'" type="button" class="btn btn-info pull-right">View All</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>

<style>
#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; }
#sortable li span { position: absolute; margin-left: -1.3em; }
</style>