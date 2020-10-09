
                            
                                
                                    <div class="modal-body" style="padding-top: 15px;">
                                        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                                                          
                                                          <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
                                                            Tambahkan Ulasan
                                                          </span>
                                                     
                                                          
                                                        </div>
                                                        
                                      </div>
                                  <div class="modal-body title-warranty" style="display: table-row;margin-top:10px;padding-top:5px;">
                                    <hr style="margin-top: 5px;margin-bottom: 10px;border-top:1px solid rgb(128,128,128);margin-left:15px;margin-right:15px;">
                                   
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height:500px;overflow-y:scroll;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top:30px;padding-bottom:20px;">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/done.PNG" style="width:94px;display:block;margin:auto;padding-bottom:5px;">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-medium fcolor69" style="font-size:20px;text-align:center;">
                                                Terimakasih telah melakukan konfirmasi penerimanaan produk
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="text-align:center;padding-bottom:10px;">
                                                <a class="gotham-light title-warranty blue-round" data-toggle="collapse" href="#collapseCard" role="button" aria-expanded="false" aria-controls="collapseExample" style="padding:2px;width:100%;">
                                                    Lihat Detail Kartu <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-white.png">
                                                </a>
                                            </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light box-shadow" style="border-radius: 5px;">
                                            
                                            <div class="collapse" id="collapseCard">
                	                		    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 clearleft clearright clearleft-mobile clearright-mobile card-left" style="padding-top: 15px;">
                	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                	                				
                	                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
                	                					Kartu Garansi Digital
                	                				</span>
                	                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty">
                	                					<?php echo $service->serviceDetail->orderDetailWarranty->warranty->warranty_number; ?>
                	                					
                	                				</span>
                	                			</div>
                	                			
                	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;">
                	                				<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
                	                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 23px;">
                	                				</span>
                	                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile title-warranty">
                	                				<?php echo $service->serviceDetail->serviceDropStore->store_name . ' ' . $service->serviceDetail->serviceDropStore->store_slug; ?>
                	                				</span>
                	                			</div>
                	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
                	                				<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
                	                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/invoice.png" style="width: 21px;margin-left: 2px;">
                	                				</span>
                	                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile title-warranty">
                	                					<?php echo $service->serviceDetail->orderDetailWarranty->warranty->warranty_number; ?>
                	                					
                	                				</span>
                	                			</div>
                	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
                	                				<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
                	                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/watch.png" style="width: 17px;margin-left: 4px;">
                	                				</span>
                	                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile title-warranty">
                	                					<?php echo $service->serviceDetail->orderDetailWarranty->orderDetail->product_name; ?>
                	                				</span>
                	                			</div>
                	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
                	                				<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
                	                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/warranty-type.png" style="width: 22px;">
                	                				</span>
                	                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile title-warranty">
                	                					Garansi <?php echo $service->serviceDetail->orderDetailWarranty->warranty->warrantyType->warranty_type_name; ?>
                	                				</span>
                	                			</div>
                	                			
                	                		</div>
                	           
                	                		    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 clearleft clearright clearleft-mobile clearright-mobile card-right" style="padding-top: 15px;">
                	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                	                			    <?php $product_image = \backend\models\ProductImage::find()->where(['product_id'=>$service->serviceDetail->orderDetailWarranty->orderDetail->product_id])->andWhere(['cover'=>1])->one(); ?>
                	                		
                	                				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product_image->product_image_id;?>/<?php echo $product_image->product_image_id;?>_medium.jpg" style="width: 100%;border-radius: 5px;">
                	                			</div>
                
                	                			
                	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium text-warranty box-shadow-smooth" style="text-align: center;background-color: #fff;margin-top: 10px;border-radius: 2px;">
                	                				Sisa Waktu Garansi
                	                			</div>
                	                			
                	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile fcolor69" style="font-size: 22px;text-align: center;margin-top: 3px;font-family:gotham-white;">
                                                    <?php 												
                                                    $now = new DateTime();												
                                                    $ref = new DateTime($service->serviceDetail->orderDetailWarranty->warranty->warranty_expired_date);												
                                                    $diff = $now->diff($ref);												
                                                    $different = $diff->format("%r%a");												
                                                    ?>
                	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 4px;">
                	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth" style="background-color: #fff;border-radius: 5px 5px 0 0;">
                	                						
                	                						<?php
                	                							if($different < 0){
                	                								echo '0';
                	                							} else{
                	                								echo str_pad($diff->y, 2, '0', STR_PAD_LEFT);
                	                							}
                	                							
                	                						?>
                	                					</div>
                	                				</div>
                	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 2px;padding-left: 2px;">
                	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth" style="background-color: #fff;border-radius: 5px 5px 0 0;">
                	                					
                	                						<?php
                	                							if($different < 0){
                	                								echo '0';
                	                							} else{
                	                								echo str_pad($diff->m, 2, '0', STR_PAD_LEFT);
                	                							}
                	                							
                	                						?>
                	                					</div>
                	                				</div>
                	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-left: 4px;">
                	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth" style="background-color: #fff;border-radius: 5px 5px 0 0;">
                	                					
                	                						<?php
                	                							if($different < 0){
                	                								echo '0';
                	                							} else{
                	                								echo str_pad($diff->d, 2, '0', STR_PAD_LEFT);
                	                							}
                	                							
                	                						?>
                	                					</div>
                	                				</div>
                	                			</div>
                	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="font-size: 12px;text-align: center;margin-top: 0px;">
                	                			    
                	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 4px;">
                                	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty bgcolorblue box-shadow-smooth fcolorfff" style="border-radius: 0 0 5px 5px;">
                                	                						Tahun
                                	                					</div>
                                	                				</div>
                                	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 2px;padding-left: 2px;">
                                	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty bgcolorblue box-shadow-smooth fcolorfff" style="border-radius: 0 0 5px 5px;">
                                	                						Bulan
                                	                					</div>
                                	                				</div>
                                	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-left: 4px;">
                                	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty bgcolorblue box-shadow-smooth fcolorfff" style="border-radius: 0 0 5px 5px;">
                                	                						Hari
                                	                					</div>
                                	                				</div>
                	                			</div>
                
                	                	
                	                			<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
                	                		</div>  
                	                	    </div>  
                	                	</div>
                	                	<?php
                	                	    $ratings = \backend\models\Question::find()->where(['questionnaire_id'=>2])->andWhere(['question_type'=>'rating'])->orderBy('question_order ASC')->all();
                                            $ulasans = \backend\models\Question::find()->where(['questionnaire_id'=>2])->andWhere(['question_type'=>'text'])->orderBy('question_order ASC')->all();
                	                	?>
                	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="padding-top: 20px;padding-bottom: 10px;">
                	                		    Rating service dengan mengisi kolom bintang
                	                		</div>
                	                		<form id="survei-button" method="POST" action="<?php echo \yii\helpers\Url::base(); ?>/warranty/surveiservice/<?php echo $service->service_id; ?>">
                	                		    <span id="error-rating" style="display:none;color:red;font-style:italic;"></span>
                    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-bottom: 10px;">
                    	                		    <?php foreach($ratings as $rating){ ?>
                    	                		    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile title-warranty">
                    	                		        <?php echo $rating->question_text; ?>
                    	                		    </div>
                    	                		    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
                    	                		        <div class='rating-stars text-center'>
                                                            <ul id='stars' class="stars-<?php echo $rating->question_id; ?>">
                                                              <li class='star' title='Poor' data-value='1' attrid='<?php echo $service->service_id; ?>' attrtype='<?php echo $rating->question_id; ?>'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                              </li>
                                                              <li class='star' title='Fair' data-value='2' attrid='<?php echo $service->service_id; ?>' attrtype='<?php echo $rating->question_id; ?>'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                              </li>
                                                              <li class='star' title='Good' data-value='3' attrid='<?php echo $service->service_id; ?>' attrtype='<?php echo $rating->question_id; ?>'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                              </li>
                                                              <li class='star' title='Excellent' data-value='4' attrid='<?php echo $service->service_id; ?>' attrtype='<?php echo $rating->question_id; ?>'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                              </li>
                                                             
                                                            </ul>
                                                      </div>
                    	                		    </div>
                    	                		    <input id="survei-<?php echo $rating->question_id; ?>-<?php echo $service->service_id; ?>" name="survei[<?php echo $rating->question_id; ?>]" type="hidden" class="<?php echo $rating->question_tag; ?>" value="0">
                    	                		    <?php } ?>
                    	                		  
                    	                		    <!-- Rating Stars Box -->
                                                      
                    	                		</div>
                	                		    <?php foreach($ulasans as $ulasan){ ?>
                	                		    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile title-warranty">
                	                		        <?php echo $ulasan->question_text; ?>
                    	                		</div>
                    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                    	                		    <textarea maxlength="150" name="survei[<?php echo $ulasan->question_id; ?>]" style="width: 100%;border: solid 1px rgb(32,97,103);border-radius: 5px;height: 104px;padding: 10px;" placeholder="maksimal 150 karakter"></textarea>
                    	                		</div>
                    	                		<?php } ?>
                    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                    	                		    <button class="blue-round" type="button" onclick="survei_validate(); return false;" style="width:100%;cursor: pointer;border-radius: 20px;padding: 7px;padding-left: 20px;padding-right: 20px;letter-spacing: 1.5px;pointer-event:none;">Selesai</button>
                    	                		    <!--<button type="submit" id="survei-button" style="display:none;"></button>-->
                    	                		</div>
                    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top:10px;"></div>
                	                		</form>
                	                	</div>
                                                              
                                    </div>
                                            
                            
                                  </div>
                                  
                                
                            

                              
                              <script>
    function survei_validate(){
        if($('input.kecepatan').val() == 0){
            $('span#error-rating').css('display','block');
            $('span#error-rating').html('Silahkan isi rating kecepatan');
        }
        if($('input.kerapihan').val() == 0){
            $('span#error-rating').css('display','block');
            $('span#error-rating').html('Silahkan isi rating kerapihan');
        }
        if($('input.kemudahan').val() == 0){
            $('span#error-rating').css('display','block');
            $('span#error-rating').html('Silahkan isi rating kemudahan');
        }
        
        if($('input.kecepatan').val() != 0 && $('input.kerapihan').val() != 0 && $('input.kemudahan').val() != 0){
            $('span#error-rating').css('display','none');
            $('form#survei-button').submit();
        }
    }
                                  // rating survei
$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */

  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    // id survei
    var survei_id = $(this).attr('attrid');
    
    // id question
    var survei_type = $(this).attr('attrtype');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('.stars-'+survei_type+' li.selected').last().data('value'), 10);
   
    responseMessage(survei_id,ratingValue,survei_type);
    
  });
  
  $('textarea').unbind('keyup change input paste').bind('keyup change input paste',function(e){
        var $this = $(this);
        var val = $this.val();
        var valLength = val.length;
        var maxCount = $this.attr('maxlength');
        if(valLength>maxCount){
            $this.val($this.val().substring(0,maxCount));
        }
    }); 
  
});


function responseMessage(survei_id,ratingValue,survei_type) {
//  console.log(survei_id+' '+ratingValue);
  $('#survei-'+survei_type+'-'+survei_id).val(ratingValue);
   $('span#error-rating').css('display','none');
    
}
</script>