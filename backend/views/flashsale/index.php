<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Order Flash Sale
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Orders</a></li>
        <li><a href="#">Flash Sale</a></li>
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
                                    <th>Reference</th>
                                    <th>Customer</th>
                                    <th>Total Paid</th>
									<!--<th>Gift</th>-->
                                    <th>Payment</th>
									<th>Product</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
								$inventoryStatus = \backend\models\OrderDetailStateLang::find()->where(['apps_language_id' => 1])->all();
                                foreach ($data as $row) {
                                    $status = \backend\models\OrderHistory::find()->where(['orders_id' => $row->orders_id])->orderBy('date_add DESC')->one();
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $no;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->reference;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->customer->firstname . ' ' . $row->customer->lastname;
                                    echo '</td>';
                                    echo '<td>';
                                    $discount = 0;
                                    if (!empty($row->orderCartRule->value)){
                                        $discount = $row->orderCartRule->value;
                                    }
                                    echo ($row->apps_language_id == 2) ? 'Rp. ' : '$ ';
									$finalTotal = (($row->total_product_price - $discount) + $row->total_shipping + $row->unique_code - $row->total_special_promo);
									$finalTotal += $row->total_shipping_insurance;
									if($finalTotal <= 0){
										$finalTotal = 0;
									}
                                    echo \common\components\Helpers::getPriceFormat($finalTotal);
                                    //echo '</td>';
									//echo '<td>';
									//if($row->gift==1){
									//	echo "Valentine Order";
									//}else{
									//	echo "-";
									//}
									//echo '</td>';
                                    echo '<td>';
                                    echo $row->paymentmethoddetail->payment->name_bank;
									if($row->payment_method_installment_detail_id != 0){
										echo ' ' . \backend\models\PaymentMethodInstallmentDetail::findOne(['payment_method_installment_detail_id' => $row->payment_method_installment_detail_id])->paymentMethodInstallment->payment_method_installment_name;
									}
									if($row->payment_method_detail_id == 10){
										$kredivoPaymentType = \backend\models\KredivoNotify::findOne(['kredivo_order_id' => $row->reference]);
										if($kredivoPaymentType->kredivo_payment_type == '30_days'){
											echo ' 30 days payment';
										} elseif($kredivoPaymentType->kredivo_payment_type == '3_months'){
											echo ' 3 month installment';
										} elseif($kredivoPaymentType->kredivo_payment_type == '6_months'){
											echo ' 6 month installment';
										} elseif($kredivoPaymentType->kredivo_payment_type == '12_months'){
											echo ' 12 month installment';
										}
									}
                                    echo '</td>';
									echo '<td>';
									$orderDetail = \backend\models\OrderDetail::findAll(["orders_id" => $row->orders_id]);
									if(count($orderDetail) > 0){
										foreach($orderDetail as $detail){
											echo '<a href="https://www.thewatch.co/product/' . $detail->product->productDetail->link_rewrite . '" target="__blank">' . $detail->product_name . '</a><br/>';
											echo 'Quantity : ' . $detail->product_quantity . '<br/>';
										}
									}
									echo '</td>';
                                    echo '<td>';
                                    echo $status->orderStateLang->name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo date_format(date_create($row->date_add), 'j F Y g:i A');
                                    echo '</td>';
                                    echo '<td>';
                                    if($row->flash_sale_approved == 'PENDING'){

                                        echo '<div class="btn-group"><button type="button" class="btn btn-warning">Pending</button><button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';

                                        echo '<ul class="dropdown-menu" role="menu">';

                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/flashsale/status-flash-sale?status=APPROVED&orderId=' . $row->orders_id . '">Approved</a></li>';

                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/flashsale/status-flash-sale?status=DISAPPROVED&orderId=' . $row->orders_id . '">Disapproved</a></li>';

                                        echo '</ul></div>';

                                    }

                                    if($row->flash_sale_approved == 'APPROVED'){

                                        echo '<div class="btn-group"><button type="button" class="btn btn-success">Approved</button><button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';

                                        echo '<ul class="dropdown-menu" role="menu">';

                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/flashsale/status-flash-sale?status=PENDING&orderId=' . $row->orders_id . '">Pending</a></li>';

                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/flashsale/status-flash-sale?status=DISAPPROVED&orderId=' . $row->orders_id . '">Disapproved</a></li>';

                                        echo '</ul></div>';

                                    }

                                    if($row->flash_sale_approved == 'DISAPPROVED'){

                                        echo '<div class="btn-group"><button type="button" class="btn btn-danger">Disapproved</button><button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';

                                        echo '<ul class="dropdown-menu" role="menu">';

                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/flashsale/status-flash-sale?status=PENDING&orderId=' . $row->orders_id . '">Pending</a></li>';

                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/flashsale/status-flash-sale?status=APPROVED&orderId=' . $row->orders_id . '">Approved</a></li>';

                                        echo '</ul></div>';

                                    }
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
			</div>
		</div>
	</section>
</section>