<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="box-body">
                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Title : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" id="journal-journal_category_id" class="form-control" name="JournalDetail[journal_detail_title]">
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Writer : </label>
                        </div>
                        <div class="col-sm-10">
                            <?php
                            $author = \backend\models\JournalAuthor::find()->all();
                            ?>
                            <select class='form-control' name="Journal[journal_author_id]" required>
                                <option value="">Please select</option>
                                <?php
                                foreach ($author as $row) {
                                    ?>
                                    <option value="<?php echo $row->journal_author_id; ?>"><?php echo $row->journal_author_name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Category : </label>
                        </div>
                        <div class="col-sm-10">
                            <table width="100%" id="multiple-category">
                                <?php
                                $category = \backend\models\JournalCategory::find()->all();
                                ?>
                                <tr>
                                    <td style="padding-bottom: 20px;">
                                        <select class='form-control' id="category-list" name="Journal[journal_category_id][]">
                                            <option value="">Please select</option>
                                            <?php
                                            foreach ($category as $row) {
                                                ?>
                                                <option value="<?php echo $row->journal_category_id; ?>"><?php echo $row->journal_category_name; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td width="15%" style="padding-bottom: 20px;">
                                        <a class="btn btn-default form-control" onclick="category_duplicate()"><i class="fa fa-copy"></i> Multiple category</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Description : </label>
                        </div>
                        <div class="col-sm-10">
                            <textarea id="productdetail-spesification" class="form-control" name="JournalDetail[journal_detail_description]" rows="10" cols="80" style="visibility: hidden; display: none;"></textarea>
                            <div id="cke_productdetail-spesification" class="cke_1 cke cke_reset cke_chrome cke_editor_productdetail-spesification cke_ltr cke_browser_webkit" dir="ltr" lang="en" role="application" aria-labelledby="cke_productdetail-spesification_arialbl"></div>
                        </div>
                    </div>
                    <div class="form-group" style="padding: 5.7% 0 3% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Content : </label>
                        </div>
                        <div class="col-sm-10">
                            <textarea id="productdetail-description" class="form-control" name="JournalDetail[journal_detail_content1]" rows="10" cols="80" style="visibility: hidden; display: none;"></textarea>
                            <div id="cke_productdetail-description" class="cke_1 cke cke_reset cke_chrome cke_editor_productdetail-description cke_ltr cke_browser_webkit" dir="ltr" lang="en" role="application" aria-labelledby="cke_productdetail-description_arialbl"></div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group" style="padding: 2.7% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Big Cover : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="file" name="JournalImageBigCover" id="userImage" class="user-image">
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Small Cover : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="file" name="JournalImageSmallCover" id="userImage" class="user-image">
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Landscape Image : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="file" name="JournalImageLandscapeImage[]" id="userImage" class="user-image" multiple="">
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Portrait Image : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="file" name="JournalImagePortraitImage[]" id="userImage" class="user-image" multiple="">
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-default pull-right"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <?php ActiveForm::end(); ?>
            </div>
        </div>
</section>
