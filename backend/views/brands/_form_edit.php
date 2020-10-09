<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Homebanner */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
            <!-- general form elements -->
            <div id="brand_image" class="box box-primary">
                <!-- form start -->
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                <div class="box-body">

                    <div class="form-group" style="padding: 4% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Brand Name</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Brands[brand_name]" class="form-control" value="<?php echo $model->brand_name; ?>"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Brand Description</div></label>
                        <div class="col-sm-10">
                            <textarea name="Brands[brand_description]" class="form-control"><?php echo $model->brand_description; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Brand Country</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Brands[brand_country]" class="form-control" value="<?php echo $model->brand_country; ?>"/>
                        </div>
                    </div>

                    <?php if ($model->brand_logo != '') { ?>
                        <div class="form-group" style="padding: 2% 0 2% 0;">
                            <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Existing Logo</div></label>
                            <div class="col-lg-10">
                                <img height="100px" src="http://thewatch.co/frontend/web/img/brands/black/<?php echo $model->brand_logo; ?>">
                            </div>
                        </div> 
                    <?php } ?>  
                    <?php
                    $brandbanner = \backend\models\BrandsBanner::find()->where(['brands_brand_id' => $model->brand_id])->one();
                    if (!empty($brandbanner)) {
                        ?>
                        <div class="form-group" style="padding: 10% 0 2% 0;">
                            <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Existing Brand Banner</div></label>
                            <div class="col-lg-10">
                                <img height="150px" src="http://thewatch.co/frontend/web/img/brand_identity/<?php echo $brandbanner->brand_banner_small_banner; ?>">
                            </div>
                        </div> 
                    <?php } ?>  

                    <div class="clearfix"></div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Change Brand Logo</div></label>
                        <div class="col-sm-10">
                            <input type="file" name="Brands[brand_logo]"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Change Brand Banner</div></label>
                        <div class="col-sm-10">
                            <input type="file" name="Brands[brand_banner]"/>
                        </div>
                    </div>
					
					<div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Meta Description</div></label>
                        <div class="col-sm-10" style="margin-bottom: 4%;">
                            <textarea id="meta_description" name="Brands[meta_description]" rows="10" cols="80">
                                <?php echo $model->meta_description; ?>
                            </textarea>
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Meta Keywords</div></label>
                        <div class="col-sm-10" style="margin-bottom: 4%;">
                            <textarea id="meta_keywords" name="Brands[meta_keywords]" rows="10" cols="80">
                                <?php echo $model->meta_keywords; ?>
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Status</div></label>
                        <div class="col-sm-10">
                            <?= $form->field($model, 'brand_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive',], ['prompt' => ''])->label(false) ?>
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Brand Logo Viewed</div></label>
                        <div class="col-sm-10">
                            <?= $form->field($model, 'brand_featured')->dropDownList([ '1' => 'Yes', '0' => 'No',], ['prompt' => ''])->label(false) ?>
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Featured Brand</div></label>
                        <div class="col-sm-10">
                            <?= $form->field($model, 'brand_homepage')->dropDownList([ '1' => 'Yes', '0' => 'No',], ['prompt' => ''])->label(false) ?>
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Display in Brand New Arrival Home Section?</div></label>
                        <div class="col-sm-10">
                            <?= $form->field($model, 'brand_new_arrival')->dropDownList([ '1' => 'Yes', '0' => 'No',], ['prompt' => ''])->label(false) ?>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 3% 0;margin-bottom: 10px;">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Available in New Arrival Home Section</label>
                                    <div class="col-sm-5" style="margin-bottom: 10px;">
                                        <div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
                                            <input  type="text" class="form-control" placeholder="click to set date"  id="example1" name="Brands[brand_new_arrival_start]" value="<?php echo $model->brand_new_arrival_start;?>">
                                            <!--<input type="text" class="form-control" name="cartrule[date_to]" required>-->
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span> From
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-5" style="margin-bottom: 20px;">
                                        <div class="input-group margin" id="datetimepicker2" style="margin: 0px;">
                                            <input  type="text" class="form-control" placeholder="click to set date"  id="example2" name="Brands[brand_new_arrival_end]" value="<?php echo $model->brand_new_arrival_end;?>">
                                            <!--<input type="text" class="form-control" name="cartrule[date_to]" required>-->
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span> To
                                            </span>
                                        </div>
                                    </div>
                                </div>
                    
                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Featured Brand Jewelry</div></label>
                        <div class="col-sm-10">
                            <?= $form->field($model, 'brand_homepage_jewelry')->dropDownList([ '1' => 'Yes', '0' => 'No',], ['prompt' => ''])->label(false) ?>
                        </div>
                    </div>
                    
                    <?php
                        $brands_menu_type = [];
                        if (strpos($model->brands_menu_type, '-') !== false) {
                            $brands_menu_type = explode("-",$model->brands_menu_type);
                            $brands_menu_type2 = "";
                           
                            $model->brands_menu_type = $brands_menu_type[0];
                        }
                        

                    ?>
                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Brand Menu Type</div></label>
                        <div class="col-sm-10">
                            <?= $form->field($model, 'brands_menu_type')->dropDownList([ 'new' => 'new', 'hot' => 'hot','sale' => 'sale'], ['prompt' => ''])->label(false) ?>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Menu for icon (hot/sale/new)</div></label>
                        <div class="col-sm-10">
                           <?php 
                            $flag_w =  0;$flag_a =  0;$flag_s =  0;
                            if(count($brands_menu_type) > 1){
                                $menu_type = explode("+",$brands_menu_type[1]);
                                for($i=0;$i<count($menu_type);$i++){
                                    if($menu_type[$i] == 'watches'){
                                        $flag_w =  1;
                                    }
                                    if($menu_type[$i] == 'straps'){
                                        $flag_s =  1;
                                    }
                                    if($menu_type[$i] == 'accessories'){
                                        $flag_a =  1;
                                    }
                                }
                            }
                            
                           ?>
                            <input type="checkbox" name="icon[watches]" value="watches" <?php if($flag_w == 1){echo 'checked';}?> >Watches<br>
                            <input type="checkbox" name="icon[straps]" value="straps" <?php if($flag_s == 1){echo 'checked';}?> >Straps<br>
                            <input type="checkbox" name="icon[accessories]" value="accessories" <?php if($flag_a == 1){echo 'checked';}?> >Accessories<br>
                            <input type="checkbox" name="icon[jewelry]" value="jewelry" <?php if($flag_a == 1){echo 'checked';}?> >Jewelry<br>
                        </div>
                    </div>

                    <div class="pull-right">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>