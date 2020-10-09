<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View Customer Product Notify : <?php echo $model->productdetail->name; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Customers</a></li>
        <li><a href="#">Customer Notify</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12 box box-info">
            <!-- Horizontal Form -->
            <div class="">

                <div class="form-group" style="padding: 2% 0 0 0;">
                    <label for="inputEmail3" class="col-sm-2 control-label">Product Image</label>
                    <div class="col-sm-10">
                        <?php
                        $product_image = backend\models\ProductImage::find()->where(['product_id' => $model->product_id, 'cover' => 1])->one();
                        echo '<img src="' . Yii::$app->urlManagerFrontEnd->baseUrl . '/img/product/' . $product_image['product_image_id'] . '/' . $product_image['product_image_id'] . '_small' . '.jpg" class="img-responsive">';
                        ?>
                    </div>
                </div>
                <?php
                if ($model->product_attribute_id == 0) {
                    ?>
                    <div class="clearfix"></div>
                    <div class="form-group" style="padding: 1% 0 3% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label">Customer Notify</label>
                        <div class="col-sm-10">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Notify Count</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $customer_notify = \backend\models\CustomerProductNotify::find()->where(['product_id' => $model->product_id])->all();
                                    foreach ($customer_notify as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row->fullname; ?></td>
                                            <td><?php echo $row->email; ?></td>
                                            <td><?php echo $row->notify_count; ?></td>
                                            <td><a class="btn btn-default"><i class="fa fa-envelope"></i> Send notify</a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    } else {
                        $customer_notify = \backend\models\CustomerProductNotify::find()->where(['product_id' => $model->product_id])->orderBy('product_attribute_id ASC')->all();
                        $check = "";
                        $div = 0;
                        foreach ($customer_notify as $row) {
                            if ($row->product_attribute_id != $check) {
                                if ($div == 0) {
                                    $div = 1;
                                } else {
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                }
                                $check = $row->product_attribute_id;
                                ?>
                                <div class="clearfix"></div>
                                <div class="form-group" style="padding: 1% 0 3% 0;">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Customer Notify (<?php echo $row->productattributecombination->attributeValue->value; ?>)</label>
                                    <div class="col-sm-10">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Notify Count</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $row->fullname; ?></td>
                                                <td><?php echo $row->email; ?></td>
                                                <td><?php echo $row->notify_count; ?></td>
                                                <td><a class="btn btn-default"><i class="fa fa-envelope"></i> Send notify</a></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                </section>
