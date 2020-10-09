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

                    <div class="form-group">
                        <?= $form->field($model, 'category_menu_name')->textInput(['maxlength' => true]) ?>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Sub Category</label>
                                <div class="col-sm-10">
                                    <?php $products = \backend\models\CategoryMenuChild::find()->all(); ?>
                                    <?php $products2 = \backend\models\CategoryMenuMapping::find()->where(['category_menu_id' => $_GET['id']])->all(); ?>
                                    <select id="prod-select2" multiple class="form-control kota" name="category_related[]">
                                        <?php foreach ($products as $product) { ?>
                           
                                            <?php 
                                            $cek = 0;
                                            foreach ($products2 as $prod) { 
                                                if($prod->category_menu_child_id == $product->category_menu_child_id){
                                                    $cek = 1;
                                                }
                                            }?>
                                   
                                        <option value="<?php echo $product->category_menu_child_id;?>" <?php if($cek == 1){ echo 'selected';}?>><?php echo $product->category_menu_child_name;?></option>
                                        

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>