<?php 
use backend\models\Warranty;
use common\components\Helpers;
?>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Warranty Generate List</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/warranty">Warranty</a></li>
					<li class="breadcrumb-item"><a href="#">Warranty Generate List</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->


	<div class="row">
		<div class="col-md-12">
			<div class="card-box">
				<div class="row">
					<div class="col-12">
						<div class="col-12 pull-left mt-3">
							<div class="form-group row">
								<label class="col-2 col-form-label">Warranty List :</label>
								<div class="col-10 mt-2">
									<?php  
										$cartRules = Warranty::find()->where(['warranty_description' => $_GET['bulkname']])->all();
										$cartRule = Warranty::find()->where(['warranty_description' => $_GET['bulkname']])->one(); 							
										if(count($cartRules) > 0){
											foreach($cartRules as $cart){
												echo $cart->warranty_code . '<br>';
											}
										}
									?>
								</div>
							</div>
						</div>
						<a class="btn btn-info waves-effect waves-light" href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/warranty/export?data=<?php echo $_GET['bulkname'];?>"> <i class="fa fa-cart-plus m-r-5"></i> <span>Export</span> </a>
					</div><!-- end col -->
					
				</div>
				<!-- end row -->
			</div>
		</div>

	</div>
	<!-- end row -->

</div>