<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <?php $form = ActiveForm::begin(); ?>
                <div class="box-body">
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Area : </label>
                        </div>
                        <div class="col-sm-5">
                            <select class="form-control" name="Store[store_location]" required="">
                                <option value="" selected>Please select</option>
                                <?php
                                $location = \backend\models\Location::find()->orderBy('location_name ASC')->all();
                                foreach ($location as $row) {
                                    ?>
                                <option value="<?php echo $row->location_name; ?>" <?php echo ($model->store_location == $row->location_name) ? 'selected' : '' ?>><?php echo $row->location_name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Title : </label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" id="journal-journal_category_id" class="form-control" name="Store[store_name]" value="<?php echo $model->store_name; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Phone Number : </label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" id="journal-journal_category_id" class="form-control" name="Store[store_contact_number]" value="<?php echo $model->store_contact_number; ?>">
                        </div>
                    </div>

                    

                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        
                    </div>
                    <div class="form-group" style="padding: 0 0 3% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Address : </label>
                        </div>
                        <div class="col-sm-5">
                            <textarea id="productdetail-spesification" name="Store[store_address]" rows="10" cols="80"><?php echo $model->store_address; ?></textarea>
                        </div>
                    </div>
                    
                    
                    
                    <div class="clearfix"></div>

                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Store Status : </label>
                        </div>
                        <div class="col-sm-5">
                            <select class="form-control" name="Store[store_status]" required="">
                                <option value="" selected>Please select</option>
                                
                                
                                    <option value="active" <?php echo ($model->store_status == 'active') ? 'selected' : '' ?>>active</option>
                                    <option value="inactive" <?php echo ($model->store_status == 'inactive') ? 'selected' : '' ?>>inactive</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 0 0;">
                    </div>

                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-default pull-right"><i class="fa fa-save"></i>Save</button>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <?php ActiveForm::end(); ?>
            </div>
        </div>
</section>
