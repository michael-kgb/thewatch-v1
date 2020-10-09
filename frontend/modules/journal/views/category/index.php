<?php
$this->title = 'The Watch Co. - Journal';
// 
?>

<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icon_top.png" class="scrollup"></a> 

<ul id="slider-content" style="display:none;">
  
  <?php
	$start = 0;  
	if (count($journalList) > 0) {

        foreach ($journalList as $journal) {
			$journalSelectedCategory = backend\models\JournalDetailCategory::find()->where(['journal_detail_id' => $journal->journalDetail->journal_detail_id])->all();
		if( $start < 3){
			
			
	?>
  <li>
	<a href="<?php echo \yii\helpers\Url::base(); ?>/journal/detail/<?php echo $journal->journalDetail->link_rewrite; ?>">
	  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/journal/<?php echo $journal->journal_id . '/small_cover_' . $journal->journalImage->journal_image_id . '.jpg'; ?>"
		alt="<div class='alt-category'>
						
						<?php
                        $j = 0;
                        foreach ($journalSelectedCategory as $row) {
                            $j++;
                            echo strtoupper($row->journalCategory->journal_category_name);
                            echo (count($journalSelectedCategory) == $j ? '' : ', ');
                        }
                        ?>
						
						 
				 <div class='alt-title'>
					
					<?= $journal->journalDetail->journal_detail_title ?>
					
				 </div>
					
					<a class='alt-read-more' href='<?php echo \yii\helpers\Url::base(); ?>/journal/detail/<?php echo $journal->journalDetail->link_rewrite; ?>'>
						<img src='<?php echo \yii\helpers\Url::base(); ?>/img/icons/read-more-desktop.png'  alt='read-more'/>
					</a>
				 
			 </div>">
			 
		
	</a>
  </li>
  <?php
		}
			
			$start++;
		}
   }
  ?>
</ul>

<section id="journal-list">
    <div class="container mid-container">
        <?php 
        $pa = 1;
        if(isset($_GET['page'])){
            $pa = $_GET['page'];
        }
    ?>
        
        <?php
        echo Yii::$app->view->renderFile('@app/modules/journal/views/default/breadcrumb.php', array("journalCategory" => $journalCategory));
        ?>
        <div class="journal-items">
            <?php 
            if (count($journalList) > 0) {

                foreach ($journalList as $journal) {
                    $journalSelectedCategory = backend\models\JournalDetailCategory::find()->where(['journal_detail_id' => $journal->journalDetail->journal_detail_id])->all();
            ?>
            <div class="journal-item">
                <div class="journal-item-img">
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/journal/<?php echo $journal->journal_id . '/small_cover_' . $journal->journalImage->journal_image_id . '.jpg'; ?>">
                </div>
                <div class="journal-item-content">
                    <div class="date-category">
                        <?php echo strtoupper((date_format(date_create($journal->journal_created_date), "j F Y"))) ?> / 
                        <?php
                        $j = 0;
                        foreach ($journalSelectedCategory as $row) {
                            $j++;
                            echo strtoupper($row->journalCategory->journal_category_name);
                            echo (count($journalSelectedCategory) == $j ? '' : ', ');
                        }
                        ?> 
                    </div>
                   
                    <div class="journal-item-title">
                        <?php echo strtoupper($journal->journalDetail->journal_detail_title); ?> 
                    </div>

                        <?php 
                        echo substr($journal->journalDetail->journal_detail_content1, 0, 90);
                        ?>
                        
                    
                    <a class="read-more" href="<?php echo \yii\helpers\Url::base(); ?>/journal/detail/<?php echo $journal->journalDetail->link_rewrite; ?>">
                        read more...
                    </a>
                </div>
                         
            </div>
            <?php
                }
            }
            ?>
        </div>

		<?php if(count($journalList1) >= $limit){ ?>
            <div class="" style="left:0;right:0;position: absolute;margin-top: 30px;"></div>
        <?php }?>

		<div class ="page-custom col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding text-to-right col-lg-offset-1 fright clearright">
            
            <?php
             include '../shared/page_number_minimal.php';
             ?>
            
            
        </div>
    </div>
</section>

<script>

window.onload = function() {
	
	$("#slider-content").css("display", "block");
	$(function() {
		$('#slider-content').slippry({

		  // general elements & wrapper
		  slippryWrapper: '<div class="sy-box jquery-demo" />', // wrapper to wrap everything, including pager
		  // options
		  adaptiveHeight: false, // height of the sliders adapts to current slide
		  useCSS: false, // true, false -> fallback to js if no browser support
		  autoHover: false,
		  transition: 'horizontal'
		});
	});
	
	setTimeout(function(){	
		
		let beforeItem = $(".show-before-slide");
		console.log(beforeItem.length)
		for(let a = 0; a < beforeItem.length; a++){
			console.log($(".show-before-slide")[a])
			$($(".show-before-slide")[a]).css("display", "none");
		}		

		let afterItem = $(".show-after-slide");
		for(let a = 0; a < beforeItem.length; a++){
			$($(".show-after-slide")[a]).css("display", "block");
		}	
	
	}, 3000);
}
  //

</script>
