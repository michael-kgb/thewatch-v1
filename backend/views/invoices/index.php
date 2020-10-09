<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Invoices 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Invoices</a></li>
        <li><a href="#">index</a></li>
    </ol>
</section>

<section class="content">
    <!-- Main content -->
    <section class="content">
        <div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Filter By Date</h3>
					</div>
						<form method="POST" action="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/invoices/download">
						<div class="box-body">
							<div class="row">
								<div class="col-sm-12" style="margin-top: 3%; margin-bottom: 3%;">
									<div class="col-sm-1 col-sm-offset-3" style="margin-bottom: 2%;">
										<label for="exampleInputEmail1">From</label>
									</div>
									<div class="col-sm-3">
										<div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
											<input type="text" class="form-control" placeholder="click to set date" id="from1" name="FromDateInvoice" value="<?php echo date("Y-m-d"); ?>">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="col-sm-1 col-sm-offset-3">
										<label for="exampleInputEmail1">To</label>
									</div>
									<div class="col-sm-3">
										<div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
											<input type="text" class="form-control" placeholder="click to set date" id="to2" name="ToDateInvoice" value="<?php echo date("Y-m-d");  ?>">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->

						<div class="box-footer">
							<button type="submit" class="btn btn-primary pull-right">Submit</button>
						</div>
						</form>
				</div>
			</div>
			
			<!--<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Filter By Order Status</h3>
					</div>
					
					<div class="box-body">
						<div class="row">
							<div class="col-sm-8 col-sm-offset-4">
								<label class="col-4 col-form-label"><b>Order Status</b></label>
								<?php $orderStatus = \backend\models\OrderStateLang::find()->where(["apps_language_id" => 1])->groupBy('template')->all(); ?>
								<?php if(count($orderStatus) > 0){ ?>
								<?php foreach($orderStatus as $row){ ?>
								<div class="col-8 col-form-label">
									<div class="checkbox checkbox-custom">
										<input name="order_state[<?php echo $row->order_state_lang_id; ?>]" id="<?php echo $row->order_state_lang_id; ?>" type="checkbox">
										<label for="<?php echo $row->order_state_lang_id; ?>">
											<?php echo $row->name; ?>										
										</label>
									</div>
								</div>
								<?php } ?>
								<?php } ?>
							</div>
						</div>
					</div>

					<div class="box-footer">
						<button type="submit" id="filterBtnProduct" class="btn btn-primary pull-right">Submit</button>
					</div>
				</div>
			</div>-->
		</div>
    </section><!-- /.content -->
</section>