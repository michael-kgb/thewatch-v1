<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Update Payment Store
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
    <li><a href="#">Stores</a></li>
  </ol>
</section>
<section class="content-header">
    <div class="row">
        <div class="col-lg-12">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Related Payment</label>
                                <div class="col-sm-10">
                                    <?php $payments = \backend\models\Payment::find()->all(); ?>
                                    <?php $payments_check = \backend\models\PaymentMethodDetail::find()->where(['store_id'=>$id])->andWhere(['payment_method_id'=>7])->all(); ?>
                                    <?php //print_r($payments_check);?>
                                    <select id="prod-select2" multiple class="form-control kota" name="payment_id[]">
                                        <?php foreach ($payments as $payment) { ?>
                                            <?php $flag_check = 0; ?> 
                                            
                                            <?php foreach ($payments_check as $payment_check) { ?>
                                                <?php if($payment->payment_id == $payment_check->payment_id){ ?>
                                                <option value="<?php echo $payment->payment_id;?>" selected><?php echo $payment->name_bank;?></option>
                                                <?php 
                                                    $flag_check = 1;
                                                    break;
                                                    }
                                                ?>
                                            <?php } ?>
                                            
                                            <?php if($flag_check == 0){ ?>
                                                <option value="<?php echo $payment->payment_id;?>"><?php echo $payment->name_bank;?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                <div class="form-group">
						
								<div class="col-sm-1" style="margin-top: 5%; float: right;">
									<button type="submit" class="btn btn-default pull-right">
										<i class="fa fa-save"></i> Save
									</button>
								</div>
							</div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
