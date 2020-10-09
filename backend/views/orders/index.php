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
                $ordertoday = \backend\models\Orders::find()
					->where(['>', 'date_add',date("Y-m-d")])
					->andWhere(['store_id' => $store_id])
					->all();
                $waitingtoday = \backend\models\Orders::find()->where(['valid' => 0])->andWhere(['>', 'date_add',date("Y-m-d")])->all();
                $successtoday = \backend\models\Orders::find()->where(['valid' => 1])->andWhere(['>', 'date_add',date("Y-m-d")])->all();
                if ($add_access == 1) {
                    ?>
                    <button class="btn btn-info" onclick="location.href = '#'">Add New</button>
                    <?php
                }
                ?>
                <div class="box" style="margin-top: 20px">
                    <div class="box-body">
                        <div class="col-sm-4">
                            <table>
                                <tr>
                                    <td rowspan="3" style="padding-right: 15%;"><i class="fa fa-shopping-cart fa-3x" style="color: aqua"></i></td>
                                    <td><b>Total order</b></td>
                                </tr>
                                <tr>
                                    <td>today</td>
                                </tr>
                                <tr>
                                    <td><?php echo count($ordertoday); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <table>
                                <tr>
                                    <td rowspan="3" style="padding-right: 15%;"><i class="fa fa-money fa-3x" style="color: palevioletred"></i></td>
                                    <td><b>Waiting payment</b></td>
                                </tr>
                                <tr>
                                    <td>today</td>
                                </tr>
                                <tr>
                                    <td><?php echo count($waitingtoday); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <table>
                                <tr>
                                    <td rowspan="3" style="padding-right: 15%;"><i class="fa fa-check fa-3x" style="color: greenyellow"></i></td>
                                    <td><b>Success order</b></td>
                                </tr>
                                <tr>
                                    <td>today</td>
                                </tr>
                                <tr>
                                    <td><?php echo count($successtoday); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
				
				<div class="box" style="margin-top: 20px">
                    <div class="box-body">
                        <div class="col-sm-12 col-lg-12">
                            <form method="get" action="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/orders/index">
                                
                                <?php

                                    $option = array(
                                        7 => 'Shipped',
                                        3 => 'Payment accepted',
                                        5 => 'Processing in progress',
                                        29 => 'User Payment Confirmation',
                                        19 => 'Awaiting bank wire payment',
                                        11 => 'Canceled',
										13 => 'Refunded [Bank Transfer]',
										71 => 'Refunded [Credit Card]',
										63 => 'Refunded [Installment]',
                                    );
                                ?>
                                <div style="margin-left: 15px;">
                                    <label>Filter by Status Order</label></br>
                                    <select name="status">
                                        <option value="">--Please Select--</option>
                                        <?php foreach ($option as $values => $labels): ?>
                                        <option value="<?php echo $values; ?>" <?php if ($_GET['status'] == $values) { echo ' selected="selected"'; } ?>><?php echo $labels; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <?php
                                    $options = array(
                                        1 => 'BCA',
                                        2 => 'Mandiri',
                                        3 => 'Credit Card Visa',
                                        4 => 'Credit Card Master Card',
                                        5 => 'Installment BCA',
                                        7 => 'Installment Mandiri',
                                        8 => 'Installment Permata',
                                        9 => 'Installment CIMB'
                                    );
                                ?>
                                </br>
                                <div style="margin-left: 15px;">
                                    <label>Filter by Payment</label></br>
                                    <select name="payment">
                                        <option value="">--Please Select--</option>
                                        <?php foreach ($options as $value => $label): ?>
                                        <option value="<?php echo $value; ?>" <?php if ($_GET['payment'] == $value) { echo ' selected="selected"'; } ?>><?php echo $label; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                </br>
                                <label style="margin-left: 15px;">Filter by Date Order</label>
                                </br>
                                <div class="col-sm-3">
                                    <div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
                                        <input  type="text" class="form-control" placeholder="click to set date"  id="from1" name="from" value="<?php echo $_REQUEST['from'];?>">                
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span> From
                                        </span>
                                    </div>
                                </div>
                        
                                <div class="col-sm-3">
                                    <div class="input-group margin" id="datetimepicker2" style="margin: 0px;">
                                        <input  type="text" class="form-control" placeholder="click to set date"  id="to2" name="to" value="<?php echo $_REQUEST['to'];?>">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span> To
                                        </span>
                                    </div>
                                </div>
                                <input type="submit" value="Filter"/>
								<div class="clearfix"></div>
                                <div class="col-sm-12" style="margin-top: 15px;">
                                <label>Export to :</label>
                                </div>
                                <div class="col-sm-3">
                                    <select name="export_to" class="col-sm-12">
                                        <option value="">-- Please Select --</option>
                                        <option value="Excel">Excel</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="submit" value="Export"/>
                                </div> 
                            </form>  
                        </div>
                    </div>
                </div>

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
									$detail = \backend\models\OrderDetail::find()->where(['orders_id' => $row->orders_id])->one();
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
//									print_r($status->product_price);
                                    //echo '</td>';
									//echo '<td>';
									//if($row->gift==1){
									//	echo "Valentine Order";
									//}else{
									//	echo "-";
									//}
									//echo '</td>';
                                    echo '</td>';
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
									echo '<a href="' . \yii\helpers\Url::base() . '/orders/view/' . $row->orders_id . '" class="btn btn-default" ><i class="fa fa-fw fa-eye"></i> View</a>
										  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											  <span class="caret"></span>
											  <span class="sr-only">Toggle Dropdown</span>
										  </button>
										  <ul class="dropdown-menu" role="menu">
										  <li><a href="#orderModal" class="btn btn-default" data-toggle="modal" data-load-remote="' . \yii\helpers\Url::base() . '/orders/quickview/' . $row->orders_id . '" data-remote-target="#orderModal .modal-body"><i class="fa fa-fw fa-eye"></i>Quick View</a></li></ul>';
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