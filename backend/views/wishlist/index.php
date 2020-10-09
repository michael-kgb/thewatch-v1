<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Customer Wishlist 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Customer</a></li>
        <li><a href="#">Wishlist</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php
                $store_id = Yii::$app->session->get('userInfo')['store_id'];
                ?>

                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer</th>
									<th>Product</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data as $row) {
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $no;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->customer->firstname . ' ' . $row->customer->lastname;
                                    echo '</td>';
									echo '<td>';
									$customerWishlistDetail = \backend\models\CustomerWishlistDetail::findAll(["customer_wishlist_id" => $row->customer_wishlist_id]);
									if(count($customerWishlistDetail) > 0){
										foreach($customerWishlistDetail as $product){
											echo '<a href="https://www.thewatch.co/product/' . $product->product->productDetail->link_rewrite . '">'. $product->product->productDetail->name . '</a><br>';
										}
									}
                                    echo '</td>';
                                    echo '<td>';
                                    echo date_format(date_create($row->created_at), 'j F Y g:i A');
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