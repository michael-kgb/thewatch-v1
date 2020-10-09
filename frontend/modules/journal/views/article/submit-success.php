<?php
$journalCategory = \backend\models\JournalCategory::findAll(["journal_category_status" => '1']);
$active[0] = 'submission';
echo Yii::$app->view->renderFile('@app/modules/journal/views/default/breadcrumb.php', array("journalCategory" => $journalCategory, "active" => $active));
?>
<section id="journal-list">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <center>
                    <span class="gotham-medium fsize-3"><?php echo $message; ?></span>
                </center>
            </div>
            
        </div>
    </div>
</section>