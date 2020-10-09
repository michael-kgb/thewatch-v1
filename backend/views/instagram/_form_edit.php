<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Homebanner */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content-header">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-info">
                <?php $form = ActiveForm::begin() ?>
                <div class="box-body">
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label">Brand</label>
                        <div class="col-sm-10">
                            <select name="instagram[brands]" class="form-control">
                                <option value="0">Please select</option>
                                <?php
                                $brands = backend\models\Brands::find()->all();
                                foreach ($brands as $row) {
                                    ?>
                                    <option value="<?php echo $row->brand_id; ?>" <?php echo $row->brand_id == $model->brand_id ? 'selected' : ''; ?>><?php echo $row->brand_name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group" style="padding: 2% 0 1% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label">Select</label>
                        <div class="col-sm-10">
                            <textarea id="productdetail-spesification" class="form-control" name="instagram[caption]" rows="10" cols="80" style="visibility: hidden; display: none;"><?php echo $model->image_caption; ?></textarea>
                            <div id="cke_productdetail-spesification" class="cke_1 cke cke_reset cke_chrome cke_editor_productdetail-spesification cke_ltr cke_browser_webkit" dir="ltr" lang="en" role="application" aria-labelledby="cke_productdetail-spesification_arialbl"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label">Product to show</label>
                        <div class="col-sm-10">
                            <select multiple="multiple" class="shipping-carrier" name="instagramproduct[]" id="112multiselect">
                                <?php
                                $instagramProducts = \backend\models\InstagramDetail::find()->where(["instagram_id" => $model->instagram_id])->all();
                                $instagramProduct = \backend\models\InstagramDetail::find()->select('product_id')->where(["instagram_id" => $model->instagram_id]);
                                $products = backend\models\Product::find()->where(["not in", "product_id", $instagramProduct])->all();
                                ?>
                                <?php if (count($instagramProducts)) { ?>
                                    <?php
                                    foreach ($instagramProducts as $row) {
                                        $product = backend\models\Product::findOne($row->product_id);
                                        ?>
                                        <option value="<?php echo $row->product_id; ?>" selected><?php echo $product->productDetail->name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (count($products) > 0) { ?>
                                    <?php foreach ($products as $row) { ?>
                                        <option value="<?php echo $row->product_id; ?>"><?php echo $row->productDetail->name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-default pull-right"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div><!-- /tab-content -->
</section>