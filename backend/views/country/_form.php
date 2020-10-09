<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="box-body">
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">ISO Code : </label>
                        </div>
                        <div class="col-sm-10">
                            <?= $form->field($model, 'iso_code')->textInput()->label(false) ?>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Zone : </label>
                        </div>
                        <div class="col-sm-10">
                            <select class="form-control" name="Country[zone_id]" id="visibility">
                                <?php
                                $zone = \backend\models\Zone::find()->all();
                                foreach ($zone as $row) {
                                    ?>
                                    <option value="<?php echo $row->id_zone ?>" <?php if($row->id_zone == $model->zone_id) echo 'selected' ?>><?php echo $row->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Status : </label>
                        </div>
                        <div class="col-sm-10">
                            <?= $form->field($model, 'active')->dropDownList([ '1' => 'Active', '0' => 'Inactive',], ['prompt' => ''])->label(false) ?>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-default pull-right"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <?php ActiveForm::end(); ?>
            </div><!-- /.box -->
        </div>
    </div>
</section>