<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Customer Product Notify 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Customers</a></li>
        <li><a href="#">Customer Notify</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Customer Notify</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data as $row) {
                                    $product_image = backend\models\ProductImage::find()->where(['product_id' => $row->product_id, 'cover' => 1])->one();
                                    $customer_notify = \backend\models\CustomerProductNotify::find()->where(['product_id' => $row->product_id])->all();
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $no;
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<img src="' . Yii::$app->urlManagerFrontEnd->baseUrl . '/img/product/' . $product_image['product_image_id'] . '/' . $product_image['product_image_id'] . '_small' . '.jpg" class="img-responsive">';
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->productdetail->name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo count($customer_notify);
                                    echo '</td>';
                                    echo '<td>';

                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->product_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button>';

                                    echo '</td>';
                                    echo '</tr>';
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</section>

<?php echo $this->render('/layouts/log', [ 'module' => Yii::$app->controller->id]); ?>