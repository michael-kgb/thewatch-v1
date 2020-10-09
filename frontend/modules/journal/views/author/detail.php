<?php
echo Yii::$app->view->renderFile('@app/modules/journal/views/default/breadcrumb.php', array("journalCategory" => $journalCategory, "active" => $active));
?>
<?php if(count($author) > 0) { ?>
<section id="journal-list">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding clearleft clearright">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding clearleft clearright">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 author image clearleft clearright" style="padding-top: 3%;">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/journal/author/<?php echo $author->journal_author_photo; ?>" class="img-responsive">
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 author name detail">
                    <?php echo $author->journal_author_name; ?>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 author job detail">
                        
                          <?php if($author->journal_author_job != ''){echo $author->journal_author_job;}else{ echo '-';} ?>
                        
                    </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-gotham-light journal author description content clearright">
                            <?php echo $author->journal_author_description; ?>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>

<section id="journal-list">
    <div class="container">
        <div class="row margin-bottom-10">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 related-items caption text-gotham-medium remove-padding-right">CONTRIBUTOR'S JOURNAL</div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
        </div>
    </div>
    <div class="container related-items" style="padding-top: 50px;">
         <div class="row">
            <?php if (count($related) > 0) { ?>
                <?php
                $i = 1;
                foreach ($related as $journal) {
                    $journalSelectedCategory = backend\models\JournalDetailCategory::find()->where(['journal_detail_id' => $journal->journalDetail->journal_detail_id])->all();
                    ?>
                    <?php if ($i == 1) { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright journal-container">
                        <?php } ?>
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/journal/detail/<?php echo $journal->journalDetail->link_rewrite; ?>">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php echo $i == 1 ? "clearleft" : "clearright"; ?>">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding clearleft clearright">
                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/journal/<?php echo $journal->journal_id . '/small_cover_' . $journal->journalImage->journal_image_id . '.jpg'; ?>" class="img-responsive">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-light journal publish clearleft journal-caption">
                                    <?php echo strtoupper((date_format(date_create($journal->journal_created_date), "j F Y"))) ?> / <?php
                                    $j = 0;
                                    foreach ($journalSelectedCategory as $row) {
                                        $j++;
                                        echo strtoupper($row->journalCategory->journal_category_name);
                                        echo (count($journalSelectedCategory) == $j ? '' : ', ');
                                    }
                                    ?> / <?php
                                    if ($journal->journalAuthor->journal_author_name != '-') {
                                        ?>
                                        <?php echo strtoupper($journal->journalAuthor->journal_author_name); ?>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-medium journal title clearleft">
                                    <?php echo strtoupper($journal->journalDetail->journal_detail_title); ?>
                                </div>
                                <?php if($journal->journalDetail->journal_short_description != ''){ ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-light journal title clearleft">
                                    <?php echo $journal->journalDetail->journal_short_description; ?>
                                </div>
                                <?php } ?>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-light journal writer clearleft journal-caption-writer">
                                    
                                </div>
                            </div>
                        </a>
                        <?php
                        if ($i == 2) {
                            $i = 0;
                            ?>
                        </div>
                    <?php } ?>
                    <?php $i++; ?>
                <?php } ?>
<?php }else{ ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright journal-container center">
            NO JOURNAL
        </div>
<?php } ?>
        </div>
       
    </div>
</section>

<section id="journal-list">
    <div class="container">
        <div class="row margin-bottom-10">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 related-items caption text-gotham-medium remove-padding-right">OTHER CONTRIBUTORS</div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
        </div>
    </div>
    <div class="container related-items" style="padding-top: 30px;">
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright journal-container">
                <?php foreach ($author_exc as $author) { ?>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/journal/author/detail/<?php echo $author->link_rewrite; ?>"
                   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 author image clearleft clearright" style="padding-top: 3%;">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/journal/author/<?php echo $author->journal_author_photo; ?>" class="img-responsive">
                        </div>
                    
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 author name detail" style="padding-top: 15px;font-family: gotham-light;text-align: center;">
                        <?php echo $author->journal_author_name; ?>
                        </div>
                    </div>
                    </a>
                <?php } ?>
            </div>
         </div>
    </div>
</section>
<?php } ?>