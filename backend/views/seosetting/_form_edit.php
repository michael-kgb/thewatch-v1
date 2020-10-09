<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Homebanner */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                <div class="box-body">
                  
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2"> 
                            <label for="inputEmail3" class="control-label pull-right">
                                Page
                            </label>
                        </div>
                        <div class="col-sm-10">
                            <select class="form-control" name="Seosetting[seo_pages_id]">
                                <?php 
                                $seoPages = \backend\models\SeoPages::findAll(['seo_pages_status' => 1]); 
                                
                                if(count($seoPages) > 0){
                                    foreach($seoPages as $data){
                                ?>
                                <option value="<?php echo $data->seo_pages_id; ?>" <?php echo $data->seo_pages_id == $model->seo_pages_id ? "selected" : ""; ?>><?php echo $data->seo_pages_name; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
					
					<div class="form-group" id="brand-list-seo" style="padding: 2% 0 4% 0; <?php echo $model->seo_pages_id == 2 ? 'display: block;' : 'display: none;'; ?>">
						<div class="col-sm-2"> 

                            <label for="inputEmail3" class="control-label pull-right">

                                Brand

                            </label>

                        </div>
						<div class="col-sm-10">
							<select class="form-control" id="product-brands_brand_id" name="SeoPagesContentBrands[brand_id]">
								<option value="0">Please select</option>
								<?php
								$brands = backend\models\Brands::find()->orderBy('brand_name')->all();
								$seoPagesContentBrand = \backend\models\SeoPagesContentBrands::findOne(['seo_pages_content_id' => $model->seo_pages_content_id]);
								if($seoPagesContentBrand != NULL){
									$brandId = $seoPagesContentBrand->brands->brand_id;
								}
								foreach ($brands as $row) {
									?>
									<option value="<?php echo $row->brand_id; ?>" <?php echo $brandId == $row->brand_id ? "selected" : ""; ?>><?php echo $row->brand_name; ?></option>
									<?php
								}
								?>
							</select>
						</div>
					</div>
                    
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">
                                Meta Title
                            </label>
                        </div>
                        <div class="col-sm-10">
                            <textarea id="meta_title" name="Seosetting[seo_pages_meta_title]" rows="10" cols="80">
                            <?php echo $model->seo_pages_meta_title; ?>
                            </textarea>
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2" style="margin-top: 2%;">
                            <label for="inputEmail3" class="control-label pull-right">
                                Meta Description
                            </label>
                        </div>
                        <div class="col-sm-10" style="margin-top: 2%;">
                            <textarea id="meta_description" name="Seosetting[seo_pages_meta_description]" rows="10" cols="80">
                            <?php echo $model->seo_pages_meta_description; ?>
                            </textarea>
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2" style="margin-top: 2%;">
                            <label for="inputEmail3" class="control-label pull-right">
                                Meta Keywords
                            </label>
                        </div>
                        <div class="col-sm-10" style="margin-top: 2%;">
                            <textarea id="meta_keywords" name="Seosetting[seo_pages_meta_keywords]" rows="10" cols="80">
                            <?php echo $model->seo_pages_meta_keywords; ?>
                            </textarea>
                        </div>
                    </div>
					
					<div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2" style="margin-top: 2%;">
                            <label for="inputEmail3" class="control-label pull-right">
                                SEO Footer Description Left
                            </label>
                        </div>
                        <div class="col-sm-10" style="margin-top: 2%;">
                            <textarea id="seo_footer_description_left" name="Seosetting[seo_footer_description_left]" rows="10" cols="80">
                            <?php echo $model->seo_footer_description_left; ?>
                            </textarea>
                        </div>
                    </div>
					
					<div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2" style="margin-top: 2%;">
                            <label for="inputEmail3" class="control-label pull-right">
                                SEO Footer Description Right
                            </label>
                        </div>
                        <div class="col-sm-10" style="margin-top: 2%;">
                            <textarea id="seo_footer_description_right" name="Seosetting[seo_footer_description_right]" rows="10" cols="80">
                            <?php echo $model->seo_footer_description_right; ?>
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-12" style="margin-bottom: 2%; margin-top: 3%;">
                            <button class="btn btn-default pull-right"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                  
                </div>
            <?php ActiveForm::end(); ?>
          </div>
        </div>
    </div>
</section>
