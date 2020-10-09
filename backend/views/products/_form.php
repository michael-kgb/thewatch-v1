<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;



/* @var $this yii\web\View */
/* @var $model backend\models\Homebanner */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content-header">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-left">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#information" data-toggle="tab">Information</a></li>
                    <li><a href="#prices" data-toggle="tab">Prices</a></li>
                    <li><a href="#seo" data-toggle="tab">SEO</a></li>
                    <li><a href="#associations" data-toggle="tab">Associations</a></li>
                    <li><a href="#shipping" data-toggle="tab">Shipping</a></li>
                    <li><a href="#quantities" data-toggle="tab">Quantities</a></li>
                    <li><a href="#images" data-toggle="tab">Images</a></li>
                    <li><a href="#related" data-toggle="tab">Related Items</a></li>
                    <li><a href="#features" data-toggle="tab">Features</a></li>
                    <li><a href="#suppliers" data-toggle="tab">Suppliers</a></li>
                </ul>
                <div class="tab-content">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                    <div class="tab-pane active" id="information">
                        <div class="box-body">
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ProductDetail[name]" id="inputEmail3" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">SKU Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ProductDetail[sku_number]" id="inputEmail3" placeholder="SKU Number">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 2% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Enabled</label>
                                <div class="col-sm-10">
                                    <input id="switch-enabled" name="Product[active]" type="checkbox" value="1" data-size="mini">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 2% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Disable Click</label>
                                <div class="col-sm-10">
                                    <input id="switch-enabled" name="Product[disable_click]" type="checkbox" value="0" data-size="mini">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Visibility</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Product[visibility]" id="visibility">
                                        <option value="both" selected="selected">Everywhere</option>
                                        <option value="catalog">Catalog only</option>
                                        <option value="search">Search only</option>
                                        <option value="none">Nowhere</option>
                                    </select>
                                </div>
                            </div>
                            
                           <!-- <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">New Arrival<br/><i>empty if not set</i></label>
                                <div class="col-sm-5">
                                    <div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
                                        <input  type="text" class="form-control" placeholder="click to set date"  id="example1" name="ProductNewArrival[new_arrival_from]">
                                        <!--<input type="text" class="form-control" name="cartrule[date_to]" required>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span> From
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="input-group margin" id="datetimepicker2" style="margin: 0px;">
                                        <input  type="text" class="form-control" placeholder="click to set date"  id="example2" name="ProductNewArrival[new_arrival_to]">
                                        <!--<input type="text" class="form-control" name="cartrule[date_to]" required>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span> To
                                        </span>
                                    </div>
                                </div>
                            </div> -->
                            <hr>
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label" style="margin-top: 5%;">Description</label>
                                <div class="col-sm-10" style="margin-top: 5%;">
                                    <textarea id="productdetail-description" name="ProductDetail[description]" rows="10" cols="80">
                                    </textarea>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 control-label">Spesification</label>
                                <div class="col-sm-10">
                                    <textarea id="productdetail-spesification" name="ProductDetail[spesification]" rows="10" cols="80">
                                    </textarea>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 control-label" style="margin-top: 5%;">Product Size & Info</label>
                                <div class="col-sm-10" style="margin-top: 5%;">
                                    <textarea id="journaldetail-description" name="ProductDetail[product_size_info]" rows="10" cols="80">
                                    </textarea>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 control-label">Product Care</label>
                                <div class="col-sm-10">
                                    <textarea id="journaldetail-content" name="ProductDetail[product_care]" rows="10" cols="80">
                                    </textarea>
                                </div>
                            </div>
                            <!--<div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label" style="margin-top: 5%;">Tags</label>
                                <div class="col-sm-10" style="margin-top: 5%;">
                                    <input type="text" name="ProductTags[tags]" class="form-control" id="tagsfield" />
                                </div>
                            </div>-->
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="prices">
                        <div class="box-body">
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Price IDR</label>
                                <div class="col-sm-10">
                                    <input value="0" type="text" class="form-control" name="Product[price]" id="inputEmail3" placeholder="Price">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Price USD</label>
                                <div class="col-sm-10">
                                    <input value="0" type="text" class="form-control" name="Product[price_usd]" id="inputEmail3" placeholder="Price">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                    <i class="fa fa-close"></i> Cancel
                                </button>
                            </div>
                            <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                <button type="submit" name="submitAddproduct" class="btn btn-default pull-right" onclick="return validation()">
                                    <i class="fa fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="seo">
                        <div class="box-body">
                            <div class="col-sm-12">
                                <?php
                                $brands = "brand name";
                                ?>
                                <h3>Search engine listing preview <a onclick="updatePreviewMeta('<?php echo $brands; ?>')" class="btn btn-default"><i class="fa fa-refresh"></i></a></h3>
                                <div style="border: 1px solid #f0f0f0; width: 530px">
                                    <h4 id="preview-page-title" style="color: #1a0dab;">The Watch Co. - -</h4>
                                    <h6 id="preview-page-url" style="color: #006621;">http://thewatch.co/product/</h6>
                                    <h5 id="preview-page-description"></h5>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr/>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Meta Title</label>
                                <div class="col-sm-10">
                                    <input id="productdetail-meta_title" name="ProductDetail[meta_title]" type="text" class="form-control" id="inputEmail3">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Meta Keywords</label>
                                <div class="col-sm-10">
                                    <input id="productdetail-meta_keywords" name="ProductDetail[meta_keywords]" type="text" class="form-control" id="inputEmail3">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Meta Description</label>
                                <div class="col-sm-10">
                                    <input id="productdetail-meta_description" name="ProductDetail[meta_description]" type="text" class="form-control" id="inputEmail3">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Friendly Url</label>
                                <div class="col-sm-4">
                                    <input id="productdetail-link_rewrite" name="ProductDetail[link_rewrite]" type="text" class="form-control" id="inputEmail3">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right" onclick="return validation()">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="associations">
                        <div class="box-body">
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'product_category_id')->dropDownList(ArrayHelper::map(\backend\models\ProductCategory::find()->all(), 'product_category_id', 'product_category_name'), ['prompt' => ''])->label(false) ?>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Product Sub Category</label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'product_sub_category_id')->dropDownList(ArrayHelper::map(\backend\models\ProductSubCategory::find()->all(), 'product_sub_category_id', 'product_sub_category_name'), ['prompt' => ''])->label(false) ?>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Brand</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="product-brands_brand_id" name="Product[brands_brand_id]" onchange="checkcollection()" required>
                                        <option value="0">Please select</option>
                                        <?php
                                        $brands = backend\models\Brands::find()->orderBy('brand_name')->all();
                                        foreach ($brands as $row) {
                                            ?>
                                            <option value="<?php echo $row->brand_id; ?>"><?php echo $row->brand_name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Brand Collection</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="product-brands_collection_id" name="Product[brands_collection_id]" required>
                                        <option value="">Please select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right" onclick="return validation()">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="shipping">
                        <div class="box-body">
                            <div class="alert alert-warning">
                                <i class="icon fa fa-warning"></i>
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                There is 1 warning.
                                <ul style="display:block;" id="seeMore">
                                    <li>You must save this product before managing shipping.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="quantities">
                        <div class="box-body">
                            <div class="alert alert-warning">
                                <i class="icon fa fa-warning"></i>
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                There is 1 warning.
                                <ul style="display:block;" id="seeMore">
                                    <li>You must save this product before managing quantities.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="images">
                        <div class="box-body">
                            <div class="alert alert-warning">
                                <i class="icon fa fa-warning"></i>
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                There is 1 warning.
                                <ul style="display:block;" id="seeMore">
                                    <li>You must save this product before managing images.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="related">
                        <div class="box-body">
                            <div class="alert alert-warning">
                                <i class="icon fa fa-warning"></i>
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                There is 1 warning.
                                <ul style="display:block;" id="seeMore">
                                    <li>You must save this product before managing related items.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="features">
                        <div class="box-body">
                            <div class="alert alert-warning">
                                <i class="icon fa fa-warning"></i>
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                There is 1 warning.
                                <ul style="display:block;" id="seeMore">
                                    <li>You must save this product before managing features.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="suppliers">
                        <div class="box-body">
                            <div class="alert alert-warning">
                                <i class="icon fa fa-warning"></i>
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                There is 1 warning.
                                <ul style="display:block;" id="seeMore">
                                    <li>You must save this product before managing suppliers.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div><!-- /tab-content -->
            </div><!-- /tabbable -->
        </div><!-- /col -->
    </div><!-- /row -->
</section><!-- /container -->


<script>
    function validation(){
        if(document.getElementById('example2').value != "" && document.getElementById('example1').value == "" || document.getElementById('example1').value != "" && document.getElementById('example2').value == ""){
            alert('New arrival date not valid!');
            return false;
        }
    }
</script>