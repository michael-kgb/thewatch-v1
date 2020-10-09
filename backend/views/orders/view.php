<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<?php 
	$groupName = Yii::$app->session->get('userInfo')['departement'];
	$allowUpdateInventoryStatus = FALSE;
	$allowUpdateOrderStatus = TRUE;
	$allowSendEmailNotification = TRUE;
	$inventoryStatus = \backend\models\OrderDetailStateLang::find()->where(['apps_language_id' => 1])->all();
	
	if($groupName == "Warehouse"){
		$allowUpdateInventoryStatus = TRUE;
		$allowUpdateOrderStatus = FALSE;
		$allowSendEmailNotification = FALSE;
	}

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php
        $orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $model->orders_id])->all();
        $validtransaction = \backend\models\Orders::find()->where(['customer_id' => $model->customer_id, 'valid' => 1])->all();
        $totalspent = 0;
		$discount = 0;
		$now = date('Y-m-d H:i:s');
        
        $productDiscountAmount = 0;
        
        $orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $model->orders_id])->all();
        if(count($orderdetail) > 0){
            foreach ($orderdetail as $detail){
                if($detail->reduction_percent != 0){
                            
                            // check if discount date still valid
                            //if($detail->product->specificPrice->from <= $now && $detail->product->specificPrice->to > $now){
                                // $productDiscountAmount += ((($detail->reduction_percent / 100) * $detail->product_price) * $detail->product_quantity); 
							//}
					$list_exclude_10_percent = array(21641,21589,21590,21592,21594,21597,21599,21602,21604,21605,21606,21628);
					if($model->orders_id === 21532)
					{
						$productDiscountAmount += ((($detail->reduction_percent / 100) * $detail->product_price) * $detail->product_quantity);
						$productDiscountAmount += (((10 / 100) * $detail->product_price) * $detail->product_quantity);
					}
					elseif(in_array($model->orders_id, $list_exclude_10_percent))
					{
						$productDiscountAmount += ((($detail->reduction_percent / 100) * $detail->product_price) * $detail->product_quantity);
					}
					else
					{
						if($model->flash_sale === 1){
							// set for discount extra 10%
							if( ($model->date_add >= '2019-02-01 17:00:00') && ($model->date_add <= '2019-02-01 22:00:00') ){
								$productDiscountAmount += ((($detail->reduction_percent / 100) * $detail->product_price) * $detail->product_quantity); 
					
								$afterDiscountAmount = $detail->product_price - $productDiscountAmount;
								$productDiscountAmount += ((10 / 100) * $afterDiscountAmount);
							}else
							{
								$productDiscountAmount += ((($detail->reduction_percent / 100) * $detail->product_price) * $detail->product_quantity); 
							}
						}else{
							$productDiscountAmount += ((($detail->reduction_percent / 100) * $detail->product_price) * $detail->product_quantity); 
						}
					}
                                
                }
                        
                if($detail->reduction_amount != 0){
                            
                    // check if discount date still valid
                            //if($detail->product->specificPrice->from <= $now && $detail->product->specificPrice->to > $now){
                        $productDiscountAmount += $detail->reduction_amount;
                    //}
                            
                }
				
				if($detail->reduction_percent_extra != 0){
					
					if($detail->reduction_percent != 0){    
						$discountAmount = ((($detail->reduction_percent / 100) * $detail->product_price) * $detail->product_quantity); 		
					}
							
					if($detail->reduction_amount != 0){
						$discountAmount = $detail->reduction_amount;
					}
					
					$afterDiscountAmount = $detail->product_price - $discountAmount;
					$productDiscountAmount += (($detail->reduction_percent_extra / 100) * $afterDiscountAmount);
				}
            }
        }
        $voucherDiscount = 0;
        $orderCartRule = \backend\models\OrderCartRule::findOne(['orders_id' => $model->orders_id]);
                
                // discount voucher code
        if($orderCartRule != NULL){
            $voucherDiscount = $orderCartRule->value;
        }
        $totalDiscount = $voucherDiscount + $productDiscountAmount;
        
        
        if (!empty($model->orderCartRule->value))
            $discount = $model->orderCartRule->value;
        
        if (!empty($validtransaction)) {
            foreach ($validtransaction as $row) {
                $totalspent = $totalspent + $row->total_product_price - $discount + $row->total_shipping;
            }
        }
        ?>
        <input type="hidden" value="<?php echo $model->orders_id; ?>" id="orders-id"/>
        Order <?php echo $model->reference; ?> from <?php echo $model->customer->firstname . ' ' . $model->customer->lastname; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Orders</a></li>
        <li><a href="#">Orders</a></li>
    </ol>
</section>

<section class="content">

    <div class="box box-info" style="margin-top: 20px">
        <div class="box-body">
            <div class="col-sm-4">
                <table>
                    <tr>
                        <td rowspan="2" style="padding-right: 15%;"><i class="fa fa-calendar fa-3x" style="color: aqua"></i></td>
                        <td><b>Date order</b></td>
                    </tr>
                    <tr>
                        <td><?php echo date_format(date_create($model->date_add), 'j F Y h:i A'); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-4">
                <table>
                    <tr>
                        <td rowspan="2" style="padding-right: 15%;"><i class="fa fa-money fa-3x" style="color: palevioletred"></i></td>
                        <td><b>Total payment</b></td>
                    </tr>
                    <tr>
                        <td>
							<?php
								echo ($model->apps_language_id == 2) ? "Rp. " : "$";
								$finalTotal = (($model->total_product_price - $discount) + $model->total_shipping + $model->unique_code - $model->total_special_promo);
								$finalTotal += $model->total_shipping_insurance;
								if($finalTotal <= 0){
									$finalTotal = 0;
								}
								echo \common\components\Helpers::getPriceFormat($finalTotal);
                            ?>
						</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-4">
                <table>
                    <tr>
                        <td rowspan="2" style="padding-right: 15%;"><i class="fa fa-shopping-cart fa-3x" style="color: greenyellow"></i></td>
                        <td><b>Products</b></td>
                    </tr>
                    <tr>
                        <td><?php echo count($orderdetail); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- left column -->
        <div class="col-sm-7">
            <div class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-credit-card"></i> ORDER <?php echo $model->reference; ?> (#<?php echo $model->orders_id; ?>) <form method="GET" action="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/orders/view/<?php echo $model->orders_id; ?>" style="float: right;"><button type="submit" class="btn btn-default pull-right"><input type="hidden" name="print_invoice" value="1"><i class="fa fa-fw fa-print"></i> Print Invoice</button></form>
                    <hr/>
                </div>
                <div class="box-body">
                    <div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">STATUS</a></li>
							<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">DOCUMENTS</a></li>
						</ul>
						<div class="tab-content" style="margin-top: 20px;">
							<div class="tab-pane active" id="tab_1">
								<form method="POST" action="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/orders/updatestatusorder/<?php echo $model->orders_id; ?>">
								<div class="row">
									<div class="col-sm-12">
										<table id="table-status">
											<?php
											$last_status = "";
											$i = 0;
											$orderstate_id = 0;
											$order_history = backend\models\OrderHistory::find()->where(['orders_id' => $model->orders_id])->orderBy('date_add DESC')->all();
											$lastOrderName = '';
											foreach ($order_history as $row) {

												$orderstate_id = $row->order_state_id;
												if ($i == 0) {
													$last_status = $row->orderStateLang->template;
													$i++;
												}
												$order_state_lang = \backend\models\OrderStateLang::find()->where(['order_state_lang_id' => $row->order_state_lang_id])->one();
												?>
												<tr>
													<td width="15%">sacac</td>
													<td width="10%"><?php echo date_format(date_create($row->date_add), 'j F Y g:i A'); ?></td>
												</tr>
												<?php
												if($lastOrderName == ''){
													$lastOrderName = $order_state_lang->order_state_lang_id;
												}
											}
											?>
										</table>
										<div style="padding-top: 20px;">
											<div class="col-sm-10" style="padding-left: 0;">
												<select class="form-control" name="order-status" id="order-status">
													<?php
													$status = \backend\models\OrderStateLang::find()->where(['apps_language_id' => 2, 'payment_method_id' => $model->paymentmethoddetail->payment_method_id])->all();
													foreach ($status as $row) {
														?>
														<option <?= $row->order_state_lang_id == $lastOrderName ? 'disabled' : ''; ?> value="<?php echo $row->order_state_lang_id; ?>"><?php echo $row->name; ?></option>
														
														<?php
													}
													?>
												</select>
											</div>
											<button class="btn btn-primary col-sm-2" type="submit">Update </button>
										</div>
									</div>
								</div>
								</form>
							</div>
							<div class="tab-pane" id="tab_2">
								<div class="row">
									<div class="col-sm-12">
										<table class="table">
											<thead>
												<tr>
													<th>
														<span class="title_box ">Date</span>
													</th>
													<th>
														<span class="title_box ">Document</span>
													</th>
													<th>
														<span class="title_box ">Number</span>
													</th>
													<th>
														<span class="title_box ">Amount</span>
													</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php $orderInvoice = \backend\models\OrderInvoice::findOne(["orders_id" => $model->orders_id]); ?>
												<?php $orderDeliverySlip = \backend\models\OrderDeliverySlip::findOne(["orders_id" => $model->orders_id]); ?>
												<?php if($orderInvoice != NULL && $orderDeliverySlip != NULL){ ?>
												<tr>
													<td><?php echo date_format(date_create($orderInvoice->date_add), 'j F Y h:i A'); ?></td>
													<td>Invoice</td>
													<td><?php echo $orderInvoice->reference; ?></td>
													<td>Rp. <?php echo \common\components\Helpers::getPriceFormat($model->total_product_price - $model->total_discounts + $model->total_shipping); ?></td>
												</tr>
												<tr>
													<td><?php echo date_format(date_create($orderDeliverySlip->date_add), 'j F Y h:i A'); ?></td>
													<td>Delivery Slip</td>
													<td><?php echo $orderInvoice->reference; ?></td>
													<td>Rp. <?php echo \common\components\Helpers::getPriceFormat($orderDeliverySlip->shipping_cost_amount); ?></td>
												</tr>
												<?php } else { ?>
												<tr>
													<td colspan=5 align="center" style="padding-top: 30px;">There is no available document</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
									<?php if($orderInvoice == NULL || $orderDeliverySlip == NULL){ ?>
									<div class="col-sm-12">
										<form method="GET" action="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/orders/saveinvoice/<?php echo $model->orders_id; ?>" style="float: left;"><button type="submit" class="btn btn-default pull-left"><i class="fa fa-fw fa-refresh"></i> Generate Invoice</button></form>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
						<!-- /.tab-content -->
					</div>
                </div>
            </div>

            <div class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-truck"></i> SHIPPING INFORMATION <button type="button" class="btn btn-default pull-right" onclick="update_tracking_number(<?php echo $model->orders_id; ?>)"><i class="fa fa-fw fa-save"></i> Update</button>
                    <hr/>
                </div>
                <div class="box-body">
                    <div class="col-sm-12">
						<div class="col-sm-4"><div class="pull-right">Gift:</div></div>
						<?php if($model->gift == 1){ ?>
							<div class="col-sm-8"><div class="pull-left"><?php echo "Yes"; ?></div></div>
						<?php }else{ ?>
							<div class="col-sm-8"><div class="pull-left"><?php echo "No"; ?></div></div>
						<?php }?>
                        
						<div class="col-sm-4"><div class="pull-right">Gift Message:</div></div>
                        <div class="col-sm-8"><div class="pull-left"><?php echo $model->gift_message; ?></div></div>
						<div class="clearfix"></div>
                        <hr/>
                        <div class="col-sm-4"><div class="pull-right">Shipping Name:</div></div>
                        <div class="col-sm-8"><div class="pull-left"><?php echo $model->carriercost->carrier->name; ?></div></div>
                        <div class="col-sm-4"><div class="pull-right">Shipping Package:</div></div>
                        <div class="col-sm-8"><div class="pull-left"><?php echo $model->carriercost->carrierPackageDetail->carrierPackage->carrier_package_name; ?></div></div>
                        <div class="clearfix"></div>
                        <hr/>
                        <div class="col-sm-4"><div class="pull-right">Country:</div></div>
                        <div class="col-sm-8"><div class="pull-left"><?php echo $model->customeraddress->country->iso_code; ?></div></div>
                        <div class="col-sm-4"><div class="pull-right">Province:</div></div>
                        <div class="col-sm-8"><div class="pull-left"><?php echo $model->customeraddress->province->name; ?></div></div>
                        <div class="col-sm-4"><div class="pull-right">State:</div></div>
                        <div class="col-sm-8"><div class="pull-left"><?php echo $model->customeraddress->state->name; ?></div></div>
                        <div class="col-sm-4"><div class="pull-right">District:</div></div>
                        <div class="col-sm-8"><div class="pull-left"><?php echo $model->customeraddress->district->name; ?></div></div>
                        <div class="clearfix"></div>
						<hr/>
						<div class="col-sm-4"><div class="pull-right">Name:</div></div>
						<div class="col-sm-8"><div class="pull-left">
						<?php echo $model->customeraddress->firstname . ' ' . $model->customeraddress->lastname; ?> 
						</div></div>
						<div class="col-sm-4"><div class="pull-right">Shipping Address:</div></div>
						<div class="col-sm-8"><div class="pull-left">
							<?php echo $model->customeraddress->address1; ?><br/>
							<?php echo $model->customeraddress->postcode; ?> <?php echo $model->customeraddress->province->name; ?><br/>
	<?php echo $model->customeraddress->phone; ?>
						</div></div>
						<div class="clearfix"></div>
						<div class="col-sm-4"><div class="pull-right">Shipping Insurance:</div></div>
						<div class="col-sm-8"><div class="pull-left">
							<?php echo $model->total_shipping_insurance != 0 ? '<span style="color: #0000ff;">Yes</span>' : '<span style="color: #FF0000;">No</span>'; ?><br/>
						</div></div>
						<?php if($model->total_shipping_insurance != 0){ ?>
						<div class="col-sm-4"><div class="pull-right">Insurance Amount:</div></div>
						<div class="col-sm-8"><div class="pull-left">
							<b><?php echo 'Rp. ' . \common\components\Helpers::getPriceFormat($model->total_shipping_insurance); ?></b><br/>
						</div></div>
						<?php } ?>
						<div class="clearfix"></div>
                        <hr/>
						<div class="col-sm-4"><div class="pull-right">Shipping Carrier:</div></div>
						<div class="col-sm-8" style="margin-bottom: 20px;">
						<select class="form-control" id="shipping-carrier" <?php echo ($last_status == 'shipped') ? "" : "disabled"; ?>>
							<option value="JNE" <?php echo $model->carrier_delivery_name == "JNE" ? "selected" : "" ; ?>>JNE</option>
							<option value="NCS" <?php echo $model->carrier_delivery_name == "NCS" ? "selected" : "" ; ?>>NCS</option>
							<option value="J&T" <?php echo $model->carrier_delivery_name == "J&T" ? "selected" : "" ; ?>>J &amp; T</option>
							<option value="NINJAEXPRESS" <?php echo $model->carrier_delivery_name == "NINJAEXPRESS" ? "selected" : "" ; ?>>NINJAEXPRESS</option>
							<option value="GO-SEND" <?php echo $model->carrier_delivery_name == "GO-SEND" ? "selected" : "" ; ?>>GO-SEND</option>
						</select>
						</div>
						<div class="clearfix"></div>
                        <div class="col-sm-4"><div class="pull-right">Tracking number:</div></div>
                        <div class="col-sm-8" style="margin-bottom: 20px;"><input type="text" class="form-control" id="tracking-number" value="<?php echo $model->shipping_number ?>" <?php echo ($last_status == 'shipped') ? "" : "disabled"; ?> /></div>
						<div class="clearfix"></div>
						<div class="col-sm-4"><div class="pull-right">Notes:</div></div>
                        <div class="col-sm-8">
							<textarea class="form-control" style="margin: 0px -16.875px 0px 0px;" id="carrier_delivery_notes" name="carrier_delivery_notes"><?php echo $model->carrier_delivery_notes; ?></textarea>
						</div>
						<div class="clearfix"></div>
                        <hr/>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-5">
            <div id="private-note" class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-user"></i> CUSTOMER <?php echo strtoupper($model->customer->firstname); ?> #<?php echo $model->customer->customer_id; ?> <form method="GET" action="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/orders/view/<?php echo $model->orders_id; ?>" style="float: right;"><button type="submit" class="btn btn-default pull-right"><input type="hidden" name="print_sticker" value="1"><i class="fa fa-fw fa-print"></i> Print Sticker</button></form>
                    <hr/>
                </div>
                <div class="box-body">
                    <div class="col-sm-6">
                        <b>Email</b><br/><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $model->customer->email; ?>"><?php echo $model->customer->email; ?></a><br/><br/>
                        <b>Account Registered</b><br/><i class="fa fa-calendar"></i> <?php echo $model->customer->date_add; ?><br/><br/>
                        <b>Success order placed</b><br/><?php echo count($validtransaction); ?><br/><br/>
                        <b>Total spent since registration</b><br/><?php echo \common\components\Helpers::getPriceFormat($totalspent); ?>
                    </div>
                    <div class="col-sm-6">
                        <a href="../../customers/<?php echo $model->customer->customer_id; ?>" class="btn btn-default form-control"><i class="fa fa-eye"></i> View Details</a>
                        <div class="panel panel-default" style="margin-top: 30px;">
                            <div class="panel-heading">Private note</div>
                            <div class="panel-body"><textarea class="form-control"><?php echo $model->customer->note; ?></textarea></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
			
			<div class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-money"></i> PAYMENT <?php if($model->paymentmethoddetail->payment_method_id == 5){ ?><button class="btn btn-default pull-right" onclick="update_status_order(<?php echo $model->orders_id . ',' . $model->apps_language_id . ',' . $orderstate_id; ?>)"><i class="fa fa-fw fa-money"></i> Receipt Payment</button><?php } ?>
                    <hr/>
                </div>
				<div class="box-body">
					<?php
					$order_confirmation = \backend\models\OrderConfirmation::find()->where(['orders_id' => $model->orders_id])->all();
					if (!empty($order_confirmation)) {
						foreach ($order_confirmation as $row) {
							?>
					<div class="col-sm-12"><div class="pull-left"><b>Date:</b></div></div>
					<div class="col-sm-12"><div class="pull-left"><?php echo date_format(date_create($model->date_add), 'j M Y g:i A'); ?></div></div>
					<div class="col-sm-12" style="margin-top: 5%;"><div class="pull-left"><b>Payment Method:</b></div></div>
					<div class="col-sm-12"><div class="pull-left"><?php echo $model->paymentmethoddetail->paymentMethod->payment_method_name; ?></div></div>
					<div class="col-sm-12" style="margin-top: 5%;"><div class="pull-left"><b>Bank:</b></div></div>
					<div class="col-sm-12"><div class="pull-left"><?php echo $model->paymentmethoddetail->payment->name_bank . ' - ' . $model->paymentmethoddetail->payment->name_person; ?></div></div>
					<div class="col-sm-12" style="margin-top: 5%;"><div class="pull-left"><b>Account Name:</b></div></div>
					<div class="col-sm-12"><div class="pull-left"><?php echo $row->account_name; ?></div></div>
					<div class="col-sm-12" style="margin-top: 5%;"><div class="pull-left"><b>Account Number:</b></div></div>
					<div class="col-sm-12"><div class="pull-left"><?php echo $row->account_number; ?></div></div>
					<div class="col-sm-12" style="margin-top: 5%;"><div class="pull-left"><b>Bank:</b></div></div>
					<div class="col-sm-12"><div class="pull-left"><?php echo $row->bank_anda; ?></div></div>
					<div class="col-sm-12" style="margin-top: 5%;"><div class="pull-left"><b>Amount:</b></div></div>
					<div class="col-sm-12"><div class="pull-left"><?php echo common\components\Helpers::getPriceFormat($row->amount); ?></div></div>
					<div class="col-sm-12" style="margin-top: 5%;"><div class="pull-left"><b>Notes:</b></div></div>
					<div class="col-sm-12"><div class="pull-left"><?php echo $row->comments; ?></div></div>
					<?php
						}
					} else {
						?>
					<div class="col-sm-12"><div class="pull-left"><b>Date:</b></div></div>
					<div class="col-sm-12"><div class="pull-left">-</div></div>
					<div class="col-sm-12" style="margin-top: 5%;"><div class="pull-left"><b>Payment Method:</b></div></div>
					<div class="col-sm-12"><div class="pull-left"><?php echo $model->paymentmethoddetail->paymentMethod->payment_method_name; ?></div></div>
					<div class="col-sm-12" style="margin-top: 5%;"><div class="pull-left"><b>Bank:</b></div></div>
					<div class="col-sm-12"><div class="pull-left"><?php echo $model->paymentmethoddetail->payment->name_bank . ' - ' . $model->paymentmethoddetail->payment->name_person; ?></div></div>
					<div class="col-sm-12" style="margin-top: 5%;"><div class="pull-left"><b>Name:</b></div></div>
					<div class="col-sm-12"><div class="pull-left">-</div></div>
					<div class="col-sm-12" style="margin-top: 5%;"><div class="pull-left"><b>From:</b></div></div>
					<div class="col-sm-12"><div class="pull-left">-</div></div>
					<div class="col-sm-12" style="margin-top: 5%;"><div class="pull-left"><b>Amount:</b></div></div>
					<div class="col-sm-12"><div class="pull-left">-</div></div>
					<?php if($model->paymentmethoddetail->payment_method_id == 5){ ?>
						<div class="col-sm-12" style="margin-top: 5%;"><div class="pull-left"><b>Status:</b></div></div>
						<div class="col-sm-12">
							<div class="pull-left">
							<?php 
								/*
								$akulaku = new \common\components\Akulaku();
								$akulaku->setEnvironment('development');
								$akulaku->setCredentials("15284560", "6wmEI-uynZjDX6YeY6Lho6gUtXSEj45_xL__PqR-CHc");
								
								$inquiry = $akulaku->inquiryStatus($model->reference);
								if($inquiry->success){
									$status = $akulaku->getPaymentStatus($inquiry->data->status);
									echo $status;
								} else {
									echo '-';
								}
								*/
							?>
							</div>
						</div>
					<?php } ?>
					<?php 
					}
					?>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-sm-12">
			<form method="POST" action="<?php echo Yii::$app->urlManager->baseUrl; ?>/orders/view/<?php echo $model->orders_id; ?>">
            <div  id="customer-address" class="box box-info" style="margin-top: 20px;">
                <div class="box-header" id="total-address">
                    <i class="fa fa-shopping-cart"></i> Products 
                    <hr/>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Attributes</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Total</th>
								<th>Inventory Status</th>
								<th>Status</th>
                                <!--<th>Action</th>-->
                            </tr>
                        </thead>
                        <tbody id="table-customer-address">
                            <?php
                            $total_product_price = 0;
                            foreach ($orderdetail as $row) {
								$img_base = \Yii::$app->urlManagerFrontEnd->baseUrl;
                                $productimage = backend\models\ProductImage::find()->where(['product_id' => $row->product_id, 'cover' => 1])->one();
                                $productattribute = \backend\models\ProductAttributeCombination::find()->where(['product_attribute_id' => $row->product_attribute_id])->one();
                                if (!empty($productattribute)) {
                                    $attribute = $productattribute->attributes->name;
                                    $value = $productattribute->attributeValue->value;
                                    $attribute2 = $productattribute->attributes2->name;
                                    $value2 = $productattribute->attributeValue2->value;
                                } else {
                                    $attribute = '-';
                                    $value = '';
                                    $attribute2 = '-';
                                    $value2 = '';
                                }
                                ?>
                                <tr>
                                    <td><img src="<?= $img_base; ?>/img/product/<?php echo $productimage->product_image_id; ?>/<?php echo $productimage->product_image_id; ?>_small.jpg" class="img-responsive"></td>
                                    <td><?php echo $row->product_name; ?>
                                        
                                    </td>
                                    <td><?php echo ($attribute != '-') ? $attribute . ' : ' . $value : '-'; ?><?php echo ($attribute2 != '-') ? ', '.$attribute2 . ' : ' . $value2 : '-'; ?></td>
                                    <td><?php
                                        echo ($model->apps_language_id == 2) ? "Rp. " : "$";
                                        echo \common\components\Helpers::getPriceFormat($row->product_price);
                                        ?>
                                    </td>
                                    <td><?php echo $row->product_quantity; ?></td>
                                    <td><?php
                                        echo ($model->apps_language_id == 2) ? "Rp. " : "$";
                                        echo \common\components\Helpers::getPriceFormat($row->product_price * $row->product_quantity);
                                        $total_product_price = $total_product_price + ($row->product_price * $row->product_quantity);
                                        ?>
									</td>
									<td>
										<?php if(!$allowUpdateInventoryStatus){ ?>
										<?php 
										$status = \backend\models\OrderDetailHistory::find()->where(['order_detail_id' => $row->order_detail_id])->orderBy('date_add DESC')->all();
										
										if(count($status) > 0){
											$currentOrderDetailStatus = '';
											foreach($status as $rowStatus){
												$currentOrderDetailStatus = $rowStatus->order_detail_state_lang_id;
												break;
											}
										}
										?>
										<input type="hidden" name="orderDetailHistory[<?php echo $row->order_detail_id; ?>][order_detail_state_lang_id]" value="<?php echo $currentOrderDetailStatus; ?>">
										<?php } ?>
										<input type="hidden" value="<?php echo $row->order_detail_id; ?>" name="orderDetailHistory[<?php echo $row->order_detail_id; ?>][order_detail_id]">
										<input type="hidden" value="<?php echo $row->orders_id; ?>" name="orderDetailHistory[<?php echo $row->order_detail_id; ?>][orders_id]">
										<select <?php echo !$allowUpdateInventoryStatus ? "disabled" : ""; ?> class="form-control" name="orderDetailHistory[<?php echo $row->order_detail_id; ?>][order_detail_state_lang_id]">
											<?php 
											$status = \backend\models\OrderDetailHistory::find()->where(['order_detail_id' => $row->order_detail_id])->orderBy('date_add DESC')->all();
											
											if(count($status) > 0){
												
												$currentOrderDetailStatus = '';
												foreach($status as $rowStatus){
													$currentOrderDetailStatus = $rowStatus->order_detail_state_lang_id;
													break;
												}
											
												//$status = \backend\models\OrderStateLang::find()->where(['apps_language_id' => $order_state_lang->apps_language_id, 'payment_method_id' => $model->paymentmethoddetail->payment_method_id])->all();
												foreach ($inventoryStatus as $rowInventoryStatus) {
													?>
													<option value="<?php echo $rowInventoryStatus->order_detail_state_lang_id; ?>" <?php echo $rowInventoryStatus->order_detail_state_lang_id == $currentOrderDetailStatus ? "selected" : ""; ?>><?php echo $rowInventoryStatus->name; ?></option>
													<?php
												}
											}
											?>
										</select>
										<?php $status = \backend\models\OrderDetailHistory::find()->where(['order_detail_id' => $row->order_detail_id])->orderBy('date_add DESC')->one(); ?>
										<?php if($status != NULL){ ?>
										<span style="margin-top: 20px;">Notes :</span>
										<textarea <?php echo !$allowUpdateInventoryStatus ? "disabled" : ""; ?> name="orderDetailHistory[<?php echo $row->order_detail_id; ?>][notes]" rows="4" cols="50"><?php echo $status->notes; ?></textarea>
										<?php } ?>
									</td>
									<td>
										<?php if(!$allowUpdateOrderStatus){ ?>
										<?php 
										$status = \backend\models\OrderDetailHistory::find()->where(['order_detail_id' => $row->order_detail_id])->orderBy('date_add DESC')->all();
										
										if(count($status) > 0){
											$currentOrderStateStatus = '';
											foreach($status as $rowStatus){
												$currentOrderStateStatus = $rowStatus->order_state_lang_id;
												break;
											}
										}
										?>
										<input type="hidden" name="orderDetailHistory[<?php echo $row->order_detail_id; ?>][order_state_lang_id]" value="<?php echo $currentOrderStateStatus; ?>">
										<?php } ?>
										<select <?php echo !$allowUpdateOrderStatus ? "disabled" : ""; ?> class="form-control" name="orderDetailHistory[<?php echo $row->order_detail_id; ?>][order_state_lang_id]">
											<?php
											
											$status = \backend\models\OrderDetailHistory::find()->where(['order_detail_id' => $row->order_detail_id])->orderBy('date_add DESC')->all();
											$orderStatus = \backend\models\OrderStateLang::find()->where(['apps_language_id' => 2, 'payment_method_id' => $model->paymentmethoddetail->payment_method_id])->all();
											
											if(count($status) > 0){
												
												$currentOrderDetailStatus = '';
												foreach($status as $rowStatus){
													$currentOrderDetailStatus = $rowStatus->order_state_lang_id;
													break;
												}
											
												//$status = \backend\models\OrderStateLang::find()->where(['apps_language_id' => $order_state_lang->apps_language_id, 'payment_method_id' => $model->paymentmethoddetail->payment_method_id])->all();
												foreach ($orderStatus as $rowOrderStatus) {
													?>
													<option value="<?php echo $rowOrderStatus->order_state_lang_id; ?>" <?php echo $rowOrderStatus->order_state_lang_id == $currentOrderDetailStatus ? "selected" : ""; ?>><?php echo $rowOrderStatus->name; ?></option>
													<?php
												}
											}
											?>
											
										</select>
									</td>
                                    <!--<td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default" onclick="updateorderquantity(<?php //echo $row->order_detail_id; ?>, <?php //echo $row->product_quantity; ?>)">
                                                <i class="fa fa-fw fa-pencil"></i> Edit</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a style="cursor: pointer" onclick="deleteproductorder(<?php //echo $row->order_detail_id; ?>)"><i class="fa fa-fw fa-trash"></i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>-->
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="clearfix"></div>
                    <hr/>
                    <div id="add-product-order" style="display: none;">
                        <div class="col-sm-7">
                            <div class="col-sm-2"><div class="pull-right"><b>Category</b></div></div>
                            <div class="col-sm-10">
                                <?php
                                $category = backend\models\ProductCategory::find()->all();
                                ?>
                                <select id="check-category" class="form-control" onchange="checkcategory()">
                                    <option value="0">Please select</option>
                                    <?php
                                    foreach ($category as $row) {
                                        ?>
                                        <option value="<?php echo $row->product_category_id; ?>"><?php echo $row->product_category_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-2" style="margin-top: 30px;"><div class="pull-right"><b>Brand</b></div></div>
                            <div class="col-sm-10" style="margin-top: 30px;">
                                <select id="check-brands" class="form-control" onchange="checkbrands()">
                                    <option value="0">Please select</option>
                                </select>
                            </div>
                            <div class="col-sm-2" style="margin-top: 30px;"><div class="pull-right"><b>Product</b></div></div>
                            <div class="col-sm-10" style="margin-top: 30px;">
                                <select id="check-product" class="form-control" onchange="checkproduct()">
                                    <option value="0">Please select</option>
                                </select>
                            </div>
                            <div class="col-sm-2" style="margin-top: 30px;"><div class="pull-right"><b>Attributes</b></div></div>
                            <div class="col-sm-10" style="margin-top: 30px;">
                                <select id="check-attributes" class="form-control">
                                    <option value="0">Please select</option>
                                </select>
                            </div>
                            <div class="col-sm-2" style="margin-top: 30px;"><div class="pull-right"><b>Quantity</b></div></div>
                            <div class="col-sm-10" style="margin-top: 30px;">
                                <input type="text" class="form-control" id="quantity-add-order"/><button class="col-sm-3 btn btn-default pull-left" style="margin-top: 30px;" onclick="close_quantity()"><i class="fa fa-close"></i> Cancel</button><button class="col-sm-3 btn btn-default pull-right" style="margin-top: 30px;" onclick="add_product_order()"><i class="fa fa-save"></i> Save</button>
                            </div>

                        </div>
                    </div>
                    <div id="edit-product-order" style="display: none;">
                        <div class="col-sm-7">
                            <div class="col-sm-2"><div class="pull-right"><b>Quantity</b></div></div>
                            <div class="col-sm-10"><input type="hidden" id="update-order-id"/><input type="text" class="form-control col-sm-9" id="update-quantity"/><button class="col-sm-3 btn btn-default pull-left" style="margin-top: 30px;" onclick="close_quantity()"><i class="fa fa-close"></i> Cancel</button><button class="col-sm-3 btn btn-default pull-right" style="margin-top: 30px;" onclick="updatequantity()"><i class="fa fa-save"></i> Update</button></div>
                        </div>
                    </div>
                    <div class="col-sm-5 pull-right" style="border: 1px #cccccc solid;">
                        <div class="col-sm-7"><div class="pull-right">Product</div></div>
                        <div class="col-sm-5"><div class="pull-right"><?php
                                echo ($model->apps_language_id == 2) ? "Rp. " : "$";
                                echo \common\components\Helpers::getPriceFormat($total_product_price);
                                ?></div></div>
                        <br/>
                        <div class="col-sm-7"><div class="pull-right">Shipping</div></div>
                        <div class="col-sm-5"><div class="pull-right"><?php
                                echo ($model->apps_language_id == 2) ? "Rp. " : "$";
                                echo \common\components\Helpers::getPriceFormat($model->total_shipping);
                                ?></div></div>
                        <br/>
						<?php if($model->total_shipping == 0){ ?>
						<div class="col-sm-7"><div class="pull-right">Free Shipping Cost</div></div>
                        <div class="col-sm-5"><div class="pull-right"><?php
                                echo ($model->apps_language_id == 2) ? "Rp. " : "$";
								
								// calculate free shipping cost
								$freeShippingCost = 0;
								
								$flatPrice = \backend\models\CarrierCostFlatPrice::findOne([
									'province_id' => $model->customeraddress->province->province_id, 
									'carrier_package_id' => $model->carriercost->carrierPackageDetail->carrierPackage->carrier_package_id
								])->price;
								$weight = \common\components\Helpers::generateWeightOrderDetail($orderdetail);
								
								$freeShippingCost = $flatPrice * $weight;
								
                                echo \common\components\Helpers::getPriceFormat($freeShippingCost);
                                ?></div></div>
                        <br/>
						<?php } ?>
						<div class="col-sm-7"><div class="pull-right">Shipping Insurance</div></div>
                        <div class="col-sm-5"><div class="pull-right"><?php
                                echo ($model->apps_language_id == 2) ? "Rp. " : "$";
                                echo \common\components\Helpers::getPriceFormat($model->total_shipping_insurance);
                                ?></div></div>
                        <br/>
						<?php $orderCartRule = backend\models\OrderCartRule::findOne(['orders_id' => $model->orders_id]); ?>
						<div class="col-sm-7"><div class="pull-right">Product Discount</div></div>
                        <div class="col-sm-5"><div class="pull-right"><?php
                                echo ($model->apps_language_id == 2) ? "Rp. " : "$";
                                echo \common\components\Helpers::getPriceFormat($productDiscountAmount);
                                ?></div></div>
                        <br/>
                        <div class="col-sm-7"><div class="pull-right">Voucher Discount <b><?php if($orderCartRule != NULL) { echo $orderCartRule->name; } ?></b></div></div>
                        <div class="col-sm-5"><div class="pull-right"><?php
                                echo ($model->apps_language_id == 2) ? "Rp. " : "$";
                                echo \common\components\Helpers::getPriceFormat($voucherDiscount);
                                ?></div></div>
                        <br/>
                        <div class="col-sm-7"><div class="pull-right">Special Promo <?php if($model->total_special_promo != 0) { echo $model->specialPromo->promo_name; } ?></div></div>
                        <div class="col-sm-5"><div class="pull-right"><?php if($model->total_special_promo != 0) { echo 'Rp. '.\common\components\Helpers::getPriceFormat($model->total_special_promo); }else{ echo '-';} ?></div></div>
                        <br/>
                        <div class="col-sm-7"><div class="pull-right">Unique Code</div></div>
                        <div class="col-sm-5"><div class="pull-right"><?php echo $model->unique_code;?></div></div>
                        <br/>
                        <div class="col-sm-7"><div class="pull-right">Taxes</div></div>
                        <div class="col-sm-5"><div class="pull-right">-</div></div>
                        <br/>
                        <div class="col-sm-7"><div class="pull-right"><b>Grand Total</b></div></div>
                        <div class="col-sm-5">
							<div class="pull-right">
								<b>
								<?php
									echo ($model->apps_language_id == 2) ? "Rp. " : "$";
									$finalTotal = (($model->total_product_price - $discount) + $model->total_shipping + $model->unique_code - $model->total_special_promo);
									// if($ukey === 149){
									// 	echo '<script>alert("'.$finalTotal.'");</script>';
									// }
									$finalTotal += $model->total_shipping_insurance;
									if($finalTotal <= 0){
										$finalTotal = 0;
									}
									echo \common\components\Helpers::getPriceFormat($finalTotal);
                                ?>
								</b>
							</div>
						</div>
                    </div>
					<div class="clearfix"></div>
					<div class="col-sm-5 pull-right" style="border: 1px #cccccc solid;margin-top: 1%;">
						<div class="pull-right" style="margin-top: 3%;margin-bottom: 4%;">
							<input <?php echo !$allowSendEmailNotification ? "disabled" : ""; ?> name="is_notify_customer" type="checkbox" id="is_notify_customer">
							<label class="normal" for="history_notify" style="margin-left: 5px;"> Notify Customer by Email</label> <br>
							<button type="submit" class="btn btn-default pull-right" style="margin-top: 15px;"><i class="fa fa-fw fa-save"></i> Update</button>
						</div>
					</div>
                </div>
            </div>
			</form>
        </div>
		
		<?php echo $this->render('/layouts/activityLog', [ 'module' => Yii::$app->controller->id, 'orders_id' => $model->orders_id ]); ?>
    </div>
</section>
