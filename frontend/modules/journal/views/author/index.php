<?php
echo Yii::$app->view->renderFile('@app/modules/journal/views/default/breadcrumb.php', array("journalCategory" => $journalCategory, "active" => $active));
?>
<?php if(count($authors) > 0) { ?>


  
<section id="journal-list">
    <div class="container">
    
        <div class="row">
        <?php foreach ($authors as $author) { ?>
        <a href="<?php echo \yii\helpers\Url::base(); ?>/journal/author/detail/<?php echo $author->link_rewrite; ?>">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 remove-padding clearleft clearright">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 author image">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/journal/author/<?php echo $author->journal_author_photo; ?>" class="img-responsive">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 author name">
                    <?php echo $author->journal_author_name; ?>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 author job">
                        
                          <?php if($author->journal_author_job != ''){echo $author->journal_author_job;}else{ echo '-';} ?>
                        
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-gotham-light journal author contribution">
                        Contributed <span style="color:#9e8461;"><?php $con = \backend\models\Journal::find()->where(["journal_author_id"=>$author->journal_author_id , "journal_status"=> 1])->all();echo count($con);?> articles</span>
                    </div>
                    
                </div>
            </div>
            </a>
            <?php } ?>
        </div>
        
    </div>
</section>

<?php } ?>
<section id="journal-list">
    <div class="container">
    
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center" style="font-family: gotham-light;font-size: 1.4em;padding-bottom: 3%;">
                BECOME OUR CONTRIBUTORS
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center" style="font-family: gotham-light;padding-bottom: 5px;">
                Join to our contributors community and get special advantage.
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center" style="font-family: gotham-light;padding-bottom: 5px;">
                Simply drop us an email about your biography, story and photos to <span style="color:#9e8461;"> contributor@thewatch.co </span>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center" style="font-family: gotham-light;padding-bottom: 5px;">
            or click the button bellow
            </div>
        </div>
        <div class="row" style="padding-top: 20px;">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 center">
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 center">
                <a href="<?php echo \yii\helpers\Url::base(); ?>/journal/article/submit" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center" style="height:155px;width:155px;background-color: black;border-radius: 50%;">
                    
                    
                </a>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 center">
            </div>
        </div>
    </div>
</section>