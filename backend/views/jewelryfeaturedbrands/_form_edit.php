<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Homebanner */
/* @var $form yii\widgets\ActiveForm */
?>



<?php if(isset($_GET['id'])){
        $id = $_GET['id'];
    }?>
<section class="content-header">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-left">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#information" data-toggle="tab">Brands</a></li>
                    <li><a href="#sendlist" data-toggle="tab">Menu Dropdown</a></li>
                    <li><a href="#picture" data-toggle="tab">Picture Menu</a></li>
                </ul>
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="information">
                         <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
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
                    <div class="tab-pane" id="sendlist">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                        <div class="box-body">
                            <h3>Menu Parent</h3>
                           <a class="btn btn-info" href = "../create/<?php echo $id ?>">Add New</a>
                                <div class="box" style="margin-top: 20px;">
                                    <div class="box-body">
                                        <table id="data-grid" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($data as $row) {
                                                   
                                                ?>
                                                    <?php
                                                    echo '<tr>';
                                                    echo '<td>';
                                                    echo $no;
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo $row->category_menu_name;
                                                    echo '</td>';
                                                   
                                                    echo '<td>';
                                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;../update2/' .$row->category_menu_id . '&#39;"><i class="fa fa-fw fa-pencil"></i> update</button></div>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;../delete/' .$row->category_menu_id . '&#39;"><i class="fa fa-fw fa-pencil"></i> delete</button></div>';
                                                     
                                                    echo '</td>';
                                                    echo '</tr>';
                                                    $no++;
                                                    ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box --> 
                        </div>

                        <div class="box-body">
                            <h3>Menu Child</h3>
                           <a class="btn btn-info" href = "../create2/<?php echo $id ?>">Add New</a>
                                <div class="box" style="margin-top: 20px;">
                                    <div class="box-body">
                                        <table id="data-grid" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Link</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($model4 as $row) {
                                                   
                                                ?>
                                                    <?php
                                                    echo '<tr>';
                                                    echo '<td>';
                                                    echo $no;
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo $row->category_menu_child_name;
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo $row->category_menu_child_link;
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;../update3/' .$row->category_menu_child_id . '&#39;"><i class="fa fa-fw fa-pencil"></i> update</button></div>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;../delete2/' .$row->category_menu_child_id . '&#39;"><i class="fa fa-fw fa-pencil"></i> delete</button></div>';
                                                     
                                                    echo '</td>';
                                                    echo '</tr>';
                                                    $no++;
                                                    ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box --> 
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="tab-pane" id="picture">
                        <!-- <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl() . '/brandscategory/picture/'.$id; ?>'">Edit</button> -->
                         <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data' ], 'action'=>['brandscategory/picture']]) ?>
                            <div class="box-body">
                               <a class="btn btn-info" href = "../create3/<?php echo $id ?>">Add New</a>
                                    <div class="box" style="margin-top: 20px;">
                                        <div class="box-body">
                                            <table id="data-grid" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Text</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    <?php foreach ($model3 as $row) {
                                                       
                                                    ?>
                                                        <?php
                                                        echo '<tr>';
                                                        echo '<td>';
                                                        echo $no;
                                                        echo '</td>';
                                                        echo '<td>';
                                                        echo '<img width="200" src="../../../../frontend/web/img/header/'.$row->category_menu_picture_image.'">';
                                                        echo '</td>';
                                                        echo '<td>';
                                                        echo $row->category_menu_picture_name;
                                                        echo '</td>';
                                                        echo '<td>';
                                                        echo $row->category_menu_picture_text;
                                                        echo '</td>';
                                                        echo '<td>';
                                                        if($row->category_menu_picture_status == 1){
                                                            echo "Active";
                                                        }
                                                       else{
                                                            echo "Not Active";
                                                       }
                                                        echo '</td>';
                                                        echo '<td>';
                                                        echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;../update4/' .$row->category_menu_picture_id . '&#39;"><i class="fa fa-fw fa-pencil"></i> update</button></div>';
                                        echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;../delete3/' .$row->category_menu_picture_id . '&#39;"><i class="fa fa-fw fa-pencil"></i> delete</button></div>';
                                                         
                                                        echo '</td>';
                                                        echo '</tr>';
                                                        $no++;
                                                        ?>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box --> 
                            </div>

                            
                        <?php ActiveForm::end(); ?>
                    </div>
                
            </div><!-- /tab-content -->
        </div><!-- /tabbable -->
    </div><!-- /col -->
</section>