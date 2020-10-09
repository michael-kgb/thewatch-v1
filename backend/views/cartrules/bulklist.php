<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Bulk Voucher Code List
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Price Rule</a></li>
        <li><a href="#">Cart Rule</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="box box-info">
                <div class="box-header">
                    <b>Information</b>
                </div>
                <div class="box-body">
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Voucher List :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php 
							$cartRules = \backend\models\CartRule::find()->where(['LIKE', 'description', '%'.$_GET['name'].'%', false])->all();
							$cartRule = \backend\models\CartRule::find()->where(['LIKE', 'description', '%'.$_GET['name'].'%', false])->one(); 							
							if(count($cartRules) > 0){
								foreach($cartRules as $cart){
									echo $cart->code . '<br>';
								}
							}
						?>
						
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
		
		<div class="col-lg-6">
            <div class="box box-info">
                <div class="box-header">
                    <b>Conditions</b>
                </div>
                <div class="box-body">
                    <div class="col-sm-5" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Apply a discount :</b>
                        </div>
                    </div>
					<div class="col-sm-7">
                        <?php 
							if($cartRule != NULL){
								if($cartRule->reduction_percent != 0){
									echo $cartRule->reduction_percent . ' %';
								}
								else if($cartRule->reduction_amount != 0){
									echo 'Rp. ' . \common\components\Helpers::getPriceFormat($cartRule->reduction_amount);
								}
								else{
									echo '0';
								}
							}
						?>
                    </div>
					<div class="clearfix"></div>
					<div class="col-sm-5" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Status :</b>
                        </div>
                    </div>
					<div class="col-sm-7">
					<?php 
						if($cartRule != NULL){
							echo $cartRule->active == 1 ? 'Active' : 'Inactive'; 
						}
					?>
					</div>
					<div class="clearfix"></div>
					<div class="col-sm-5" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Valid from :</b>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <?php echo date_format(date_create($cartRule->date_from), 'j F Y g:i A'); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-5" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Valid to :</b>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <?php echo date_format(date_create($cartRule->date_to), 'j F Y g:i A'); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-5" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Minimum Amount :</b>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <?php echo common\components\Helpers::getPriceFormat($cartRule->minimum_amount); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-5" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Total Available :</b>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <?php echo $cartRule->quantity; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-5" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Total Available for Each User :</b>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <?php echo $cartRule->quantity_per_user; ?>
                    </div>
				</div>
			</div>
		</div>
    </div>
</section>