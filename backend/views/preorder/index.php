<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Orders 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Orders</a></li>
        <li><a href="#">Orders</a></li>
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
                                    <th>Reference</th>
                                    <th>Customer</th>
                                    <th>Total Paid</th>
									<!--<th>Gift</th>-->
                                    <th>Payment</th>
									<th>Inventory Status</th>
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
									
									$orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $row->orders_id])->all();
									$itemStatus = array();
									$i = 0;
									
									if(count($orderdetail) > 0){
										foreach($orderdetail as $detail){
											$inventoryStatus = \backend\models\OrderDetailHistory::find()->where(['order_detail_id' => $detail->order_detail_id])->orderBy('date_add DESC')->all();
											
											if(count($inventoryStatus) > 0){
												$currentOrderDetailStatus = '';
												foreach($inventoryStatus as $rowStatus){
													$itemStatus[$i] = $rowStatus->orderDetailStateLang->name;
													break;
												}
											}
											
											$i++;
										}									
									}
									
									$itemCountStatus = array_count_values($itemStatus);
									$itemStatus = array();
									
									$j = 0;
									foreach($itemCountStatus as $key => $value){
										$itemStatus[$j] = $value . ' items ' . $key;
										$j++;
									}
									
									echo implode(", ", array_slice($itemStatus, 0, 5)); 
										
									echo '</td>';
                                    echo '<td>';
                                    echo $status->orderStateLang->name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo date_format(date_create($row->date_add), 'j F Y g:i A');
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group">';
									echo '<a href="' . \yii\helpers\Url::base() . '/orders/view/' . $row->orders_id . '" class="btn btn-default" ><i class="fa fa-fw fa-eye"></i> View</a>';
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

<div class="modal fade" id="orderModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width: 1100px;">
    <div class="modal-content">
      <div class="modal-header" style="border: none;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="padding-top: 0;">
        
      </div>
<!--      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php echo $this->render('/layouts/log', [ 'module' => Yii::$app->controller->id]); ?>