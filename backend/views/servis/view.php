<?php 
use backend\models\ServiceHistory;
use backend\models\OrderDetail;
use backend\models\ProductImage;
use backend\models\ProductAttribute;
use backend\models\ProductAttributeCombination;
use backend\models\AttributeValue;
use common\components\Helpers;
use backend\models\ServiceStateLang;
use backend\models\CustomerAddress;
use backend\models\ServiceDetail;
use backend\models\Log;
use backend\models\Stores;
use backend\models\ServiceConfirmation;
?>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">View Claim Service</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis">Claim Service</a></li>
					<li class="breadcrumb-item"><a href="#">View Claim Service</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->
	
	<div class="modal fade" id="showResi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Resi Information</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<div class="form-group row" style="margin-bottom: 0.5rem;">
								<label class="col-4 col-form-label"><b>Nomor Resi</b></label>
								<div class="col-8 col-form-label">
									<?php echo $data->customer_shipping_number; ?>
								</div>
							</div> 
							<div class="form-group row" style="margin-bottom: 0.5rem;">
								<label class="col-4 col-form-label"><b>Foto Resi</b></label>
								<div class="col-8 col-form-label">
									<img width=300 src="https://www.thewatch.co/img/warranty/service/uploads/customer-resi/<?php echo $data->customer_shipping_number_image == "" ? "img-default.jpg" : $data->customer_shipping_number_image; ?>" />
								</div>
							</div> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="showResiStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Resi Information</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/storedroplocation/<?php echo $data->service_id; ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<div class="form-group row" style="margin-bottom: 0.5rem;">
								<label class="col-4 col-form-label"><b>Shipping Carrier</b></label>
								<div class="col-8 col-form-label">
									<select onChange="storeShippingCarrierSelect()" id="store_shipping_carrier" class="form-control" name="store_shipping_carrier">
										<option value="">Please Select</option>
										<option value="JNE" <?php echo $data->store_shipping_carrier == "JNE" ? "selected" : "" ; ?>>JNE</option>
										<option value="NCS" <?php echo $data->store_shipping_carrier == "NCS" ? "selected" : "" ; ?>>NCS</option>
										<option value="GOJEK" <?php echo $data->store_shipping_carrier == "GOJEK" ? "selected" : "" ; ?>>GOJEK</option>
									</select>
								</div>
							</div> 
							
							<div class="form-group row" id="store-non-gojek" style="margin-bottom: 0.5rem;">
								<label class="col-4 col-form-label"><b>Nomor Resi</b></label>
								<div class="col-8 col-form-label">
									<input type="text" class="form-control" name="store_shipping_number" value="<?php echo $data->store_shipping_number; ?>" />
								</div>
							</div> 
							<div class="form-group row" id="store-gojek-1" style="margin-bottom: 0.5rem;<?php echo $data->store_shipping_carrier == "GOJEK" ? "" : "display: none;" ; ?>">
								<label class="col-4 col-form-label"><b>Driver Name</b></label>
								<div class="col-8 col-form-label">
									<input type="text" class="form-control" name="store_driver_name" value="<?php echo $data->store_driver_name; ?>" />
								</div>
							</div> 
							<div class="form-group row" id="store-gojek-2" style="margin-bottom: 0.5rem;<?php echo $data->store_shipping_carrier == "GOJEK" ? "" : "display: none;" ; ?>">
								<label class="col-4 col-form-label"><b>Driver Number</b></label>
								<div class="col-8 col-form-label">
									<input type="text" class="form-control" name="store_driver_number" value="<?php echo $data->store_driver_number; ?>" />
								</div>
							</div> 
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="showStoreLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Store Drop Item Location</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/setdroplocation/<?php echo $data->service_id; ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<div class="form-group row" style="margin-bottom: 0.5rem;">
								<label class="col-4 col-form-label"><b>Store Location</b></label>
								<div class="col-8 col-form-label">
									<?php $storesModel = Stores::findAll(["store_status" => "active"]); ?>
									<?php if(count($storesModel) > 0){ ?>
									<select name="store_id" class="form-control">
									<option value="0">PLEASE SELECT</option>
									<?php foreach($storesModel as $row){ ?>
									<option <?php echo $row->store_id == $data->sc_drop_store_id ? "selected" : ""; ?> value="<?php echo $row->store_id; ?>"><?php echo $row->store_name . ' ' . $row->store_address; ?></option>
									<?php } ?>
									</select>
									<?php } ?>
								</div>
							</div> 
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
				</form>
			</div>
		</div>
	</div>
    
    <div class="modal fade" id="showPic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nama PIC Store</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/picname/<?php echo $data->service_id; ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							
							<div class="form-group row" id="store-non-gojek" style="margin-bottom: 0.5rem;">
								<label class="col-4 col-form-label"><b>Nama PIC</b></label>
								<div class="col-8 col-form-label">
									<input type="text" class="form-control" name="pic_name" <?php echo $data->pic_name != '' ? 'disabled':'';?> value="<?php echo $data->pic_name; ?>" />
								</div>
							</div> 
							
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" <?php echo $data->pic_name != '' ? 'disabled':'';?>>Save changes</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="showPicStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nama PIC Store</h5>
				
				</div>
				<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/picnamelang/<?php echo $data->service_id; ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							
							<div class="form-group row" id="store-non-gojek" style="margin-bottom: 0.5rem;">
								<label class="col-4 col-form-label"><b>Nama PIC</b></label>
								<div class="col-8 col-form-label">
									<input type="text" class="form-control" name="pic_name" <?php echo $data->pic_name != '' ? 'disabled':'';?> value="<?php echo $data->pic_name; ?>" />
									<input type="hidden" class="form-control" name="pic_state_lang_id" value="0" />
								</div>
							</div> 
							
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" onclick="location.reload()">Cancel</button>
					<button type="submit" class="btn btn-primary" <?php echo $data->pic_name != '' ? 'disabled':'';?>>Save changes</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-7">
			<div class="card m-b-30 card-body">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-credit-card" style="margin-top: 10px;"></i> <span style="margin-left: 10px;">SERVICE (<?php echo $data->service_code; ?>)</span>
					<!--<form method="GET" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/print/<?php echo $data->service_id; ?>" style="float: right;">
						<button type="submit" class="btn btn-default pull-right" style="cursor: pointer;"><input type="hidden" name="print_invoice" value="1"><i class="fa fa-fw fa-print"></i> Print Invoice</button>
					</form>-->
				</div>
				<hr>
				<div class="col-12" style="margin-top: 10px; padding-left: 0; padding-right: 0;">
					<label class="col-form-label"><b>Status</b></label>
					<table id="table-status" width=100%>
						<?php $isDropInStore = FALSE; ?>
						<?php $serviceStatus = ServiceHistory::find()->where(['service_id' => $data->service_id])->orderBy('service_history.date_add DESC')->all(); ?>
						<?php if(count($serviceStatus) > 0){ ?>
						<tbody>
							<?php foreach($serviceStatus as $row){ ?>
							<tr>
								<td width="70%">
									<?php echo '('.$row->serviceStateLang->step.') '; ?><?php echo $row->serviceStateLang->text; ?> 
									<?php if($row->serviceStateLang->action_text == "show resi"){ ?>
									<span style="float: right;">
										<a href="#" data-toggle="modal" <?php echo $row->serviceStateLang->template != 'shipped_by_store_staff_to_service_center' ? 'data-target="#showResi"' : 'data-target="#showResiStore"'; ?>>
										<?php echo $row->serviceStateLang->action_text; ?>
										</a>
									</span>
									<?php } elseif($row->serviceStateLang->action_text == "store location"){ ?>
									<span style="float: right;">
										<a href="#" data-toggle="modal" data-target="#showStoreLocation">
										<?php echo $row->serviceStateLang->action_text; ?>
										</a>
									</span>
									<?php } ?>
									
									<?php if($row->serviceStateLang->action_text == "show pic"){ ?>
									<span style="float: right;">
										<a href="#" data-toggle="modal" data-target="#showPic">
										<?php echo $row->serviceStateLang->action_text; ?>
										</a>
									</span>
									<?php } ?>
								</td>
								<td width="30%" align="right"><?php echo date_format(date_create($row->date_add), 'j F Y g:i A'); ?></td>
							</tr>
							<?php if($row->serviceStateLang->template == 'dropped_by_customer_to_store'){ $isDropInStore = TRUE; } ?>
							<?php } ?>
						</tbody>
						<?php } ?>
					</table>
				</div>
				<div class="col-12" style="margin-top: 20px; padding-left: 0; padding-right: 0;">
					<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/updatestatusservice/<?php echo $data->service_id; ?>">
					<table width=100%>
						<tbody>
							<tr>
								<td width="70%">
									<?php 
										$group_id = Yii::$app->session->get('userInfo')['group_id'];
										$serviceStateLangModel = ServiceStateLang::find()->where(["apps_language_id" => 2, "group_id" => $group_id])->orderBy('step ASC')->all(); 
									?>
									<?php if(count($serviceStateLangModel) > 0){ ?>
									<select onChange="stateLangSelect()" class="form-control" name="service_state_lang_id" id="service_state_lang_id">
										<option value="0">Please Select</option>
										<?php foreach($serviceStateLangModel as $row){ ?>
										<option value="<?php echo $row->service_state_lang_id; ?>"><?php echo '('.$row->step.') '; ?><?php echo $row->text; ?></option>
										<?php } ?>
									</select>
									<?php } ?>
								</td>
								<td width="20%" align="right">
									<button class="btn btn-primary col-12" style="cursor: pointer;" type="submit">Update</button>
								</td>
							</tr>
						</tbody>
					</table>
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-5">
		    <div class="card card-body m-b-30">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-user" style="margin-top: 10px;"></i> <span style="margin-left: 10px;">STORE NAME</span>
				</div>
				<hr>
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					
					<table width=100%>
						<tbody>
						    <form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/updatestore/<?php echo $data->service_id; ?>">
							<tr>
							    <td width="20%">
							        Lokasi Store
							    </td>
								<td width="60%">
									<?php $storesModel = Stores::findAll(["store_status" => "active"]); ?>
									<?php if(count($storesModel) > 0){ ?>
									<select name="store_drop_id" class="form-control">
									<option value="0">PLEASE SELECT</option>
									<?php foreach($storesModel as $row){ ?>
									<option <?php echo $row->store_id == $service_detail_one->service_detail_drop_store_id ? "selected" : ""; ?> value="<?php echo $row->store_id; ?>"><?php echo $row->store_name . ' ' . $row->store_address; ?></option>
									<?php } ?>
									</select>
									<?php } ?>
								</td>
								<td width="20%" align="right">
									<button class="btn btn-primary col-12" style="cursor: pointer;" type="submit">Update</button>
								</td>
							</tr>
							</form>
							<tr height="5px"></tr>
							<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/picname/<?php echo $data->service_id; ?>">
							<tr>
							    <td width="20%">
							        Nama PIC
							    </td>
								<td width="60%">
									<input type="text" class="form-control" name="pic_name" <?php echo $data->pic_name != '' ? 'disabled':'';?> value="<?php echo $data->pic_name; ?>" />
								</td>
								<td width="20%" align="right">
									<button class="btn btn-primary col-12" style="cursor: pointer;" <?php echo $data->pic_name != '' ? 'disabled':'';?> type="submit">Update</button>
								</td>
							</tr>
							</form>
						</tbody>
					</table>
					
				</div>
		
			</div>
			<div class="card card-body m-b-30">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-user" style="margin-top: 10px;"></i> <span style="margin-left: 10px;">CUSTOMER DETAIL</span>
				</div>
				<hr>
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<div class="form-group row" style="margin-bottom: 0.5rem;">
						<label class="col-4 col-form-label"><b>Name</b></label>
						<div class="col-8 col-form-label">
							<?php echo $data->orders->customer->firstname . ' ' . $data->orders->customer->lastname; ?>
						</div>
					</div> 
					<div class="form-group row" style="margin-bottom: 0.5rem;">
						<label class="col-4 col-form-label"><b>Email</b></label>
						<div class="col-8 col-form-label">
							<a href="mailto:<?php echo $data->orders->customer->email; ?>"><?php echo $data->orders->customer->email; ?></a>
						</div>
					</div>   
					<div class="form-group row" style="margin-bottom: 0.5rem;">
						<label class="col-4 col-form-label"><b>No Telp</b></label>
						<div class="col-8 col-form-label">
							<?php echo $data->orders->customer->phone_number; ?>
						</div>
					</div> 
				</div>
				<div class="clearfix"></div>
				<div class="col-12" style="padding-left: 0; padding-right: 0; margin-top: 50px;">
					<i class="fa fa-cloud-upload" style="margin-top: 10px;"></i> <span style="margin-left: 10px;">RESI INFORMATION</span>
				</div>
				<hr>
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<div class="form-group row" style="margin-bottom: 0.5rem;">
						<label class="col-4 col-form-label"><b>Courier</b></label>
						<div class="col-8 col-form-label">
							<?php echo $data->customer_shipping_carrier; ?>
						</div>
					</div> 
					<div class="form-group row" style="margin-bottom: 0.5rem;">
						<label class="col-4 col-form-label"><b>Nomor Resi</b></label>
						<div class="col-8 col-form-label">
							<?php echo $data->customer_shipping_number; ?>
						</div>
					</div> 
					<div class="form-group row" style="margin-bottom: 0.5rem;">
						<label class="col-4 col-form-label"><b>Foto Resi</b></label>
						<div class="col-8 col-form-label">
							<a href="https://www.thewatch.co/img/warranty/service/uploads/customer-resi/<?php echo $data->customer_shipping_number_image == "" ? "img-default.jpg" : $data->customer_shipping_number_image; ?>"><img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/customer-resi/<?php echo $data->customer_shipping_number_image == "" ? "img-default.jpg" : $data->customer_shipping_number_image; ?>" /></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<div class="card m-b-30 card-body">
				<div class="col-12" style="padding-left: 0; padding-right: 0; margin-top: 20px;">
					<i class="fa fa-credit-card" style="margin-top: 10px;"></i> <span style="margin-left: 10px;">PAYMENT DETAIL</span>
				</div>
				<hr>
				<div class="form-row">
					<div class="form-group col-md-6" style="padding-left: 0; padding-right: 0;">
						<div class="form-group row" style="margin-bottom: 0.5rem;">
							<label class="col-6 col-form-label"><b>Transfer Recipient :</b></label>
						</div> 
						<div class="form-group row" style="margin-bottom: 0.5rem;">
							<label class="col-5 col-form-label"><b>Payment Method</b></label>
							<div class="col-7 col-form-label">
								<?php echo $data->paymentMethodDetail->paymentMethod->payment_method_name; ?>
							</div>
						</div> 
						<div class="form-group row" style="margin-bottom: 0.5rem;">
							<label class="col-5 col-form-label"><b>Bank</b></label>
							<div class="col-7 col-form-label">
								<?php echo $data->paymentMethodDetail->payment->name_bank . ' - ' . $data->paymentMethodDetail->payment->name_person; ?>
							</div>
						</div> 
						<div class="form-group row" style="margin-bottom: 0.5rem;">
							<label class="col-5 col-form-label"><b>Account Number</b></label>
							<div class="col-7 col-form-label">
								<?php echo $data->paymentMethodDetail->payment->account_number; ?>
							</div>
						</div>   
					</div>
					<?php 
					$serviceConfirmationModel = ServiceConfirmation::find()->where(["service_id" => $data->service_id])->orderBy('service_confirmation_id DESC')->one(); 
					if($serviceConfirmationModel != NULL){
					?>
					<div class="form-group col-md-6" style="padding-left: 0; padding-right: 0;">
						<div class="form-group row" style="margin-bottom: 0.5rem;">
							<label class="col-8 col-form-label"><b>Transfer Confirmation:</b></label>
						</div>  
						<div class="form-group row" style="margin-bottom: 0.5rem;">
							<label class="col-5 col-form-label"><b>Payment Method</b></label>
							<div class="col-7 col-form-label">
								<?php echo $serviceConfirmationModel->transfer_method; ?>
							</div>
						</div> 
						<div class="form-group row" style="margin-bottom: 0.5rem;">
							<label class="col-5 col-form-label"><b>Bank</b></label>
							<div class="col-7 col-form-label">
								<?php echo $serviceConfirmationModel->bank_account . ' - ' . $serviceConfirmationModel->account_name; ?>
							</div>
						</div> 
						<div class="form-group row" style="margin-bottom: 0.5rem;">
							<label class="col-5 col-form-label"><b>Account Number</b></label>
							<div class="col-7 col-form-label">
								<?php echo $serviceConfirmationModel->account_number; ?>
							</div>
						</div> 
						<div class="form-group row" style="margin-bottom: 0.5rem;">
							<label class="col-5 col-form-label"><b>Transfer Amount</b></label>
							<div class="col-7 col-form-label">
								IDR <?php echo Helpers::getPriceFormat($serviceConfirmationModel->amount); ?> 
							</div>
						</div>
						<div class="form-group row" style="margin-bottom: 0.5rem;">
							<label class="col-5 col-form-label"><b>Uploaded Image</b></label>
							<div class="col-7 col-form-label">
								<a target="_blank" href="https://www.thewatch.co/img/warranty/service/uploads/payment_confirm/<?php echo $serviceConfirmationModel->payment_image; ?>">
									<img src="https://www.thewatch.co/img/warranty/service/uploads/payment_confirm/<?php echo $serviceConfirmationModel->payment_image; ?>" width="200" />
								</a>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-7">
			<div class="card m-b-30 card-body">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-image"></i> <span style="margin-left: 10px;">PRODUCT CONDITION</span>
				</div>
				<hr>
				<?php if(!$isDropInStore){ ?>
				<div class="col-12" style="padding-left: 0;">
					<div class="form-row">
						<div class="form-group col-md-4">
							<div class="form-group row" style="text-align: center;">
								<label class="col-12 col-form-label"><b>FRONT VIEW</b></label>
								<div class="col-12 col-form-label">
									<?php if($data->serviceImage->service_image_front_view){ ?>
									<a href="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceImage->service_image_id; ?>/<?php echo $data->serviceImage->service_image_front_view ?>" target="_blank"><img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceImage->service_image_id; ?>/<?php echo $data->serviceImage->service_image_front_view ?>" /> </a>
									<?php } else { ?>
									<img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/img-default.jpg" /> 
									<?php } ?>
								</div>
							</div>   
						</div>
						<div class="form-group col-md-4">
							<div class="form-group row" style="text-align: center;">
								<label class="col-12 col-form-label"><b>LEFT VIEW</b></label>
								<div class="col-12 col-form-label">
									<?php if($data->serviceImage->service_image_left_view){ ?>
									<a href="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceImage->service_image_id; ?>/<?php echo $data->serviceImage->service_image_left_view ?>" target="_blank"><img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceImage->service_image_id; ?>/<?php echo $data->serviceImage->service_image_left_view ?>" /> </a>
									<?php } else { ?>
									<img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/img-default.jpg" /> 
									<?php } ?>
								</div>
							</div>   
						</div>
						<div class="form-group col-md-4">
							<div class="form-group row" style="text-align: center;">
								<label class="col-12 col-form-label"><b>RIGHT VIEW</b></label>
								<div class="col-12 col-form-label">
									<?php if($data->serviceImage->service_image_right_view){ ?>
									<a href="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceImage->service_image_id; ?>/<?php echo $data->serviceImage->service_image_right_view ?>" target="_blank"><img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceImage->service_image_id; ?>/<?php echo $data->serviceImage->service_image_right_view ?>" /> </a>
									<?php } else { ?>
									<img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/img-default.jpg" /> 
									<?php } ?>
								</div>
							</div>   
						</div>
						<div class="form-group col-md-4">
							<div class="form-group row" style="text-align: center;">
								<label class="col-12 col-form-label"><b>TOP VIEW</b></label>
								<div class="col-12 col-form-label">
									<?php if($data->serviceImage->service_image_top_view){ ?>
									<a href="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceImage->service_image_id; ?>/<?php echo $data->serviceImage->service_image_top_view ?>" target="_blank"><img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceImage->service_image_id; ?>/<?php echo $data->serviceImage->service_image_top_view ?>" /> </a>
									<?php } else { ?>
									<img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/img-default.jpg" /> 
									<?php } ?>
								</div>
							</div>   
						</div>
						<div class="form-group col-md-4">
							<div class="form-group row" style="text-align: center;">
								<label class="col-12 col-form-label"><b>BOTTOM VIEW</b></label>
								<div class="col-12 col-form-label">
									<?php if($data->serviceImage->service_image_bottom_view){ ?>
									<a href="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceImage->service_image_id; ?>/<?php echo $data->serviceImage->service_image_bottom_view ?>" target="_blank"><img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceImage->service_image_id; ?>/<?php echo $data->serviceImage->service_image_bottom_view ?>" /> </a>
									<?php } else { ?>
									<img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/img-default.jpg" /> 
									<?php } ?>
								</div>
							</div>   
						</div>
						<div class="form-group col-md-4">
							<div class="form-group row" style="text-align: center;">
								<label class="col-12 col-form-label"><b>BACK VIEW</b></label>
								<div class="col-12 col-form-label">
									<?php if($data->serviceImage->service_image_back_view){ ?>
									<a href="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceImage->service_image_id; ?>/<?php echo $data->serviceImage->service_image_back_view ?>" target="_blank"><img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceImage->service_image_id; ?>/<?php echo $data->serviceImage->service_image_back_view ?>" /> </a>
									<?php } else { ?>
									<img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/img-default.jpg" /> 
									<?php } ?>
								</div>
							</div>   
						</div>
					</div>
				</div>
				<?php } else { ?>
				<div class="col-12" style="padding-left: 0;">
					<div class="form-row">
						<div class="form-group col-md-12">
							<div class="form-group row">
								<label class="col-5 col-form-label"><b>Product Condition Notes</b></label>
								<div class="col-7 col-form-label" style="padding-right: 0;">
									<span><?php echo $data->product_condition_notes; ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-wrench"></i> <span style="margin-left: 10px;">SERVICE INFORMATION</span>
				</div>
				<hr>
				<div class="col-12" style="padding-left: 0;">
					<div class="form-row">
						<div class="form-group col-md-12">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Service List</b></label>
								<div class="col-8 col-form-label" style="padding-right: 0;">
									<?php $serviceList = ServiceDetail::findAll(["service_id" => $data->service_id]); ?>
									<?php if(count($serviceList) > 0){ ?>
									<ul>
									<?php foreach($serviceList as $row){ ?>
									<li>
										<?php echo $row->serviceTypeStore->serviceType->service_type_name; ?> <?php echo $row->serviceTypeStore->serviceType->service_type_id == 11 ? "(".$row->service_other_text.")" : ""; ?> <br/>
									</li>
									<br>
									<?php } ?>
									</ul>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/view/<?php echo $data->service_id; ?>">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Service Fee</b></label>
								<div class="col-6 col-form-label" style="padding-right: 0;">
									<input type="text" name="service_fee" class="form-control" <?php echo $data->serviceHistory->serviceStateLang->template == 'completed_by_service_center' ? "" : "disabled"; ?> value="<?php echo $data->service_fee; ?>" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Service Fee Unique Code</b></label>
								<div class="col-6 col-form-label" style="padding-right: 0;">
									<?php echo $data->service_fee_unique_code; ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Service Notes</b></label>
								<div class="col-6 col-form-label" style="padding-right: 0;">
									<textarea class="form-control" rows="5" name="sc_notes" <?php echo $data->serviceHistory->serviceStateLang->template == 'completed_by_service_center' ? "" : "disabled"; ?>><?php echo $data->sc_notes; ?></textarea>
								</div>
							</div>
							<div class="hidden-print" style="margin-top: 50px;">
								<div class="text-right">
									<button type="submit" class="btn btn-gradient waves-light waves-effect w-md" <?php echo $data->serviceHistory->serviceStateLang->template == 'completed_by_service_center' ? "" : "disabled"; ?>>Update</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-sm-5">
			<div class="card m-b-30 card-body">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-truck"></i> <span style="margin-left: 10px;">SHIPPING INFORMATION</span>
				</div>
				<hr>
				<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/updatereturnmethod/<?php echo $data->service_id; ?>">
				<div class="col-12" style="padding-left: 0;">
					<div class="form-row">
						<div class="form-group col-md-12">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Drop Location</b></label>
								<div class="col-8 col-form-label" style="padding-right: 0;">
								    <select onChange="dropLocationSelect()" class="form-control" id="drop_location" name="drop_location">

										<option value="store" <?php echo $data->sc_drop_store_id != 0 ? "selected" : ""; ?>>Drop In Store</option>
										<option value="direct" <?php echo $data->sc_drop_address != "" ? "selected" : ""; ?>>Direct To Customer</option>

									</select>
								
								</div>
							</div>
							<div class="form-group row drop-store" style="<?php echo $data->sc_drop_store_id != 0 ? "display:flex;" : "display:none;"; ?>">
								<label class="col-4 col-form-label"><b>Store</b></label>
								<div class="col-8 col-form-label" style="padding-right: 0;">
								
										<?php if(count($storesModel) > 0){ ?>
    									<select name="store_id" class="form-control drop-store">
    									<option value="0">PLEASE SELECT</option>
    									<?php foreach($storesModel as $row){ ?>
    									<option <?php echo $row->store_id == $data->sc_drop_store_id ? "selected" : ""; ?> value="<?php echo $row->store_id; ?>"><?php echo $row->store_name . ' ' . $row->store_address; ?></option>
    									<?php } ?>
    									</select>
    									<?php } ?>
								
								</div>
							</div>
							<div class="form-group row direct-customer" style="<?php echo $data->sc_drop_address != "" ? "display:flex;" : "display:none;"; ?>">
								<label class="col-4 col-form-label"><b>Address</b></label>
								<div class="col-8 col-form-label" style="padding-right: 0;">

									    <textarea class="form-control direct-customer" rows="5" name="sc_drop_address"><?php echo $data->sc_drop_address; ?></textarea>
										
									
								</div>
							</div>
						
							<div class="form-group row direct-customer" style="<?php echo $data->sc_drop_address != "" ? "display:flex;" : "display:none;"; ?>">
								<label class="col-4 col-form-label"><b>Telp</b></label>
								<div class="col-8 col-form-label" style="padding-right: 0;">
									<input type="text" name="sc_drop_telp" class="form-control" value="<?php echo $data->sc_drop_telp; ?>" />
								
								</div>
							</div>
							<div class="form-group row direct-customer" style="<?php echo $data->sc_drop_address != "" ? "display:flex;" : "display:none;"; ?>">
								<label class="col-4 col-form-label"><b>Name</b></label>
								<div class="col-8 col-form-label" style="padding-right: 0;">
									<input type="text" name="sc_drop_name" class="form-control" value="<?php echo $data->sc_drop_name; ?>" />
								
								</div>
							</div>
					
						</div>
					</div>
				</div>
				<div class="hidden-print" style="margin-top: 10px;">
					<div class="text-right">
						<button type="submit" class="btn btn-gradient waves-light waves-effect w-md">Update</button>
					</div>
				</div>
				</form>  
				<hr>
				<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/updateresiservice/<?php echo $data->service_id; ?>">
				<div class="col-12" style="padding-left: 0;">
					<div class="form-row">
						<div class="form-group col-md-12">
							<div class="form-group row">
								<label class="col-5 col-form-label"><b>Shipping Carrier</b></label>
								<div class="col-7 col-form-label" style="padding-right: 0;">
									<select onChange="scShippingCarrierSelect()" class="form-control" id="sc_shipping_carrier" name="sc_shipping_carrier" <?php echo $data->serviceHistory->serviceStateLang->template == 'shipped_by_service_center_direct_to_customer' || $data->serviceHistory->serviceStateLang->template == 'shipped_by_service_center_to_store' ? "" : "disabled"; ?>>
										<option value="">Please Select</option>
										<option value="JNE" <?php echo $data->sc_shipping_carrier == "JNE" ? "selected" : "" ; ?>>JNE</option>
										<option value="NCS" <?php echo $data->sc_shipping_carrier == "NCS" ? "selected" : "" ; ?>>NCS</option>
										<option value="GOJEK" <?php echo $data->sc_shipping_carrier == "GOJEK" ? "selected" : "" ; ?>>GOJEK</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" id="shipping-type" style="margin-bottom: 0.5rem;<?php echo $data->sc_shipping_carrier == "JNE" ? "" : "display: none;" ; ?>">
							<div class="form-group row">
								<label class="col-5 col-form-label"><b>Shipping Type</b></label>
								<div class="col-7 col-form-label" style="padding-right: 0;">
									<select id="sc_shipping_type" class="form-control" name="sc_shipping_type">
										<option value="">Please Select</option>
										<option value="YES" <?php echo $data->sc_shipping_type == "YES" ? "selected" : "" ; ?>>YES</option>
										<option value="REG" <?php echo $data->sc_shipping_type == "REG" ? "selected" : "" ; ?>>REGULER</option>
									
									</select>
								</div>
							</div> 
						</div>
						<div class="form-group col-md-12">
							<div class="form-group row" id="sc-non-gojek" <?php echo $data->sc_shipping_carrier == "GOJEK" ? "style='display: none;'" : "" ; ?>>
								<label class="col-5 col-form-label"><b>Tracking Number</b></label>
								<div class="col-7 col-form-label" style="padding-right: 0;">
									<input type="text" <?php echo $data->serviceHistory->serviceStateLang->template == 'shipped_by_service_center_direct_to_customer' || $data->serviceHistory->serviceStateLang->template == 'shipped_by_service_center_to_store' ? "" : "disabled"; ?> value="<?php echo $data->sc_tracking_number; ?>" name="sc_tracking_number" class="form-control" />
								</div>
							</div>
							<div class="form-group row" id="sc-gojek-1" <?php echo $data->sc_shipping_carrier == "GOJEK" ? "" : "style='display: none;'" ; ?>>
								<label class="col-5 col-form-label"><b>Driver Name</b></label>
								<div class="col-7 col-form-label" style="padding-right: 0;">
									<input type="text" value="<?php echo $data->sc_driver_name; ?>" name="sc_driver_name" class="form-control" />
								</div>
							</div>
							<div class="form-group row" id="sc-gojek-2" <?php echo $data->sc_shipping_carrier == "GOJEK" ? "" : "style='display: none;'" ; ?>>
								<label class="col-5 col-form-label"><b>Driver Number</b></label>
								<div class="col-7 col-form-label" style="padding-right: 0;">
									<input type="text" value="<?php echo $data->sc_driver_number; ?>" name="sc_driver_number" class="form-control" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="hidden-print" style="margin-top: 10px;">
					<div class="text-right">
						<button type="submit" class="btn btn-gradient waves-light waves-effect w-md" <?php echo $data->serviceHistory->serviceStateLang->template == 'shipped_by_service_center_direct_to_customer' || $data->serviceHistory->serviceStateLang->template == 'shipped_by_service_center_to_store' ? "" : "disabled"; ?>>Update</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- end row -->
	
	<div class="row">
		<div class="col-12">
			<div class="card m-b-30 card-body">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-user" style="margin-top: 10px;"></i> <span style="margin-left: 10px;">ORDER DETAIL (<?php echo strtoupper($data->orders->reference); ?>)</span>
				</div>
				<hr>
				<div class="col-12" style="padding-left: 0;">
					<div class="form-row">
						<div class="form-group col-md-6">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Purchase Date</b></label>
								<div class="col-8 col-form-label">
									<?php echo date_format(date_create($data->orders->date_add), 'j F Y g:i A'); ?>
								</div>
							</div>   
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Invoice Number</b></label>
								<div class="col-8 col-form-label">
									<?php echo $data->orders->reference; ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Purchase Store</b></label>
								<div class="col-8 col-form-label">
									<b><?php echo $data->orders->stores->store_name . ' - ' . $data->orders->stores->store_location; ?></b> <br><hr>
									<?php echo $data->orders->stores->store_address; ?>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Store Claim</b></label>
								<div class="col-8 col-form-label">
									<b><?php echo $data->serviceDetail->serviceDropStore->store_name . ' - ' . $data->serviceDetail->serviceDropStore->store_location; ?></b> <br><hr>
									<?php echo $data->serviceDetail->serviceDropStore->store_address; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12" style="padding-left: 0; padding-right: 0;">
					<div class="table-responsive">
						<table class="table mt-4">
							<thead>
								<tr>
									<th width=10%>Image</th>
									<th width=25%>Item</th>
									<th width=15% style="text-align: center;">Warranty Number</th>
									<th width=5%>Quantity</th>
									<th width=20%>Unit Price</th>
									<th width=20%>Total</th>
								</tr>
							</thead>
							<tbody id="product-body-data">
								<?php 
									$orderDetailModel = OrderDetail::find()->where(['orders_id' => $data->orders_id])->all(); 
									$subTotal = 0;
									$color = '';
									if(count($orderDetailModel) > 0){
										foreach($orderDetailModel as $product){
											$productimage = ProductImage::find()->where(['product_id' => $product->product_id, 'cover' => 1])->one();
											$subTotal += ($product->original_product_price * $product->product_quantity);
											
											$attributes_id = ProductAttribute::find()->where(['product_id' => $product->product_id])->all();
				
											if(count($attributes_id) != 0){
												foreach ($attributes_id as $row_id) {
													$combination_id = ProductAttributeCombination::find()->where(['product_attribute_id' => $row_id['product_attribute_id'], 'attribute_id'=>6])->one();
													$color = AttributeValue::find()->where(['attribute_value_id'=>$combination_id->attribute_value_id])->one();
													
													$color = $color->value;
												}
											}
								?>
									<tr>
										<td width="10%">
											<img src="https://www.thewatch.co/img/product/<?php echo $productimage->product_image_id; ?>/<?php echo $productimage->product_image_id; ?>_small.jpg" class="img-responsive" />
										</td>
										<td width="35%">
											<span class="pull-left"><?php echo $product->product_name . ' ' . $color; ?></span>
										</td>
										<td width="15%" align="center">
											<span><?php echo $product->orderDetailWarranty->warranty->warranty_number; ?></span>
										</td>
										<td width="5%" align="center">
											<span class="center"><?php echo $product->product_quantity; ?></span>
										</td>
										<td width="20%">
											<span>IDR</span>
											<span id="unit-price-1" class="pull-right"><?php echo Helpers::getPriceFormat($product->original_product_price); ?></span>
										</td>
										<td width="25%">
											<span>IDR</span>
											<span id="unit-price-1" class="pull-right"><?php echo Helpers::getPriceFormat($product->original_product_price * $product->product_quantity); ?></span>
										</td>
									</tr>
										<?php } ?>
									<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php if(Yii::$app->session->get('userInfo')['departement'] != 9){ ?>
	<div class="row">
		<div class="col-12">
			<div class="card-box">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-user" style="margin-top: 10px;"></i> <span style="margin-left: 10px;">ACTIVITY LOG</span>
				</div>
				<hr>
				<?php 
				$logModel = Log::find()->orderBy("id DESC")->where(["module" => Yii::$app->controller->id, "id_onChanged" => $data->service_id])->all(); 
				$currentDate = '';
				$i = 1;
				?>
				<?php if(count($logModel) > 0){ ?>
				<div class="timeline">
					<?php foreach($logModel as $row){ ?>
					<?php
						$date = date_create($row->date_time);
						$date_formated = date_format($date, 'l, d F Y');
					?>
					<?php if($date_formated != $currentDate){ ?>
					<article class="timeline-item alt">
						<div class="text-right">
							<div class="time-show first">
								<a href="#" class="btn btn-gradient w-lg"><?php echo $date_formated; ?></a>
							</div>
						</div>
					</article>
					<?php } ?>
					<article class="timeline-item <?php echo $i % 2 == 0 ? "alt" : ""; ?>">
						<div class="timeline-desk">
							<div class="panel">
								<div class="timeline-box">
									<span class="arrow-alt"></span>
									<span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
									<h4 class=""><?php echo $row->fullname; ?></h4>
									<p class="timeline-date text-muted"><small><?php echo date_format($date, 'g:ia'); ?></small></p>
									<p><?php echo $row->action_text; ?></p>
								</div>
							</div>
						</div>
					</article>
					<?php $currentDate = $date_formated; $i++; ?>
					<?php } ?>
				</div>
				<?php } else { ?>
				<div class="timeline" style="text-align: center;margin-top: 70px;">
					<span style="text-align: center;">NO ACTIVITY</span>
				</div>
				<?php } ?>
				<!-- end timeline -->
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<script>
function storeShippingCarrierSelect(){
	var shippingCarrier = document.getElementById("store_shipping_carrier").value;
	if(shippingCarrier == "GOJEK"){
		$("#store-gojek-1").css("display", "");
		$("#store-gojek-2").css("display", "");
		$("#store-non-gojek").css("display", "none");
		
	} else {
		$("#store-gojek-1").css("display", "none");
		$("#store-gojek-2").css("display", "none");
		$("#store-non-gojek").css("display", "");
		
		
	}
	
}

function scShippingCarrierSelect(){
	var shippingCarrier = document.getElementById("sc_shipping_carrier").value;
	if(shippingCarrier == "GOJEK"){
		$("#sc-gojek-1").css("display", "");
		$("#sc-gojek-2").css("display", "");
		$("#sc-non-gojek").css("display", "none");
	} else {
		$("#sc-gojek-1").css("display", "none");
		$("#sc-gojek-2").css("display", "none");
		$("#sc-non-gojek").css("display", "");
		
		if(shippingCarrier == "JNE"){
		    $("div#shipping-type").css("display", "");
		}
	}
}

function dropLocationSelect(){
	var drop = document.getElementById("drop_location").value;
	if(drop == "store"){
		$(".drop-store").css("display", "flex");
		$(".direct-customer").css("display", "none");
	} else {
		$(".drop-store").css("display", "none");
		$(".direct-customer").css("display", "flex");
		
	}
}

function stateLangSelect(){
	var drop = document.getElementById("service_state_lang_id").value;
	if(drop == "5" || drop == "6"){
	    $('#showPicStatus').modal({
            backdrop: 'static',
            keyboard: false  // to prevent closing with Esc button (if you want this too)
        });
		$('#showPicStatus').modal('show');
		$('input[name="pic_state_lang_id"]').val(drop);
	} else {
		
	}
}
</script>