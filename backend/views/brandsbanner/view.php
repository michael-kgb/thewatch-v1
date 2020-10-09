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
            <div class="box box-info" id="box-banner">
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('brand_name'); ?> : </label>
                            <div class="col-lg-10">
                                <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->brand_name; ?></label>
                            </div>
                        </div>
                        <div class="form-group" style="padding-top: 50px;">
                            <label for="inputEmail3" class="col-lg-2 control-label">Brand Banner Detail : </label>
                            <div class="col-lg-10" id="brand-banner-detail">
                                <?php
                                $brandbannerdetail = \backend\models\BrandsBannerDetail::find()->where(['brands_brand_id' => $model->brand_id,'brands_banner_featured_brand'=> 0,'brands_banner_featured_mobile'=> 0])->all();
                                
								foreach ($brandbannerdetail as $row) {
									$jewelry = "";
									$watches = "";
                                    if($row->brands_banner_featured_jewelry==1)
                                    {
                                        $jewelry="selected";
                                    }else{
                                        $watches="selected";
                                    }
                                    ?>
                                    <div class="col-sm-4" style="padding-bottom: 30px;">
                                        <img class="img-responsive" height="150px" src="/frontend/web/img/brand_banner/<?php echo $model->brand_id . '/' . $row->brands_banner_detail_slide_image; ?>">
                                        <br/>
                                        <div class="text-center">
                                            <select class="form-control" onchange="updatekategoriBrandbannerdetail(<?php echo $row->brands_banner_detail_id . ',' . $row->brands_brand_id ?>)">
                                                <option value="wacthes" <?=$watches?>>Wacthes</option>
                                                <option value="jewelry" <?=$jewelry?>>Jewelry</option>
                                            </select>
                                        </div>
                                        <div class="text-center">
                                            <a class="btn btn-default" onclick="deleteBrandbannerdetail(<?php echo $row->brands_banner_detail_id . ',' . $row->brands_brand_id ?>)"><i class="fa fa-trash"></i> Delete</a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="form-group" style="padding: 2% 0 3% 0;">
                            <label for="inputEmail3" class="col-sm-2 control-label">Add Brand Banner : </label>
                            <div class="col-sm-3">
                                <input type="file" name="userImage" id="userImage" class="user-image" multiple />
                            </div>
                            <div class="col-sm-2">
                                <a onclick="uploadimagebanner(<?php echo $model->brand_id; ?>)" class="btn btn-default pull-right"><i class="fa fa-upload"></i> Upload</a>
                            </div>
                        </div>

                        <div class="form-group" style="padding-top: 50px;">
                            <label for="inputEmail3" class="col-lg-2 control-label">Featured Banner Detail : </label>
                            <div class="col-lg-10" id="brand-banner-detail-featured">
                                <?php
                                $brandbannerdetail = \backend\models\BrandsBannerDetail::find()->where(['brands_brand_id' => $model->brand_id,'brands_banner_featured_brand'=> 1])->all();
                                foreach ($brandbannerdetail as $row) {
                                    ?>
                                    <div class="col-sm-4" style="padding-bottom: 30px;">
                                        <img class="img-responsive" height="150px" src="/frontend/web/img/brand_banner/<?php echo $model->brand_id . '/' . $row->brands_banner_detail_slide_image; ?>">
                                        <br/>
                                        <div class="text-center">
                                            <a class="btn btn-default" onclick="deleteBrandbannerdetail(<?php echo $row->brands_banner_detail_id . ',' . $row->brands_brand_id ?>)"><i class="fa fa-trash"></i> Delete</a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="form-group" style="padding: 2% 0 3% 0;">
                            <label for="inputEmail3" class="col-sm-2 control-label">Add Brand Banner Featured : </label>
                            <div class="col-sm-3">
                                <input type="file" name="userImage2" id="userImage2" class="user-image" multiple />
                            </div>
                            <div class="col-sm-2">
                                <a onclick="uploadimagebannerfeatured(<?php echo $model->brand_id; ?>)" class="btn btn-default pull-right"><i class="fa fa-upload"></i> Upload</a>
                            </div>
                        </div>
                        
                        <div class="form-group" style="padding-top: 50px;">
                            <label for="inputEmail3" class="col-lg-2 control-label">Featured Banner Mobile Detail : </label>
                            <div class="col-lg-10" id="brand-banner-detail-featured-mobile">
                                <?php
                                $brandbannerdetail = \backend\models\BrandsBannerDetail::find()->where(['brands_brand_id' => $model->brand_id,'brands_banner_featured_mobile'=> 1])->all();
                                foreach ($brandbannerdetail as $row) {
                                    ?>
                                    <div class="col-sm-4" style="padding-bottom: 30px;">
                                        <img class="img-responsive" height="150px" src="/frontend/web/img/brand_banner/<?php echo $model->brand_id . '/' . $row->brands_banner_detail_slide_image; ?>">
                                        <br/>
                                        <div class="text-center">
                                            <a class="btn btn-default" onclick="deleteBrandbannerdetail(<?php echo $row->brands_banner_detail_id . ',' . $row->brands_brand_id ?>)"><i class="fa fa-trash"></i> Delete</a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="form-group" style="padding: 2% 0 3% 0;">
                            <label for="inputEmail3" class="col-sm-2 control-label">Add Brand Banner Featured Mobile: </label>
                            <div class="col-sm-3">
                                <input type="file" name="userImage3" id="userImage3" class="user-image" multiple />
                            </div>
                            <div class="col-sm-2">
                                <a onclick="uploadimagebannerfeaturedmobile(<?php echo $model->brand_id; ?>)" class="btn btn-default pull-right"><i class="fa fa-upload"></i> Upload</a>
                            </div>
                        </div>

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button onclick="location.href = '<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/brandsbanner/index'" type="button" class="btn btn-info pull-right">View All</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>