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
            <div class="tabs-left">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#information" data-toggle="tab">Information</a></li>
                    <li><a href="#prices" data-toggle="tab">Conditions</a></li>
                    <li><a href="#seo" data-toggle="tab">Actions</a></li>
                </ul>
                <div class="tab-content">
                    <?php $form = ActiveForm::begin() ?>
                    <div class="tab-pane active" id="information">
                        <div class="box-body">
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="cartrule[name]" id="inputEmail3" placeholder="Name" required="true">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="5" name="cartrule[description]"></textarea>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Code</label>
                                <div class="col-sm-4">
                                    <div class="input-group margin" style="margin: 0px;">
                                        <input type="text" class="form-control" id="voucher-code" name="cartrule[vouchercode]" required="true">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default btn-flat" type="button" onclick="generateVouchercode()"><i class="fa fa-random"></i> Generate</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Highlight</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="cartrule[highlight]">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Partial use</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="cartrule[partialuse]">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Priority</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="cartrule[priority]" id="inputEmail3" value="1">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="cartrule[active]">
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
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
                                <label for="inputEmail3" class="col-sm-2 control-label">Limit to a single customer</label>
                                <div class="col-sm-10">
                                    <div class="input-group margin" style="margin: 0px;">
                                        <input type="text" class="form-control searchbox" id="customer" placeholder="find by firstname or email..." name="cartrule[customer]">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default btn-flat" type="button"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Valid</label>
                                <div class="col-sm-5">
                                    <div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
                                        <input  type="text" class="form-control" placeholder="click to set date"  id="example1" name="cartrule[date_from]">
                                        <!--<input type="text" class="form-control" name="cartrule[date_to]" required>-->
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span> From
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="input-group margin" id="datetimepicker2" style="margin: 0px;">
                                        <input  type="text" class="form-control" placeholder="click to set date"  id="example2" name="cartrule[date_to]">
                                        <!--<input type="text" class="form-control" name="cartrule[date_to]" required>-->
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span> To
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Minimum amount</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="cartrule[minimum_amount]" value="0">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Total available</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="cartrule[quantity]" value="0">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Total available for each user</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="cartrule[quantity_customer]" value="0">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Restrictions</label>
                                <div class="col-sm-10">
                                    <input type="checkbox"> Carrier selection <br/>
                                    <input type="checkbox"> Customer group selection <br/>
                                    <input type="checkbox"> Compatibility with other cart rules <br/>
                                    <input type="checkbox" name="cartrule[product_restriction]" value="1" id="product-selection" onchange="checkproductselection()"> Product selection<br/><br/><br/>
                                    <table id="table-product-selection" style='display: none; width: 100%;'>
                                        <tbody>
                                            <tr>
                                                <td width="20%">
                                                    <div class="pull-right">
                                                        The cart must contain at least
                                                    </div>
                                                </td>
                                                <td width="40%">
                                                    <div style="padding-left: 20px; padding-right: 20px;">
                                                        <input type="text" class="form-control" name="cartrule[product_restriction_contain]" value="0">
                                                    </div>
                                                </td>
                                                <td colspan="2">product(s) matching the following rules</td>
                                            </tr>
                                            <tr>
                                                <td width="20%">
                                                    <div class="pull-right" style="padding-top: 10px">
                                                        Add a rule concerning
                                                    </div>
                                                </td>
                                                <td width="40%">
                                                    <div style="padding-left: 20px; padding-right: 20px; padding-top: 10px">
                                                        <select id="rule-selected" class="form-control">
                                                            <option value="products">Product</option>
                                                            <option value="attributes">Atrribute</option>
                                                            <option value="categories">Category</option>
                                                            <option value="brands">Brands</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="padding-top: 10px;">
                                                        <a class="btn btn-default" onclick="addproductmatch()"><i class="fa fa-plus"></i> add</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <div style="padding-top: 40px; border-bottom: 1px solid #eaeaea">
                                                        The product(s) are matching one of theses
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <table width="100%" id="table-product-rule-selection">
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="clearfix"></div>
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
                    <div class="tab-pane" id="seo">
                        <div class="box-body">
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Free shipping</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="cartrule[free_shipping]">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Apply a discount</label>
                                <div class="col-sm-5">
                                    <input type="radio" name="cartrule[value]" onclick="openvalue('percent')" value='percent'> Percent(%)<br/>
                                    <input type="radio" name="cartrule[value]" onclick="openvalue('amount')" value='amount'> Amount<br/>
                                    <input type="radio" name="cartrule[value]" onclick="openvalue('none')" value='none' checked> None<br/>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0; display: none;" id="disc-input">
                                <label for="inputEmail3" class="col-sm-2 control-label">Value</label>
                                <div class="col-sm-5">
                                    <div class="input-group margin" style="margin: 0px;">
                                        <span class="input-group-addon" id="disc-type">

                                        </span>
                                        <input type="text" class="form-control" name="cartrule[amount]" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Apply a discount to</label>
                                <div class="col-sm-5">
                                    <input type="radio"> Order (without shipping)<br/>
                                    <input type="radio"> Specific product<br/>
                                    <input type="radio"> Cheapest product<br/>
                                    <input type="radio"> Selected product(s)<br/>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Send a free gift</label>
                                <div class="col-sm-4">
                                    <select class="form-control">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
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

                    <div class="modal fade" id="modal-products" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Products</h4>
                                </div>
                                <div class="modal-body">
                                    <select multiple="multiple" class="product-tag" name="products[]" id="113multiselect">
                                        <?php
                                        $products = \backend\models\Product::find()->all();

                                        foreach ($products as $product) {
                                            ?>
                                            <option value="<?php echo $product->product_id; ?>"><?php echo $product->productDetail->name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="countproductselected('products')">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="modal-attributes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Attributes</h4>
                                </div>
                                <div class="modal-body">
                                    <select multiple="multiple" class="product-tag" name="attributes[]" id="113multiselect">
                                        <?php
                                        $attributes = \backend\models\AttributeValueCombination::find()->all();

                                        foreach ($attributes as $attribute) {
                                            ?>
                                            <option value="<?php echo $attribute->attribute_value_combination_id; ?>"><?php echo $attribute->attributes->name . ' - ' . $attribute->attributeValue->value; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="countproductselected('attributes')">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="modal-categories" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Category</h4>
                                </div>
                                <div class="modal-body">
                                    <select multiple="multiple" class="product-tag" name="category[]" id="113multiselect">
                                        <?php
                                        $category = \backend\models\ProductFeatureValue::find()->orderBy('feature_id ASC')->all();

                                        foreach ($category as $row) {
                                            ?>
                                            <option value="<?php echo $row->feature_value_id; ?>"><?php echo $row->feature->feature_name . ' - '. $row->feature_value_name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="countproductselected('categories')">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="modal-brands" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Brands</h4>
                                </div>
                                <div class="modal-body">
                                    <select multiple="multiple" class="product-tag" name="brands[]" id="113multiselect">
                                        <?php
                                        $brands = \backend\models\Brands::find()->all();

                                        foreach ($brands as $row) {
                                            ?>
                                            <option value="<?php echo $row->brand_id; ?>"><?php echo $row->brand_name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="countproductselected('categories')">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div><!-- /tab-content -->
            </div><!-- /tabbable -->
        </div><!-- /col -->
    </div><!-- /row -->
</section>