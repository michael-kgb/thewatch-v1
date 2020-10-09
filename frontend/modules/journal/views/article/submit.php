<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

$journalCategory = \backend\models\JournalCategory::findAll(["journal_category_status" => '1']);
$active[0] = 'submission';
echo Yii::$app->view->renderFile('@app/modules/journal/views/default/breadcrumb.php', array("journalCategory" => $journalCategory, "active" => $active));
?>
<section id="journal-list">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <center>
                    <span class="gotham-medium fsize-3">Apply Your Ideas & Get Published</span>
                </center>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 ptop4">
                <span class="gotham-light">
                    The Watch Co's Journal welcomes submission from a likeminded individual who would like <br>
                    to see their work published. Any related topics; Art &amp; Design, Fashion, Lifestyle, <br>
                    Music, Travel are welcome.
                    <br><br>
                    To submit a project for consideration, simply fill the form below. <br>
                    Please Have a look at our term and policy before submiting material.
                    <br><br>
                </span>
            </div>
            <?php
                $form = ActiveForm::begin();
            ?>
            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 ptop4">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 clearleft remove-padding-left gotham-light lspace2">
                    NAME
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-8 clearleft clearright remove-padding">
                    <input class="email" id="new_address_phone" type="text" name="submission_name" placeholder="Name">
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 ptop1">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 clearleft remove-padding-left gotham-light lspace2">
                    EMAIL
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-8 clearleft clearright remove-padding">
                    <input class="email" id="new_address_phone" type="text" name="submission_email" placeholder="Email">
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 ptop1">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 clearleft remove-padding-left gotham-light lspace2">
                    PHONE NUMBER
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-8 clearleft clearright remove-padding">
                    <input class="email" id="new_address_phone" type="text" name="submission_phone" placeholder="Phone Number">
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 ptop1">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 clearleft remove-padding-left gotham-light lspace2">
                    PERSONAL INFO
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-8 clearleft clearright remove-padding">
                    <input class="email" id="new_address_phone" type="text" name="submission_info" placeholder="Personal Info">
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 ptop1">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 clearleft remove-padding-left gotham-light lspace2">
                    CATEGORY
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-8 clearleft clearright remove-padding">
                    <select class="shipping" name="submission_journal_category">
                        <option value="0">Category</option>
                        <?php  
                        $category = \backend\models\JournalCategory::findAll(['journal_category_status' => 1]);
                        if(count($category) > 0){
                            foreach($category as $data){
                        ?>
                        <option value="<?php echo $data->journal_category_id; ?>"><?php echo $data->journal_category_name; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 ptop1">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 clearleft remove-padding-left gotham-light lspace2">
                    SUBMISSION MATERIAL
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-8 clearleft clearright remove-padding">
                    <input class="email" id="new_address_phone" type="text" name="submission_material" placeholder="Submission Material">
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 ptop1">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 clearleft remove-padding-left gotham-light lspace2">
                    IMAGE
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-8 clearleft clearright remove-padding">
                    <input type="file" name="submission_images[]" id="fileField" multiple />
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 ptop1">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 clearleft remove-padding-left">
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-8 clearleft clearright remove-padding">
                    <input type="submit" value="SUBMIT" id="submit-installment" class="btn-submit">
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>