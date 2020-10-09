<section id="featured-brands" class="p0">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption">JURNAL</div>
        
        </div>
        <?php $data = \backend\models\Journal::find()->joinWith([                    "journalCategory",
                    "journalDetail",
                    "journalImage",
                    "journalRelated"])->where(["journal.journal_status" => 1])->orderBy('journal.journal_id DESC')->all(); ?>
        

        <div class="row">
            <div class="col-lg-12 hidden-md hidden-sm col-xs-12 clearleft clearright journal-container">
                <?php $tot = 0; ?>
                    <?php foreach($data as $row){?>
                        <?php if($tot == 0){ ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearleft clearright">
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding clearleft clearright">
                                    
                                    <a class="journal-box" href="<?php echo \yii\helpers\Url::base(); ?>/journal/detail/<?php echo $row->journalDetail->link_rewrite; ?>">
                                        <div class="overlay-journal hidden-xs"></div>
                                        <div class="overlay-title hidden-xs fsize-24 gotham-medium"><?php echo strtoupper($row->journalDetail->journal_detail_title);?>
                                        <br>
                                        <div class="overlay-description hidden-xs fsize-18 gotham-light"><?php echo ($row->journalDetail->journal_short_description);?></div>
                                        
                                        </div>
                                        
                                        <div class="overlay-journal-date hidden-xs fsize-14 gotham-white">
                                            <?php $journalSelectedCategory = backend\models\JournalDetailCategory::find()->where(['journal_detail_id' => $row->journalDetail->journal_detail_id])->all();?>
                                            <?php echo strtoupper((date_format(date_create($row->journal_created_date), "j F Y"))) ?> / <?php
                                            $j = 0;
                                            foreach ($journalSelectedCategory as $row2) {
                                                $j++;
                                                echo strtoupper($row2->journalCategory->journal_category_name);
                                                echo (count($journalSelectedCategory) == $j ? '' : ', ');
                                            }
                                            ?> / <?php
                                            if ($row->journalAuthor->journal_author_name != '-') {
                                                ?>
                                                <?php echo strtoupper($row->journalAuthor->journal_author_name); ?>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="journal-image-thumbnail" style="background:url('https://thewatch.imgix.net/journal/<?php echo $row->journal_id . '/home_cover_' . $row->journalImage->journal_image_id . '.jpg' . '?auto=compress%2Cformat&fit=max&fm=pjpg&w=650'; ?>');background-repeat: no-repeat;background-size: cover;border-radius: 5px;"></div>
                                       <!--  <img src="img/journal/<?php echo $row->journal_id . '/small_cover_' . $row->journalImage->journal_image_id . '.jpg'; ?>" class="img-responsive" style="width: 100%;"> -->
                                        <div class="hidden-lg hidden-md hidden-sm col-xs-12 ptop8"></div>
                                        <div class="journal-title hidden-lg col-xs-12 col-md-12 col-sm-12 clearright-mobile clearleft-mobile"><?php echo ($row->journalDetail->journal_detail_title);?></div>
                                        <div class="journal-description hidden-lg col-xs-12 col-md-12 col-sm-12 clearright-mobile clearleft-mobile"><?php echo ($row->journalDetail->journal_short_description);?><a class="journal-read-more" href="<?php echo \yii\helpers\Url::base(); ?>/journal/detail/<?php echo $row->journalDetail->link_rewrite; ?>"> Read More    </a></div>
                                       
                                    </a>
                                </div>
                                <div class="hidden-lg hidden-md hidden-sm col-xs-12 remove-padding clearleft-mobile clearright-mobile journal-spacing">
                                </div>
                                <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-medium2 journal publish clearleft journal-caption" style="color: rgb(69,69,69);letter-spacing: 0.8px;">
                                     <?php echo strtoupper($row->journalDetail->journal_detail_title);?> 
                                </div>
                                <div class="hidden-lg hidden-md hidden-sm col-xs-12 remove-padding gotham-light journal title clearleft" style="padding-top: 15px;">
                                                                    </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-light journal title clearleft">
                                    <p><?php echo $row->journalDetail->journal_short_description; ?></p>
                                </div>
                                                                <div class="hidden-lg hidden-md hidden-sm col-xs-12 remove-padding gotham-light journal separator clearleft" style="padding-top: 15px;">
                                    
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-light journal writer clearleft journal-caption-writer">
                                                                         <p> <a class="" href="<?php echo \yii\helpers\Url::base(); ?>/journal/detail/<?php echo $row->journalDetail->link_rewrite; ?>" style="float: left;font-size: 14px;font-family: gotham-light;color: rgb(32, 97, 103);text-decoration: underline;letter-spacing: 0.8px;"> Read More    </a></p>                                                                   
                                                                         </div> -->
                            </div>
                      <?php }
                        break;
                      } ?>
                    <div class="col-xs-12 hidden-lg hidden-sm hidden-md ptop20"></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearright clearleft">
                        <?php $tot = 0; ?>
                        <?php foreach($data as $row){?>
                            <?php if($tot > 0){?>
                            <div class="col-lg-6 col-md-6 col-sm-6 <?php if($tot == 3 || $tot == 4){ echo 'hidden-xs ptop15';}else{ echo 'col-xs-12';}?> clearright clearleft-mobile clearright-mobile">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding clearleft clearright">
                                    <a href="<?php echo \yii\helpers\Url::base(); ?>/journal/detail/<?php echo $row->journalDetail->link_rewrite; ?>" class="journal-box">
                                        <div class="overlay-journal hidden-xs"></div>
                                        <div class="overlay-title journal-title hidden-xs"><?php echo strtoupper($row->journalDetail->journal_detail_title);?></div>
                                        <div class="journal-image-thumbnail-sub col-xs-6" style="background:url('https://thewatch.imgix.net/journal/<?php echo $row->journal_id . '/home_cover_' . $row->journalImage->journal_image_id . '.jpg' . '?auto=compress%2Cformat&fit=max&fm=pjpg&w=310'; ?>');background-repeat: no-repeat;background-size: cover;border-radius: 5px;"></div>
                                        <div class="journal-thumb-height col-xs-6 hidden-lg hidden-sm hidden-md clearright-mobile">
                                            <div class="journal-title hidden-lg col-xs-12 col-md-12 col-sm-12 clearright-mobile clearleft-mobile"><?php 
                                            if(strlen($row->journalDetail->journal_detail_title) > 65){
                                                echo substr($row->journalDetail->journal_detail_title, 0,65).'...';
                                            }else{
                                                echo ($row->journalDetail->journal_detail_title);
                                            }

                                                ?></div>
                                            <div class="journal-description-more hidden-lg col-xs-12 col-md-12 col-sm-12 clearright-mobile clearleft-mobile"> Read More  </div>
                                            <div class="journal-date hidden-lg col-xs-12 col-md-12 col-sm-12 clearright-mobile clearleft-mobile">
                                            <?php $journalSelectedCategory = backend\models\JournalDetailCategory::find()->where(['journal_detail_id' => $row->journalDetail->journal_detail_id])->all();?>
                                            <?php echo strtoupper((date_format(date_create($row->journal_created_date), "j F Y"))) ?>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                    </a>
                                </div>
                                <div class="hidden-lg hidden-sm hidden-md col-xs-12 remove-padding clearleft clearright">
                                </div>
                            </div>
                            <?php } ?>
                  
                        <?php 
                        $tot++;if($tot == 5){ break;}
                    } ?> 
                    <div class="hidden-lg hidden-md hidden-sm col-xs-12 remove-padding clearleft-mobile clearright-mobile journal-spacing">
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft-mobile clearright-mobile new-line">
                    </div>
                    <a class="btn-blue hidden-lg hidden-md hidden-sm col-xs-12 blue-round default" href="<?php echo \yii\helpers\Url::base(); ?>/journal">Jurnal lainnya</a>
                    </div>
                    
            </div>
            <div class="hidden-lg col-md-12 col-sm-12 hidden-xs clearleft clearright journal-container">
                <?php $tot = 0; ?>
                    <?php foreach($data as $row){?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php if($tot == 0){ echo 'clearleft';}else{ echo 'clearright';} ?>">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding clearleft clearright">
                                    <a href="<?php echo \yii\helpers\Url::base(); ?>/journal/detail/<?php echo $row->journalDetail->link_rewrite; ?>">
                                        <img src="https://thewatch.imgix.net/journal/<?php echo $row->journal_id . '/small_cover_' . $row->journalImage->journal_image_id . '.jpg' . '?auto=compress%2Cformat&fit=max&fm=pjpg&w=470'; ?>" class="img-responsive">
                                    </a>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-medium2 journal publish clearleft journal-caption fcolor69 lspace0-8">
                                     <?php echo strtoupper($row->journalDetail->journal_detail_title);?> 
                                </div>
                                <div class="hidden-lg hidden-md hidden-sm col-xs-12 remove-padding gotham-light journal title clearleft ptop15">
                                                                    </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-light journal title clearleft">
                                    <p><?php echo $row->journalDetail->journal_short_description; ?></p>
                                </div>
                                                                <div class="hidden-lg hidden-md hidden-sm col-xs-12 remove-padding gotham-light journal separator clearleft ptop15">
                                    
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-light journal writer clearleft journal-caption-writer">
                                                                         <p> <a class="journal-read-more2" href="<?php echo \yii\helpers\Url::base(); ?>/journal/detail/<?php echo $row->journalDetail->link_rewrite; ?>"> Read More    </a></p>                                                                   
                                                                         </div>
                            </div>
                      
                    <?php 
                    $tot++;if($tot == 2){ break;}
                } ?> 
            </div>
        </div>
    </div>
   
    </section>

