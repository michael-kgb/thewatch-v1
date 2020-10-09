<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Homebanner */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content-header">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-left">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#information" data-toggle="tab">Information</a></li>
                    
                </ul>
				<div class="tab-content">
					
                    <div class="tab-pane active" id="information">
                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                        <div class="box-body">
							
                            <?php if ($model->timex_ig_img != '') { ?>
                                <div class="form-group" style="padding: 2% 0 3% 0;">
                                    <label for="inputEmail3" class="col-lg-2 control-label">Existing Images : </label>
                                    <div class="col-lg-10">
                                        <img width="50%" height="50%" src="<?php echo Yii::$app->urlManager->getBaseUrl() . Yii::$app->params['brandAsset'] . $model->timex_ig_img; ?>">
                                    </div>
                                </div> 
                            <?php } ?>  

                            <div class="form-group">
                                <?= $form->field($model, 'timex_ig_img')->fileInput(); ?>
                            </div>

                            
							<div class="clearfix"></div>
							<div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="TimexIg[timex_ig_link]" id="inputEmail3" placeholder="http://" required="true" value="<?php echo $model->timex_ig_link; ?>">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            
                            <div class="clearfix"></div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-4">
                                    <select id="kota" class="form-control kota" name="TimexIg[timex_ig_status]">
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
								<div class="col-sm-1" style="margin-top: 5%; margin-left: 4%;">
									<button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
										<i class="fa fa-close"></i> Cancel
									</button>
								</div>
								<div class="col-sm-1" style="margin-top: 5%; float: right;">
									<button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
										<i class="fa fa-save"></i> Save & Next
									</button>
								</div>
							</div>
						</div>
                        <?php ActiveForm::end(); ?>
					</div>
                   
					
					
				</div>
            </div><!-- /tabbable -->
        </div><!-- /col -->
    </div><!-- /row -->
</section>