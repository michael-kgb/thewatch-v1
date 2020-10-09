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
          <div class="box box-primary">
            <!-- form start -->
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                <div class="box-body">
                    
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2"> 
                            <label for="inputEmail3" class="control-label pull-right">
                                Name
                            </label>
                        </div>
                        <div class="col-sm-10">
                            <input class="form-control" style="width: 35%;" type="text" name="OurPeople[our_people_name]" value="<?php echo $model->our_people_name; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2"> 
                            <label for="inputEmail3" class="control-label pull-right">
                                Short Description
                            </label>
                        </div>
                        <div class="col-sm-10" style="margin-bottom: 4%;">
                            <textarea class="form-control" style="width: 65%;" rows="4" name="OurPeople[our_people_short_description]"><?php echo $model->our_people_short_description; ?>
                            </textarea>
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2"> 
                            <label for="inputEmail3" class="control-label pull-right">
                                Current Profile Picture
                            </label>
                        </div>
                        <div class="col-sm-10" style="margin-bottom: 4%;">
                            <img width="300" src="/frontend/web/img/ourpeople/<?php echo $model->our_people_profile_picture; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2"> 
                            <label for="inputEmail3" class="control-label pull-right">
                                Change Profile Picture
                            </label>
                        </div>
                        <div class="col-sm-10" style="margin-bottom: 4%;">
                            <input type="hidden" name="OurPeople[our_people_profile_picture]" value="">
                            <input class="form-control" type="file" id="ourpeople-our_people_profile_picture" name="OurPeople[our_people_profile_picture]" value="<?php echo $model->our_people_profile_picture; ?>">
                        </div>
                    </div>
					
					<div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2"> 
                            <label for="inputEmail3" class="control-label pull-right">
                                Status
                            </label>
                        </div>
                        <div class="col-sm-10" style="margin-bottom: 4%;">
                            <select class="form-control" name="OurPeople[our_people_status]">
								<option value="1" <?php echo $model->our_people_status === 1 ? 'selected' : ''; ?>>Active</option>
								<option value="0" <?php echo $model->our_people_status === 0 ? 'selected' : ''; ?>>Inactive</option>
							</select>
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2"> 
                            <label for="inputEmail3" class="control-label pull-right">
                                Product List
                            </label>
                        </div>
                        <div class="col-sm-10">
                            <?php 
                                $productList = \backend\models\OurPeopleProduct::findAll(['our_people_id' => $model->our_people_id]); 
                                if(count($productList) > 0){
                                    foreach($productList as $product){
                            ?>
                            <a target="_blank" href="https://thewatch.co/product/<?php echo $product->product->productDetail->link_rewrite; ?>"><?php echo $product->product->productDetail->name; ?></a><br>
                            <?php 
                                    } 
                                } 
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-12" style="margin-bottom: 2%; margin-top: 3%;">
                            <button class="btn btn-default pull-right"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                  
                </div>
            <?php ActiveForm::end(); ?>
          </div>
        </div>
    </div>
</section>
