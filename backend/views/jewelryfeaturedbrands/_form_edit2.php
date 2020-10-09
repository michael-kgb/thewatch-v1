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
                <?php $form = ActiveForm::begin() ?>
                <div class="box-body">
                    
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <label for="inputEmail3" class="col-sm-1 control-label">Brands</label>
                        <div class="col-sm-11">
                            <select multiple="multiple" class="product-tag" name="brandCategory[]" id="113multiselect">
                                <?php
                                $productRelated = \backend\models\ProductCategoryBrands::find()->where(["product_category_category_id" => $model->product_category_id])->all();
                                $productsRelated = \backend\models\ProductCategoryBrands::find()->select('brands_brand_id')->where(["product_category_category_id" => $model->product_category_id]);
                                $products = \backend\models\Brands::find()->where(["not in", "brand_id", $productsRelated])->all();
                                

                                
                                if (count($productRelated)) {
                                    ?>
                                    <?php foreach ($productRelated as $related) {
                                        $brands = backend\models\Brands::find()->where(['brand_id' => $related->brands_brand_id])->one();
                                    ?>
                                        <option value="<?php echo $related->brands_brand_id; ?>" selected><?php echo $brands->brand_name . ' '; ?></option>
                                    <?php
                                    }
                                }if (count($products) > 0) {
                                    foreach ($products as $product) {
                                        ?>
                                        <option value="<?php echo $product->brand_id; ?>"><?php echo $product->brand_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'float: right;margin-top: 2%;margin-right: 1.5%;']) ?>
                    </div>

                </div>
<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>