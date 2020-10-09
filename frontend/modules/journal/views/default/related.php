<section id="journal-list">
    <div class="container">
        <div class="row journal-related-header" style="padding-bottom: 30px;">
            <div class="related-journal-caption">Lainnya</div>
        </div>
    </div>
    <div class="container related-items">
         <div class="row">
            <?php if (count($related) > 0) { ?>
                <?php
                foreach ($related as $journal) {
                    $journalSelectedCategory = backend\models\JournalDetailCategory::find()->where(['journal_detail_id' => $journal->journalDetail->journal_detail_id])->all();
                    ?>
                     
                        <a  href="<?php echo \yii\helpers\Url::base(); ?>/journal/detail/<?php echo $journal->journalDetail->link_rewrite; ?>">
                          
                                <div class="col-lg-3 col-md-3 col-sm-9 col-xs-9 remove-padding clearleft clearright">
                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/journal/<?php echo $journal->journal_id . '/small_cover_' . $journal->journalImage->journal_image_id . '.jpg'; ?>" class="img-responsive">
                                </div>
                                <div style="padding-left:12px;padding-right:12px;padding-top:0;" 									class="col-lg-5 col-md-5 col-sm-12 col-xs-12 remove-padding gotham-light journal publish clearleft journal-caption">													<div class="journal-caption-name">
                                   <?php
                                    $j = 0;
                                    foreach ($journalSelectedCategory as $row) {
                                        $j++;
                                        echo strtoupper($row->journalCategory->journal_category_name);
                                        echo (count($journalSelectedCategory) == $j ? '' : ', ');
                                    }
                                    ?> 									</div>																		 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-medium journal title clearleft">										<?php echo strtoupper($journal->journalDetail->journal_detail_title); ?>									</div>
                                </div>
                               
                               
                                
                                <div style="text-align: right;" class="show-desktop col-lg-4 col-md-4 col-sm-12 col-xs-12 remove-padding gotham-light journal writer clearleft journal-caption-writer">
                                     <?php echo strtoupper((date_format(date_create($journal->journal_created_date), "j F Y"))) ?> 
                                </div>
                           
                        </a>
                       
                 
                <?php } ?>
<?php } ?>
        </div>
    </div>
</section>