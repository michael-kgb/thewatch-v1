<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View Brands Collection 
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
                            <?php
                            $brand = backend\models\Brands::findOne($model->brands_brand_id);
                            $product = \backend\models\Product::find()->where(['brands_collection_id' => $model->brands_collection_id])->all();
                            ?>
                            <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $brand->getAttributeLabel('brand_name'); ?> : </label>
                            <div class="col-lg-10">
                                <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $brand->brand_name; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('brands_collection_name'); ?> : </label>
                            <div class="col-lg-10">
                                <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->brands_collection_name; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-2 control-label">Product : </label>
                            <div class="col-lg-10">
                                <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left">
                                        <?php
                                        foreach ($product as $row) {
                                            $product_detail = backend\models\ProductDetail::find()->where(['product_id' => $row->product_id])->one();
                                            ?>
                                            <?php echo '- <a href="../../products/update/'.$row->product_id .'" target="_blank">'. $product_detail->name . '</a><br/>'; ?>
                                            <?php
                                        }
                                        ?>

                                </label>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button onclick="location.href = '<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/brandscollection/index'" type="button" class="btn btn-info pull-right">View All</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>