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
                            <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('brand_logo'); ?> : </label>
                            <div class="col-lg-2">
                                <img height="100px" src="/twcnew/frontend/web/img/brands/black/<?php echo $model->brand_logo; ?>">
                            </div>
                            <label for="inputEmail3" class="col-lg-2 control-label">Brand Banner : </label>
                            <div class="col-lg-4">
                                <?php
                                $brandbanner = \backend\models\BrandsBanner::find()->where(['brands_brand_id' => $model->brand_id])->one();
                                if (!empty($brandbanner)) {
                                    ?>
                                    <img height="100px" src="/twcnew/frontend/web/img/brand_identity/<?php echo $brandbanner->brand_banner_small_banner; ?>">
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
                                        <img height="150px" src="/twcnew/img/brand_banner/<?php echo $model->brand_id . '/' . $row->brands_banner_detail_slide_image; ?>">
                                    </div>
                                    <?php
                                }
                                ?>
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