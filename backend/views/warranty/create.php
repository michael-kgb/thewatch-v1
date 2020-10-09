<?php 
use backend\models\Stores;
use backend\models\WarrantyType;
?>
<script>

</script>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Create New Warranty</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/warranty">Warranty</a></li>
					<li class="breadcrumb-item"><a href="#">Add New</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->


	<div class="row">
		<div class="col-md-12">
			<div class="card-box">
				<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/warranty/create">
				<div class="row">
					<div class="col-12">
						<div class="pull-left mt-3 col-12">
							<div class="form-group row">
								<div class="col-2">
									<label class="col-form-label">Warranty Type :</label>
								</div>
								<div class="col-10">
									<?php 
										$warrantyTypes = WarrantyType::findAll(["warranty_type_status" => 1]); 
										
										if(count($warrantyTypes) > 0){
									?>
										
										<select name="warranty_type_id" class="form-control">
										
									<?php foreach($warrantyTypes as $type){ ?>
										
										<option value="<?php echo $type->warranty_type_id; ?>"><?php echo $type->warranty_type_name; ?></option>
										
									<?php } ?>
										
										</select>
									<?php } ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-2 col-form-label">Quantity :</label>
								<div class="col-10">
									<input type="number" class="form-control" name="total_warranty" value="1" min="1" />
								</div>
							</div>
						</div>

					</div><!-- end col -->
				</div>
				
				<div class="hidden-print mt-4 mb-4">
					<div class="text-right">
						<button class="btn btn-info waves-effect waves-light" type="submit">Generate</button
					</div>
				</div>
				<!-- end row -->
			</div>
			</form>
		</div>

	</div>
	<!-- end row -->

</div>