<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View Cart Rule
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Price Rule</a></li>
        <li><a href="#">Cart Rule</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="box box-info">
                <div class="box-header">
                    <b>Information</b>
                </div>
                <div class="box-body">
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Name :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->cartRuleLang->name; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Description :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->description; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Code :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->code; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Highlight :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->highlight == 1 ? 'Yes' : 'No'; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Partial Use :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->partial_use == 1 ? 'Yes' : 'No'; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Priority :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->priority; ?>
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
                </div>
            </div>
            
            <div class="box box-info">
                <div class="box-header">
                    <b>Actions</b>
                </div>
                <div class="box-body">
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Free shipping :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->free_shipping == 1 ? 'Yes' : 'No'; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Apply a discount :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php 
                            if($model->reduction_percent != 0){
                                echo $model->reduction_percent . ' %';
                            }
                            else if($model->reduction_amount != 0){
                                echo 'Rp. ' . \common\components\Helpers::getPriceFormat($model->reduction_amount);
                            }
                            else{
                                echo '0';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="box box-info">
                <div class="box-header">
                    <b>Conditions</b>
                </div>
                <div class="box-body">
                    <div class="col-sm-5" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Single Customer :</b>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <?php echo $model->customer_id != 0 ? $model->customer->firstname . ' (' . $model->customer->email . ')' : '-'; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-5" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Valid from :</b>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <?php echo date_format(date_create($model->date_from), 'j F Y g:i A'); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-5" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Valid to :</b>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <?php echo date_format(date_create($model->date_to), 'j F Y g:i A'); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-5" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Minimum Amount :</b>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <?php echo common\components\Helpers::getPriceFormat($model->minimum_amount); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-5" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Total Available :</b>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <?php echo $model->quantity; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-5" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Total Available for Each User :</b>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <?php echo $model->quantity_per_user; ?>
                    </div>
                </div>
            </div>

            <?php
            if ($model->product_restriction != 0) {
                $product_selection_group = backend\models\CartRuleProductRuleGroup::find()->where(['cart_rule_id' => $model->cart_rule_id])->one();
                $product_selection = \backend\models\CartRuleProductRule::find()->where(['cart_rule_product_rule_group' => $product_selection_group['cart_rule_product_rule_group_id']])->all();
                foreach ($product_selection as $row) {
                    ?>
                    <div class="box box-info">
                        <div class="box-header">
                            <b><?php echo $row->type; ?> selection</b>
                        </div>
                        <div class="box-body">

                            <?php
                            $value = backend\models\CartRuleProductRuleValue::find()->where(['product_rule_id' => $row->cart_rule_product_rule_id])->all();
                            foreach ($value as $roww) {
                                ?>
                                <div class="col-sm-6" style="margin-bottom: 20px;">
                                    <?php
                                    if ($row->type == "products") {
                                        echo $roww->product->productDetail->name;
                                    }
                                    else if($row->type == "attributes"){
                                        echo $roww->attributeValueCombination->attributes->name . ' : ' . $roww->attributeValueCombination->attributeValue->value;
                                    }
                                    else if($row->type == "category"){
                                        echo $roww->productFeatureValue->feature->feature_name . ' : ' . $roww->productFeatureValue->feature_value_name;
                                    }
                                    else if($row->type == "brands"){
                                        echo $roww->brands->brand_name;
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>