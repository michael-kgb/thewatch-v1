<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Homebanner */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content-header">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-left">
                <ul class="nav nav-tabs" id="product_left">
                    <li class="active"><a href="#information" data-toggle="tab">Information</a></li>
                    <li><a href="#prices" data-toggle="tab">Prices</a></li>
                    <li><a href="#warranty" data-toggle="tab">Warranty</a></li>
                    <li><a href="#seo" data-toggle="tab">SEO</a></li>
                    <li><a href="#associations" data-toggle="tab">Associations</a></li>
                    <li><a href="#shipping" data-toggle="tab">Shipping</a></li>
                    <li><a href="#combination" data-toggle="tab">Combination</a></li>
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
                                    <?= $form->field($productDetail, 'name')->textInput()->label(false) ?>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">SKU Number</label>
                                <div class="col-sm-10">
                                    <?= $form->field($productDetail, 'sku_number')->textInput()->label(false) ?>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 2% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Enabled</label>
                                <div class="col-sm-10">
                                    <input id="switch-enabled" name="Product[active]" type="checkbox" value="<?php echo $model->active; ?>" <?php if ($model->active == 1) echo 'checked' ?> data-size="mini">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 2% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Disable Click</label>
                                <div class="col-sm-10">
                                    <input id="switch-enabled" name="Product[disable_click]" type="checkbox" value="<?php echo $model->disable_click; ?>" <?php if ($model->disable_click == 1) echo 'checked' ?> data-size="mini">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Visibility</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Product[visibility]" id="visibility">
                                        <option value="both" <?php if ($model->visibility == 'both') echo 'selected="selected"'; ?>>Everywhere</option>
                                        <option value="catalog" <?php if ($model->visibility == 'catalog') echo 'selected="selected"'; ?>>Catalog only</option>
                                        <option value="search" <?php if ($model->visibility == 'search') echo 'selected="selected"'; ?>>Search only</option>
                                        <option value="none" <?php if ($model->visibility == 'none') echo 'selected="selected"'; ?>>Nowhere</option>
                                    </select>
                                </div>
                            </div>

                            <?php
                            $newarrival = \backend\models\ProductNewarrival::find()->where(['product_id' => $model->product_id])->one();
                            ?>
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">New Arrival<br/><i>empty if not set</i></label>
                                <div class="col-sm-5">
                                    <div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
                                        <input  type="text" class="form-control" placeholder="click to set date"  id="example1" name="ProductNewArrival[new_arrival_from]" value="<?php echo!empty($newarrival) ? $newarrival['product_newarrival_start_date'] : ""; ?>">
                                        <!--<input type="text" class="form-control" name="cartrule[date_to]" required>-->
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span> From
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="input-group margin" id="datetimepicker2" style="margin: 0px;">
                                        <input  type="text" class="form-control" placeholder="click to set date"  id="example2" name="ProductNewArrival[new_arrival_to]" value="<?php echo!empty($newarrival) ? $newarrival['product_newarrival_end_date'] : ""; ?>">
                                        <!--<input type="text" class="form-control" name="cartrule[date_to]" required>-->
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span> To
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <?php
                            $bestseller = \backend\models\ProductBestseller::find()->where(['product_id' => $model->product_id])->one();
                            ?>
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Best Sellers<br/><i>empty if not set</i></label>
                                <div class="col-sm-3">
                                    <div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
                                        <input  type="text" class="form-control" placeholder="click to set date"  id="example1" name="ProductBestseller[bestseller_from]" value="<?php echo!empty($bestseller) ? $bestseller['product_bestseller_start_date'] : ""; ?>">
                                        <!--<input type="text" class="form-control" name="cartrule[date_to]" required>-->
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span> From
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group margin" id="datetimepicker2" style="margin: 0px;">
                                        <input  type="text" class="form-control" placeholder="click to set date"  id="example2" name="ProductBestseller[bestseller_to]" value="<?php echo!empty($bestseller) ? $bestseller['product_bestseller_end_date'] : ""; ?>">
                                        <!--<input type="text" class="form-control" name="cartrule[date_to]" required>-->
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span> To
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-xs-2 selectContainer">
                                        <select class="form-control" name="ProductBestseller[bestseller_sequence]">
                                            <option value="0">Choose</option>
                                            <?php $bestseller = \backend\models\ProductBestseller::find()->where(['product_id' => $model->product_id])->all();
                                        if(count($bestseller)>0){
                                            foreach ($bestseller as $data){?>  
                                            <?php if($data->product_bestseller_sequence!=0){?>
                                                <?php for($i=1;$i<=10;$i++){?>
                                                    <option value="<?php echo $i;?>"<?php if($data->product_bestseller_sequence == $i) echo 'selected="selected"' ?>><?php echo $i;?></option>                                                
                                                <?php }?>
                                            <?php }?>
                                                    
                                                     <?php }?>
                                            <?php }else{ ?>
                                                <?php for($i=1;$i<=10;$i++){?>                                            
                                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                <?php   }?> 
                                         <?php   }?>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
							<div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Pre Order<br/><i>empty if not set</i></label>
                                <input type="checkbox" name="preorder" id="preorder">
                                <div id="preOrder" style="display: none;">
                                    <div class="col-sm-3">
                                        <div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
                                            <input  type="text" class="form-control" placeholder="click to set date"  id="example1" name="preorderFrom" value="<?php echo $_REQUEST['preorderFrom'];?>">
                                            <!--<input type="text" class="form-control" name="cartrule[date_to]" required>-->
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span> From
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group margin" id="datetimepicker2" style="margin: 0px;">
                                            <input  type="text" class="form-control" placeholder="click to set date"  id="example2" name="preorderTo" value="<?php echo $_REQUEST['preorderTo'];?>">
                                            <!--<input type="text" class="form-control" name="cartrule[date_to]" required>-->
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span> To
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label" style="margin-top: 5%;">Description</label>
                                <div class="col-sm-10" style="margin-top: 5%;">
                                    <?= $form->field($productDetail, 'description')->textarea(array("rows" => 10, "cols" => 80))->label(false) ?>
                                </div>

                                <label for="inputEmail3" class="col-sm-2 control-label">Spesification</label>
                                <div class="col-sm-10">
                                    <?= $form->field($productDetail, 'spesification')->textarea(array("rows" => 10, "cols" => 80))->label(false) ?>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label" style="margin-top: 5%;">Product Size & Info</label>
                                <div class="col-sm-10" style="margin-top: 5%;">
                                    <?= $form->field($productDetail, 'product_size_info')->textarea(array("rows" => 10, "cols" => 80))->label(false) ?>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 control-label">Product Care</label>
                                <div class="col-sm-10">
                                    <?= $form->field($productDetail, 'product_care')->textarea(array("rows" => 10, "cols" => 80))->label(false) ?>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label" style="margin-top: 5%;">Tags</label>
                                <div class="col-sm-10" style="margin-top: 5%;">
                                    <input type="text" name="ProductTags[tags]" class="form-control" id="tagsfield" value="
                                    <?php
                                    $productTag = \backend\models\ProductTag::find()->where(["product_id" => $id])->all();
                                    $count = 0;
                                    foreach ($productTag as $row) {
                                        $count++;
                                        $tag = \backend\models\Tags::findOne($row->tag_id);
                                        if (count($productTag) != $count) {
                                            echo $tag->tag_name . ', ';
                                        } else {
                                            echo $tag->tag_name;
                                        }
                                    }
                                    ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;margin-left: 1%;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right" onclick="return validation()">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-save"></i> Save &amp; Stay
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
                                    <?= $form->field($model, 'price')->textInput()->label(false) ?>
                                    <!--<input value="0" type="text" class="form-control" name="Product[price]" id="inputEmail3" placeholder="Price">-->
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Price USD</label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'price_usd')->textInput()->label(false) ?>
                                    <!--<input value="0" type="text" class="form-control" name="Product[price]" id="inputEmail3" placeholder="Price">-->
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 20px; margin-left: 20px;">
                            <div class="box-header">
                                <h3>Spesific Price</h3>
                                <hr>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group" style="padding: 2% 0 3% 0;">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Apply a discount</label>
                                    <div class="col-sm-5">

                                        <?php
                                        $type = "";
										$labelType = "";
                                        $checkSpecificPrice = backend\models\SpecificPrice::find()->where(['product_id' => $model->product_id])->one();
                                        if (!empty($checkSpecificPrice)) {
                                            $type = $checkSpecificPrice['reduction_type'];
											$labelType = $checkSpecificPrice['label_type'];
                                        }
                                        ?>

                                        <input type="radio" name="SpesificPrice[value]" onclick="openvalue('percent')" value='percent' <?php echo $type == 'percent' ? "checked" : ""; ?>> Percent(%)<br/>
                                        <input type="radio" name="SpesificPrice[value]" onclick="openvalue('amount')" value='amount' <?php echo $type == 'amount' ? "checked" : ""; ?> > Amount<br/>
										<input type="radio" name="SpesificPrice[value]" onclick="openvalue('flat')" value='flat' <?php echo $type == 'flat' ? "checked" : ""; ?> > Flat<br/>
                                        <input type="radio" name="SpesificPrice[value]" onclick="openvalue('none')" value='none' <?php echo $type == '' ? "checked" : ""; ?> > None<br/>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group" style="padding: 2% 0 3% 0; <?php echo empty($checkSpecificPrice) ? 'display: none;' : ""?>" id="disc-input">
                                    <div class="col-sm-12" style="margin-top: 2%; margin-bottom: 1%;">
                                        <label for="inputEmail3" class="col-sm-2 control-label" style="padding-left: 0">Value</label>
                                        <div class="col-sm-5" style="padding-left: 0;">
                                            <div class="input-group margin" style="margin: 0px;">
                                                <span class="input-group-addon" id="disc-type">
                                                    <?php echo $type == "percent" ? '%' : 'Rp.' ?>
                                                </span>
                                                <input type="text" class="form-control" name="SpesificPrice[amount]" <?php echo !empty($checkSpecificPrice) ? 'value="' . $checkSpecificPrice['reduction'] . '"' : 'value="0"' ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 1%; margin-bottom: 2%;">
                                        <label for="inputEmail3" class="col-sm-2 control-label" style="padding-left: 0;">Label Type</label>
                                        <div class="col-sm-5" style="padding-left: 0;">
                                            <div class="input-group margin" style="margin: 0px;">
                                                <input type="radio" <?php echo $labelType == 'same_as_reduction' ? "checked" : ""; ?> name="SpesificPrice[label_type]" onclick="openvalue('sameasreduction')" value="same_as_reduction">
                                                Same As Reduction Value
                                                <br>
                                                <input type="radio" <?php echo $labelType == 'custom_value' ? "checked" : ""; ?> name="SpesificPrice[label_type]" onclick="openvalue('customvalue')" value="custom_value">
                                                Custom Value
                                                <br>
                                                <input type="radio" <?php echo $labelType == 'flash_icon' ? "checked" : ""; ?> name="SpesificPrice[label_type]" onclick="openvalue('flashicon')" value="flash_icon">
                                                Flash Icon (Flat Price)
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 1%; margin-bottom: 2%; <?php echo $labelType === 'custom_value' ? '' : 'display: none;'?>" id="customlabel-disc">
                                        <label for="inputEmail3" class="col-sm-2 control-label" style="padding-left: 0">Custom Label</label>
                                        <div class="col-sm-5" style="padding-left: 0;">
                                            <div class="input-group margin" style="margin: 0px;">
                                                <input type="text" class="form-control" name="SpesificPrice[label]" value="<?php echo $checkSpecificPrice['label']; ?>">
                                            </div>
                                        </div>
                                    </div>
									<div class="col-sm-12" style="margin-top: 1%; margin-bottom: 2%;">
                                        <label for="inputEmail3" class="col-sm-2 control-label" style="padding-left: 0;">Flash Sale</label>
                                        <div class="col-sm-2" style="padding-left: 0;">
                                            <div class="input-group margin" style="margin: 0px;">
                                                <input type="checkbox" name="SpesificPrice[is_flash_sale]" id="is_flash_sale" <?php echo $checkSpecificPrice['is_flash_sale'] == 1 ? "checked" : ""; ?>>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-2 control-label">
                                            <a href="#" class="btn btn-default pull-left <?php echo $checkSpecificPrice['is_flash_sale'] == 1 ? "" : "hidden"; ?>" id="addmore-flashsale-periode">
                                                <i class="fa fa-plus"></i> Add More Periode
                                            </a>
                                        </div>
                                        <?php
                                            $productStock = backend\models\ProductStock::find()->where(["product_id" => $id , "product_attribute_id"=> 0])->one();
                                        ?>
                                        <div class="col-sm-12" style="margin-top: 1%; margin-bottom: 2%;" id="qty-flash-sale">
                                            <label for="inputEmail3" class="col-sm-2 control-label" style="padding-left: 0;">Flash Sale Quantity</label>
                                            <div class="col-sm-2" style="padding-left: 0;">
                                                <div class="input-group margin" style="margin: 0px;">
                                                    <input type="number" name="SpesificPrice[flash_sale_qty]" id="flash_sale_qty" value="<?php echo $productStock->quantity; ?>" min="0">
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
								
                                <?php 
                                // if product has flash sale promo periode
                                if($checkSpecificPrice['is_flash_sale'] == 1){ 
                                    
                                    ?>
                                    
                                    <?php
                                    $checkSpecificPrices = backend\models\SpecificPrice::find()->where(['product_id' => $model->product_id])->all();
                                    if(count($checkSpecificPrices) > 0){
                                        foreach($checkSpecificPrices as $flashsale){
                                ?>
                                <div class="form-group <?php echo $checkSpecificPrice['is_flash_sale'] == 1 ? "" : "hidden"; ?>" style="padding: 2% 0 3% 0;" id="box-available-flashsale">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Available</label>
                                    <div class="col-sm-5">
                                        <?php  
                                        echo '<label class="control-label">From</label>';
                                        echo DateTimePicker::widget([
                                            'id' => 'datetimepickerflash1',
                                            'name' => 'SpesificPrice[fromflash][]',
                                            'options' => ['placeholder' => 'click to set date'],
                                            'value' => $flashsale->from,
                                            'pluginOptions' => [
                                                'format' => 'yyyy-mm-dd hh:ii:ss',
                                                'startDate' => date("yyyy-mm-dd hh:ii:ss"),
                                                'todayHighlight' => true,
                                                'autoclose' => true,
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-sm-5">
                                        <?php  
                                        echo '<label class="control-label">To</label>';
                                        echo DateTimePicker::widget([
                                            'id' => 'datetimepickerflash2',
                                            'name' => 'SpesificPrice[toflash][]',
                                            'options' => ['placeholder' => 'click to set date'],
                                            'value' => $flashsale->to,
                                            'pluginOptions' => [
                                                'format' => 'yyyy-mm-dd hh:ii:ss',
                                                'startDate' => date("yyyy-mm-dd hh:ii:ss"),
                                                'todayHighlight' => true,
                                                'autoclose' => true,
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                    <div class="form-group <?php echo $checkSpecificPrice['is_flash_sale'] == 1 ? "" : "hidden"; ?>" style="padding: 2% 0 3% 0;" id="box-available-flashsale">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Available</label>
                                        <div class="col-sm-5">
                                            <?php  
                                            echo '<label class="control-label">From</label>';
                                            echo DateTimePicker::widget([
                                                'id' => 'datetimepickerflash1',
                                                'name' => 'SpesificPrice[fromflash][]',
                                                'options' => ['placeholder' => 'click to set date'],
                                                'pluginOptions' => [
                                                    'format' => 'yyyy-mm-dd hh:ii:ss',
                                                    'startDate' => date("yyyy-mm-dd hh:ii:ss"),
                                                    'todayHighlight' => true,
                                                'autoclose' => true,
                                                ]
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-sm-5">
                                            <?php  
                                            echo '<label class="control-label">To</label>';
                                            echo DateTimePicker::widget([
                                                'id' => 'datetimepickerflash2',
                                                'name' => 'SpesificPrice[toflash][]',
                                                'options' => ['placeholder' => 'click to set date'],
                                                'value' => $flashsale->to,
                                                'pluginOptions' => [
                                                    'format' => 'yyyy-mm-dd hh:ii:ss',
                                                    'startDate' => date("yyyy-mm-dd hh:ii:ss"),
                                                    'todayHighlight' => true,
                                                'autoclose' => true,
                                                ]
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                <?php } else { ?>
                                <div class="form-group <?php echo $checkSpecificPrice['is_flash_sale'] == 1 ? "" : "hidden"; ?>" style="padding: 2% 0 3% 0;" id="box-available-flashsale">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Available</label>
                                    <div class="col-sm-5">
                                        <?php  
                                        echo '<label class="control-label">From</label>';
                                        echo DateTimePicker::widget([
                                            'id' => 'datetimepickerflash1',
                                            'name' => 'SpesificPrice[fromflash][]',
                                            'options' => ['placeholder' => 'click to set date'],
                                            'pluginOptions' => [
                                                'format' => 'yyyy-mm-dd hh:ii:ss',
                                                'startDate' => date("yyyy-mm-dd hh:ii:ss"),
                                                'todayHighlight' => true,
                                                'autoclose' => true,
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-sm-5">
                                        <?php  
                                        echo '<label class="control-label">To</label>';
                                        echo DateTimePicker::widget([
                                            'id' => 'datetimepickerflash2',
                                            'name' => 'SpesificPrice[toflash][]',
                                            'options' => ['placeholder' => 'click to set date'],
                                            'value' => $flashsale->to,
                                            'pluginOptions' => [
                                                'format' => 'yyyy-mm-dd hh:ii:ss',
                                                'startDate' => date("yyyy-mm-dd hh:ii:ss"),
                                                'todayHighlight' => true,
                                                'autoclose' => true,
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="form-group <?php echo $checkSpecificPrice['is_flash_sale'] == 1 ? "hidden" : ""; ?>" style="padding: 2% 0 3% 0;" id="box-available">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Available</label>
                                    <div class="col-sm-5">
                                        <?php  
                                        echo '<label class="control-label">From</label>';
                                        echo DateTimePicker::widget([
                                            'name' => 'SpesificPrice[from]',
                                            'options' => ['placeholder' => 'click to set date'],
                                            'value' => !empty($checkSpecificPrice) && $checkSpecificPrice['is_flash_sale'] != 1 ? $checkSpecificPrice['from'] : "",
                                            'pluginOptions' => [
                                                'format' => 'yyyy-mm-dd hh:ii:ss',
                                                'startDate' => date("yyyy-mm-dd hh:ii:ss"),
                                                'todayHighlight' => true,
                                                'autoclose' => true,
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-sm-5">
                                        <?php  
                                        echo '<label class="control-label">To</label>';
                                        echo DateTimePicker::widget([
                                            'name' => 'SpesificPrice[to]',
                                            'options' => ['placeholder' => 'click to set date'],
                                            'value' => !empty($checkSpecificPrice) && $checkSpecificPrice['is_flash_sale'] != 1 ? $checkSpecificPrice['to'] : "",
                                            'pluginOptions' => [
                                                'format' => 'yyyy-mm-dd hh:ii:ss',
                                                'startDate' => date("yyyy-mm-dd hh:ii:ss"),
                                                'todayHighlight' => true,
                                                'autoclose' => true,
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                    <i class="fa fa-close"></i> Cancel
                                </button>
                            </div>
                            <div class="col-sm-1" style="margin-top: 5%; float: right;margin-left: 1%;">
                                <button type="submit" name="submitAddproduct" class="btn btn-default pull-right" onclick="return validation()">
                                    <i class="fa fa-save"></i> Save
                                </button>
                            </div>
                            <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                    <i class="fa fa-save"></i> Save &amp; Stay
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="warranty">
                        <?php 
                        $productWarranty = backend\models\ProductWarranty::findOne(['product_id' => $id]);
                        ?>
                        <div class="box-body">
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Warranty Type</label>
                                <div class="col-sm-10">
                                    <select id="warranty-name" class="form-control" name="ProductWarranty[warranty_name]">
                                        <option value="0"></option>
                                        <?php 
                                        $warranty = \backend\models\WarrantyType::findAll(['warranty_type_status' => 1]); 
                                        foreach ($warranty as $data){
                                        ?>
                                        <option value="<?php echo $data['warranty_type_id']; ?>" <?php echo $productWarranty != NULL && $productWarranty->warrantyType->warranty_type_name == $data['warranty_type_name'] ? 'selected' : ''; ?>><?php echo $data['warranty_type_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Warranty Year</label>
                                <div class="col-sm-10">
                                    <input type="text" id="warranty-year" class="form-control" name="ProductWarranty[warranty_year]" value="<?php echo $productWarranty != NULL ? $productWarranty->product_warranty_year : ''; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                    <i class="fa fa-close"></i> Cancel
                                </button>
                            </div>
                            <div class="col-sm-1" style="margin-top: 5%; float: right;margin-left: 1%;">
                                <button type="submit" name="submitAddproduct" class="btn btn-default pull-right" onclick="return validation()">
                                    <i class="fa fa-save"></i> Save
                                </button>
                            </div>
                            <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                    <i class="fa fa-save"></i> Save &amp; Stay
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="seo">
                        <div class="box-body">
                            <div class="col-sm-12">
                                <?php
                                $brands = \backend\models\Brands::findOne($model->brands_brand_id);
                                ?>
                                <h3>Search engine listing preview <a onclick="updatePreviewMeta()" class="btn btn-default"><i class="fa fa-refresh"></i></a></h3>
                                <div style="border: 1px solid #f0f0f0; width: 530px">
                                    <h4 id="preview-page-title" style="color: #1a0dab;">The Watch Co. - <?php echo $brands->brand_name . ' - ' . $productDetail->meta_title; ?></h4>
                                    <h6 id="preview-page-url" style="color: #006621;">http://thewatch.co/product/<?php echo $productDetail->link_rewrite; ?></h6>
                                    <h5 id="preview-page-description"><?php echo $productDetail->meta_description; ?></h5>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr/>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Meta Title</label>
                                <div class="col-sm-10">
                                    <?= $form->field($productDetail, 'meta_title')->textInput()->label(false) ?>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Meta Keywords</label>
                                <div class="col-sm-10" style="margin-bottom: 4%;">
                                    <textarea id="meta_keywords" name="ProductDetail[meta_keywords]" rows="10" cols="80">
                                        <?php echo $productDetail->meta_keywords; ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Meta Description</label>
                                <div class="col-sm-10" style="margin-bottom: 4%;">
                                    <textarea id="meta_description" name="ProductDetail[meta_description]" rows="10" cols="80">
                                        <?php echo $productDetail->meta_description; ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Friendly Url</label>
                                <div class="col-sm-4">
                                    <?= $form->field($productDetail, 'link_rewrite')->textInput()->label(false) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;margin-left: 1%;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right" onclick="return validation()">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-save"></i> Save &amp; Stay
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
                                <div class="col-sm-8">
                                    <?= $form->field($model, 'brands_brand_id')->dropDownList(ArrayHelper::map(\backend\models\Brands::find()->all(), 'brand_id', 'brand_name'), ['prompt' => '', 'onchange' => 'checkcollection()'])->label(false) ?>
                                </div>
                                <div class="col-sm-2 control-label">
                                    <a href="../../brands/create" class="btn btn-default pull-left">
                                        <i class="fa fa-plus"></i> Add New Brands
                                    </a>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 4% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Brand Collection</label>
                                <div class="col-sm-8">
                                    <?= $form->field($model, 'brands_collection_id')->dropDownList(ArrayHelper::map(\backend\models\BrandsCollection::find()->all(), 'brands_collection_id', 'brands_collection_name'), ['prompt' => ''])->label(false) ?>
                                </div>
                                <div class="col-sm-2 control-label">
                                    <a href="../../brandscollection/create" class="btn btn-default pull-left">
                                        <i class="fa fa-plus"></i> Add New Collection
                                    </a>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;margin-left: 1%;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-save"></i> Save &amp; Stay
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="shipping">
                        <div class="box-body">
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Height</label>
                                <div class="col-sm-2">
                                    <?= $form->field($model, 'height')->textInput()->label(false) ?>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Width</label>
                                <div class="col-sm-2">
                                    <?= $form->field($model, 'width')->textInput()->label(false) ?>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Weight</label>
                                <div class="col-sm-2">
                                    <?= $form->field($model, 'weight')->textInput()->label(false) ?>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Carriers</label>
                                <div class="col-sm-10">
                                    <select multiple="multiple" class="shipping-carrier" name="carrierShipping[]" id="112multiselect">
                                        <?php
                                        $product_carriers = \backend\models\ProductCarrier::find()->where(["product_id" => $id])->all();
                                        $product_carrier = \backend\models\ProductCarrier::find()->select('carrier_id')->where(["product_id" => $id]);
                                        $carriers = backend\models\Carrier::find()->where(["not in", "carrier_id", $product_carrier])->all();
                                        ?>
                                        <?php if (count($product_carriers)) { ?>
                                            <?php
                                            foreach ($product_carriers as $row) {
                                                $carrier = backend\models\Carrier::findOne($row->carrier_id);
                                                ?>
                                                <option value="<?php echo $row->carrier_id; ?>" selected><?php echo $carrier->name; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if (count($carriers) > 0) { ?>
                                            <?php foreach ($carriers as $row) { ?>
                                                <option value="<?php echo $row->carrier_id; ?>"><?php echo $row->name; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
							<br>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-4 control-label" style="margin-top: 5%;">Product Availability Location :</label>
                                <div class="col-sm-7" style="margin-top: 5%;">
                                    <?php  
                                    $productLocation = backend\models\ShippingAvailabilityLocation::findAll(['shipping_availability_location_status' => 1]);
                                    foreach($productLocation as $location){
                                    ?>
                                    <input type="radio" <?php echo $productDetail->shipping_availability_location_id == $location->shipping_availability_location_id ? "checked='checked'" : ""; ?> name="ProductLocation[value]" value="<?php echo $location->shipping_availability_location_id; ?>"> <?php echo $location->shipping_availability_location_name; ?><br>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;margin-left: 1%;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right" onclick="return validation()">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-save"></i> Save &amp; Stay
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="product_id" value="<?php echo $model->product_id; ?>"/>
                    <div class="tab-pane" id="combination">
                        <div class="box-body" id="formAttribute">
                            <div class="form-group add-new-combination" style="padding: 2% 0 3% 0; display: none;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Attribute Color</label>
                                <div class="col-sm-5">
                                    <?php $attributes = \backend\models\Attributes::find()->all(); ?>
                                    <select id="attribute_id" name="ProductAttribute[attribute_id]" class="form-control">
                                        <?php if (count($attributes) > 0) { ?>
                                            <option value="0" selected="selected">Select Attribute</option>
                                            <?php foreach ($attributes as $attribute) { ?>
                                                <option value="<?php echo $attribute->attribute_id; ?>"><?php echo $attribute->name; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group add-new-combination" style="padding: 2% 0 3% 0; display: none;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Value Color</label>
                                <div class="col-sm-5">
                                    <select disabled="disabled" name="ProductAttribute[attribute_value]" id="attribute_value_id" class="form-control">
                                        <option value="0" selected="selected">Select Value</option>
                                    </select>
                                </div>
                                <div class="col-sm-3" id="add-new-value-attributes" style="display: none;">
                                    <a class="btn btn-default" href="../../productattributes/update/6">Add new value</a>
                                </div>
                            </div>
                            <div class="form-group add-new-combination" style="padding: 2% 0 3% 0; display: none;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Attribute Size</label>
                                <div class="col-sm-5">
                                    <?php $attributes = \backend\models\Attributes::find()->all(); ?>
                                    <select id="attribute_id2" name="ProductAttribute[attribute_id]" class="form-control">
                                        <?php if (count($attributes) > 0) { ?>
                                            <option value="0" selected="selected">Select Attribute</option>
                                            <?php foreach ($attributes as $attribute) { ?>
                                                <option value="<?php echo $attribute->attribute_id; ?>"><?php echo $attribute->name; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group add-new-combination" style="padding: 2% 0 3% 0; display: none;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Value Size</label>
                                <div class="col-sm-5">
                                    <select disabled="disabled" name="ProductAttribute[attribute_value]" id="attribute_value_id2" class="form-control">
                                        <option value="0" selected="selected">Select Value</option>
                                    </select>
                                </div>
                                <div class="col-sm-3" id="add-new-value-attributes2" style="display: none;">
                                    <a class="btn btn-default" href="../../productattributes/update/6">Add new value</a>
                                </div>
                            </div>
                            <div class="form-group add-new-combination" style="padding: 2% 0 3% 0; display: none;">
                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <div class="col-sm-6" style="padding-left: 0;">
                                        <select name="ProductAttributeCombination[]" class="select2" id="ProductAttributeCombination" style="width: 400px;" multiple="multiple">
                                            <!--<option value="11" groupid="3">Color&nbsp;&nbsp; : Black</option>-->
                                        </select>
                                    </div>
                                    <div class="col-sm-4" style="padding-left: 0;">
                                        <a href="#" id="createCombination" class="btn btn-app">
                                            <i class="fa fa-plus"></i> Add
                                        </a>
                                        <a href="#" id="removeCombination" class="btn btn-app">
                                            <i class="fa fa-minus"></i> Remove
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group edit-img-combination" style="padding: 2% 0 3% 0; display: none;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Attribute name</label>
                                <div class="col-sm-10"><input type="text" id="attribute-edit-name" class="form-control" value="CLASSY YORK" disabled></div>
                                <div class="clearfix" style="padding-bottom: 35px;"></div>
                                <label for="inputEmail3" class="col-sm-2 control-label">Images</label>
                                <input type="hidden" id="edit_image_combination_id" name="product_attribute_combination_id" value="0"/>
                                <div class="col-sm-10" id="image-attribute-combination">
                                    <?php
                                    $productImage = backend\models\ProductImage::find()->where(['product_id' => $model->product_id])->all();
                                    $i = 0;
                                    foreach ($productImage as $row) {
                                        $i++;
                                        ?>
                                        <div class="col-sm-3">
                                            <input id="checkbox<?php echo $i; ?>" type="checkbox" name="product_image_combination[]" value="<?php echo $row->product_image_id; ?>">
                                            <img src="/frontend/web/img/product/<?php echo $row->product_image_id . '/' . $row->product_image_id . '.jpg'; ?>" style="width: 100%;"/>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="col-sm-12">
                                    <a href="#" id="saveCombination" class="btn btn-app" style="float: right; display: none;">
                                        <i class="fa fa-save"></i> Save
                                    </a>
                                    <a href="#" id="editCombination" class="btn btn-app" style="float: right; dipslay: none;">
                                        <i class="fa fa-save"></i> Update
                                    </a>
                                    <a href="#" id="cancelCombination" class="btn btn-app" style="float: left;">
                                        <i class="fa fa-close"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="col-sm-12">
                                <a class="btn btn-info" id="newCombination" href="#">New Combination</a>
                            </div>
                        </div>
                        <div class="box-body" id="attribute-combination">
                            <div class="col-sm-12" id="table-combination">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Attribute - value pair</th>
                                            <th>Image Selection</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="test-attribute">
                                        <?php $no = 1;
                                        ?>
                                        <?php foreach ($productAttributeCombination as $row) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $row->attributes->name . ' - ' . $row->attributeValue->value. ' , ' .$row->attributes2->name . ' - ' . $row->attributeValue2->value; ?></td>
                                                <td>
                                                    <?php
                                                    $product_image_attribute = backend\models\ProductAttributeImage::find()->where(['id_product_attribute' => $row->product_attribute_id])->one();
                                                    if (count($product_image_attribute) != 0) {
                                                        echo "Set";
                                                    } else {
                                                        echo "Not set";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button onclick="editCombination(<?php echo $row->product_attribute_id . ",'" . $row->attributes->name . ' : ' . $row->attributeValue->value . "'"; ?>);" type="button" class="btn btn-default"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#" onclick="deleteCombination(<?php echo $row->product_attribute_id; ?>);"><i class="fa fa-fw fa-trash"></i> Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
//                                        $no++;
                                            ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <!--                                <div class="col-sm-1" style="margin-top: 5%; float: right;margin-left: 1%;">
                                                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                                                        <i class="fa fa-save"></i> Save
                                                                    </button>
                                                                </div>
                                                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                                                        <i class="fa fa-save"></i> Save &amp; Stay
                                                                    </button>
                                                                </div>-->
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="quantities">
                        <div class="box-body">
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Available Quantities</label>
                                <div class="col-sm-10">
                                    <div class="col-sm-4 col-sm-offset-1">
                                        Quantity
                                    </div>
                                    <div class="col-sm-7">
                                        Designation
                                    </div>
                                </div>
                                <div id="product-quantity">
                                    <?php if (count($productAttributeCombination) > 0) { ?>
                                        <?php foreach ($productAttributeCombination as $row) { ?>
                                            <div class="col-sm-10 col-sm-offset-2" style="padding-top: 1%;">
                                                <div class="col-sm-4 col-sm-offset-1">
                                                    <input type="number" value="<?php echo $row->productStock->quantity; ?>" name="ProductStock[<?php echo $row->product_attribute_id; ?>]" class="form-control" id="inputEmail3" min="0">
                                                </div>
                                                <div class="col-sm-7">
                                                    <?php echo $row->attributes->name . ' - ' . $row->attributeValue->value .' , '. $row->attributes2->name . ' - ' . $row->attributeValue2->value; ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                        <div class="col-sm-10 col-sm-offset-2" style="padding-top: 1%;">
                                           <?php $productStock = backend\models\ProductStock::find()->where(["product_id" => $id , "product_attribute_id"=> 0])->one(); ?>
                                            <div class="col-sm-4 col-sm-offset-1">
                                                <input type="number" value="<?php echo $productStock->quantity; ?>" name="ProductStock[0]" class="form-control" id="inputEmail3" min="0">
                                            </div>
                                            <div class="col-sm-7">
                                                <?php // echo $row->attributes->name . ' - ' . $row->attributeValue->value;       ?>
                                            </div>
                                        </div>
                                    <?php  ?>
                                </div>
                            </div>
                            <!--<div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label" style="padding-top: 1%;">When Out Of Stock</label>
                                <div class="col-sm-8 col-sm-offset-1">
                                    <p class="radio">
                                        <label id="label_out_of_stock_1" for="out_of_stock_1">
                                            <input type="radio" id="out_of_stock_1" name="out_of_stock" checked="checked" value="0" class="out_of_stock">
                                            Deny orders
                                        </label>
                                    </p>
                                    <p class="radio">
                                        <label id="label_out_of_stock_1" for="out_of_stock_1">
                                            <input type="radio" id="out_of_stock_1" name="out_of_stock" checked="checked" value="0" class="out_of_stock">
                                            Allow orders
                                        </label>
                                    </p>
                                </div>
                            </div>-->
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;margin-left: 1%;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right" onclick="return validation()">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-save"></i> Save &amp; Stay
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
						
						$store_id = Yii::$app->session->get('userInfo')['store_id'];
						
                        $orderdetail = backend\models\OrderDetail::find()
							->joinWith(["orders"])
							->where(["order_detail.product_id" => $model->product_id])
							->andWhere(["orders.store_id" => $store_id])
							->all();
                        ?>
                        <div class="box-body">
							<h3>Order active on this product</h3><hr/>
							<table id="data-grid-order-active" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Order ID</th>
										<th>Product</th>
										<th>Attribute</th>
										<th>Quantity</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php

									?>
								</tbody>
							</table>
                        </div>
                    </div>
                    <div class="tab-pane" id="images">
                        <div class="box-body">
                            <!--<div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Add a new images</label>
                                <div class="col-sm-3">
                                    <input type="file" name="ProductImage[imageProducts][]" multiple>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" id="uploads" class="btn btn-default pull-right">
                                        <i class="fa fa-upload"></i> Upload
                                    </button>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Available Images</label>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                            <?php //if (count($productImage) > 0) {  ?>
                            <?php //foreach ($productImage as $image) { ?>
                                                                <div class="col-sm-2" style="text-align: center;">
                                                                    <img width="75%" src="<?php //echo Yii::$app->urlManagerFrontEnd->baseUrl;          ?>/img/product/<?php //echo $image->product_image_id;          ?>/<?php //echo $image->product_image_id          ?>.jpg">
                                                                    <br><br>
                                                                    <input type="radio" value="<?php //echo $image->product_image_id;          ?>" <?php //echo $image->cover === 1 ? "checked" : "";          ?> name="ProductImage[cover]">
                                                                    <br>
                                                                    <label>Set As Cover</label>
                                                                </div>
                            <?php //}  ?>
                            <?php //} ?>
                            </div>-->
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Add a new images</label>
                                <div class="col-sm-3">
                                    <input type="file" name="userImage" id="userImage" class="user-image" multiple />
                                </div>
                                <div class="col-sm-2">
                                    <a onclick="uploadimage()" class="btn btn-default pull-right"><i class="fa fa-upload"></i> Upload</a>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Available Images</label>
                            </div>

                            <div id="image-available" class="form-group" style="padding: 2% 0 3% 0;">
                                <?php if (count($productImage) > 0) { ?>
                                    <?php foreach ($productImage as $image) { ?>
                                        <div class="col-sm-2" style="text-align: center; padding-bottom: 50px;">
                                            <img width="75%" src="<?php echo Yii::$app->urlManagerFrontEnd->baseUrl; ?>/img/product/<?php echo $image->product_image_id; ?>/<?php echo $image->product_image_id ?>.jpg">
                                            <br><br>
                                            <input type="radio" value="<?php echo $image->product_image_id; ?>" <?php echo $image->cover === 1 ? "checked" : ""; ?> name="ProductImage[cover]">
                                            <br>
                                            <label>Set As Cover</label>
                                            <br/>
                                            <a onclick="deleteProductImage(<?php echo $image->product_image_id; ?>)" class="btn btn-default"><i class="fa fa-trash"></i></a>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>

                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;margin-left: 1%;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right" onclick="return validation()">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-save"></i> Save &amp; Stay
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">

                        </div>


                    </div>
                    <div class="tab-pane" id="features">
                        <div class="box-body">
                            <h3>Selected Features</h3>
                            <table id="data-grid-feature-selected" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="200px;">Feature Name</th>
                                        <th>Feature Value Name</th>
                                        <th width="300px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-feature-value">
                                    <?php
                                    $feature = \backend\models\ProductFeature::find()->where(['product_id' => $model->product_id])->all();
                                    $no = count($feature);
                                    foreach ($feature as $row) {
                                        $title = \backend\models\Feature::findOne($row->feature_id);
                                        $value = \backend\models\ProductFeatureValue::findOne($row->feature_value_id);
                                        ?>
                                        <tr>
                                            <td><?php echo $title->feature_name; ?></td>
                                            <td>
                                                <input type="text" class="form-control" value="<?php echo $value->feature_value_name; ?>" disabled/>
                                            </td>
                                            <td><a onclick="deleteFeature(<?php echo $row->product_feature_id; ?>)" class="btn btn-default text-center"><i class="fa fa-close"></i> Delete</a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <hr/>
                        <h3>Add Features</h3>
                        <div class="box-body">
                            <table id="data-grid-feature" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="200px;">Feature Name</th>
                                        <th>Available Value</th>
                                        <th>Custom Value Name</th>
                                        <th>Custom Value Variables</th>
                                        <th width="300px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-feature-add">
                                    <?php
                                    $feature = \backend\models\Feature::find()->all();
                                    $no = count($feature);
                                    foreach ($feature as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row->feature_name; ?></td>
                                            <td>
                                                <select id="feature_id<?php echo $row->feature_id; ?>" class="form-control" name="product_feature[][]">
                                                    <option>Please Select</option>
                                                    <?php
                                                    $value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
                                                    foreach ($value as $val) {
                                                        ?>
                                                        <option value="<?php echo $val->feature_value_id; ?>"><?php echo $val->feature_value_name; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td><input id="custom_value_name<?php echo $row->feature_id; ?>" type="text" name="product_feature_custom[][]" class="form-control"/></td>
                                            <td><input id="custom_value_value<?php echo $row->feature_id; ?>" type="text" name="product_feature_value_custom[][]" class="form-control"/></td>
                                            <td><a onclick="duplicate(<?php echo $row->feature_id . ",'" . $row->feature_name . "'"; ?>)" class="btn btn-default text-center"><i class="fa fa-copy"></i> Duplicate</a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;margin-left: 1%;">
                                    <a onclick="saveFeature();" class="btn btn-default pull-right">
                                        <i class="fa fa-save"></i> Save
                                    </a>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-save"></i> Save &amp; Stay
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="related">
                        <div class="box-body">
                            <div class="col-sm-10">
                                <select multiple="multiple" class="relatedItems" name="relatedItems[]" id="113multiselect">
                                    <?php if (count($productRelated)) { ?>
                                        <?php foreach ($productRelated as $related) { ?>
                                            <option value="<?php echo $related->product_id; ?>" selected><?php echo '[' . $related->product->brands->brand_name . '] ' . $related->productDetail->name; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if (count($products) > 0) { ?>
                                        <?php foreach ($products as $product) { ?>
                                            <option value="<?php echo $product->product_id; ?>"><?php echo '[' . $product->brands->brand_name . '] ' . $product->productDetail->name; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;margin-left: 1%;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right" onclick="return validation()">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-save"></i> Save &amp; Stay
                                    </button>
                                </div>
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
                                    <li>You must save this product before managing quantities.</li>
                                </ul>
                            </div>  
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div><!-- /tab-content -->
				<?php echo $this->render('/layouts/activityLog', [ 'module' => Yii::$app->controller->id, 'orders_id' => $model->product_id ]); ?>
            </div><!-- /tabbable -->
        </div><!-- /col -->
    </div><!-- /row -->
</section><!-- /container -->

<script>
    function validation() {
        if (document.getElementById('example2').value != "" && document.getElementById('example1').value == "" || document.getElementById('example1').value != "" && document.getElementById('example2').value == "") {
            alert('New arrival date not valid!');
            return false;
        }
    }
</script>