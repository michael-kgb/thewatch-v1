<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View Instagram Post
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Blog</a></li>
        <li><a href="#">Instagram</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-8">
            <div class="box box-info">
                <div class="box-header">
                    <b>Information</b>
                </div>
                <div class="box-body">
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Brand :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php if($model->brand_id != 0) echo $model->brand->brand_name; else echo 'Not Set' ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Caption :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->image_caption; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Like :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->image_like_count; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Comment :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->image_comment_count; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Status :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->active == 1 ? 'Active' : 'Inactive'; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="box box-info">
                <div class="box-header">
                    <b>Product to show</b>
                </div>
                <div class="box-body">
                    <?php
                    $instagramProduct = \backend\models\InstagramDetail::find()->where(['instagram_id' => $model->instagram_id])->all();
                    foreach ($instagramProduct as $row) {
                        $productImage = \backend\models\ProductImage::find()->where(['product_id' => $row->product_id, 'cover' => 1])->one();
                        ?>
                        <div class="col-sm-3" style="margin-bottom: 20px;">
                            <img src="<?php echo Yii::$app->urlManagerFrontEnd->baseUrl . '/img/product/' . $productImage['product_image_id'] . '/' . $productImage['product_image_id'] . '.jpg'; ?>" class="img-responsive">
                            <br/>
                            <div class="text-center"><b><?php echo $productImage->product->productDetail->name; ?></b></div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="box box-info">
                <div class="box-header">
                    <b>Image</b>
                </div>
                <div class="box-body">
                    <img src="<?php echo $model->image_file; ?>" class="img-responsive">
                </div>
            </div>
        </div>
    </div>
</section>