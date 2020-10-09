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

                    <div class="form-group" style="padding: 2% 0 0% 0;">
                        <?= $form->field($model, 'tag_name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <label for="inputEmail3" class="col-sm-1 control-label">Carriers</label>
                        <div class="col-sm-11">
                            <select multiple="multiple" class="product-tag" name="productTags[]" id="113multiselect">
                                <?php
                                $productRelated = \backend\models\ProductTag::find()->where(["tag_id" => $model->tag_id])->all();
                                $productsRelated = \backend\models\ProductTag::find()->select('product_id')->where(["tag_id" => $model->tag_id]);
                                $products = \backend\models\Product::find()->where(["not in", "product_id", $productsRelated])->all();

                                if (count($productRelated)) {
                                    ?>
                                    <?php foreach ($productRelated as $related) {
                                        $productdetail = backend\models\ProductDetail::find()->where(['product_id' => $related->product_id])->one();
                                    ?>
                                        <option value="<?php echo $related->product_id; ?>" selected><?php echo $productdetail->name; ?></option>
                                    <?php
                                    }
                                }if (count($products) > 0) {
                                    foreach ($products as $product) {
                                        ?>
                                        <option value="<?php echo $product->product_id; ?>"><?php echo $product->productDetail->name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
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