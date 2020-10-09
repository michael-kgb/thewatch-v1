<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

$smallcover = \backend\models\JournalImage::find()->where(['journal_id' => $model->journal_id, 'small_cover' => 1])->one();
$cover = \backend\models\JournalImage::find()->where(['journal_id' => $model->journal_id, 'big_cover' => 1])->one();
$imagelandscape = \backend\models\JournalImage::find()->where(['journal_id' => $model->journal_id, 'orientation' => 'L', 'small_cover' => null, 'big_cover' => 0])->all();
$imageportrait = \backend\models\JournalImage::find()->where(['journal_id' => $model->journal_id, 'orientation' => 'P', 'small_cover' => null, 'big_cover' => 0])->all();
?>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-8">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-code"></i> Content <button type="submit" class="btn btn-default pull-right" onclick="updatecontent(<?php echo $model->journal_id; ?>)"><i class="fa fa-save"></i> Update</button>
                    <hr/>
                </div>
                <div class="box-body">
                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Title : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" id="journal-detail-title" class="form-control" value="<?php echo $model->journalDetail->journal_detail_title; ?>" name="JournalDetail[journal_detail_title]">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Writer : </label>
                        </div>
                        <div class="col-sm-10">
                            <select class="form-control" id="journal-author">
                                <?php
                                $author = \backend\models\JournalAuthor::find()->all();
                                foreach ($author as $row) {
                                    ?>
                                    <option value="<?php echo $row->journal_author_id ?>" <?php echo ($row->journal_author_id == $model->journal_author_id) ? "selected" : "" ?>><?php echo $row->journal_author_name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Status : </label>
                        </div>
                        <div class="col-sm-10">
                            <select class="form-control" id="journal-status">
                                <option value="0" <?php echo ($model->journal_status == 0) ? "selected" : "" ?>>Deactive</option>
                                <option value="1" <?php echo ($model->journal_status == 1) ? "selected" : "" ?>>Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group" style="padding: 5% 0 7% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Description : </label>
                        </div>
                        <div class="col-sm-10">
                            <textarea id="productdetail-spesification" class="form-control" name="JournalDetail[journal_detail_description]" rows="10" cols="80" style="visibility: hidden; display: none;"><?php echo $model->journalDetail->journal_detail_description; ?></textarea>
                            <div id="cke_productdetail-spesification" class="cke_1 cke cke_reset cke_chrome cke_editor_productdetail-spesification cke_ltr cke_browser_webkit" dir="ltr" lang="en" role="application" aria-labelledby="cke_productdetail-spesification_arialbl"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group" style="padding: 0 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Content : </label>
                        </div>
                        <div class="col-sm-10">
                            <textarea id="productdetail-description" class="form-control" name="JournalDetail[journal_detail_content1]" rows="10" cols="80" style="visibility: hidden; display: none;"><?php echo $model->journalDetail->journal_detail_content1; ?></textarea>
                            <div id="cke_productdetail-description" class="cke_1 cke cke_reset cke_chrome cke_editor_productdetail-description cke_ltr cke_browser_webkit" dir="ltr" lang="en" role="application" aria-labelledby="cke_productdetail-description_arialbl"></div>
                        </div>
                    </div>

                </div><!-- /.box-body -->
            </div>
        </div>
        <?php
        $journal_category = \backend\models\JournalDetailCategory::find()->where(['journal_detail_id' => $model->journalDetail->journal_detail_id])->all();
        ?>
        <div class="col-sm-4">
            <div class="box box-primary">
                <div class="box-header"><i class="fa fa-tags"></i> Category</div>
                <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Category</th>
                                <th width="5%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="detail-category-list">
                            <?php
                            foreach ($journal_category as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $row->journalCategory->journal_category_name; ?></td>
                                    <td><button class="btn btn-default" onclick="delete_journal_category(<?php echo $row->journal_detail_category_id; ?>)"><i class="fa fa-close"></i> Delete</button></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header"><i class="fa fa-tags"></i> Add new category</div>
                <div class="box-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td>
                                    <select id="detail-category" class="form-control">
                                        <?php
                                        $journal_category_list = \backend\models\JournalCategory::find()->all();
                                        foreach ($journal_category_list as $row) {
                                            ?>
                                            <option value="<?php echo $row->journal_category_id; ?>"><?php echo $row->journal_category_name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td width="5%"><button class="btn btn-default" onclick="add_detail_category(<?php echo $model->journalDetail->journal_detail_id; ?>)"><i class="fa fa-plus"></i> Add</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-sm-6">
            <div id="small-cover-box" class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-picture-o"></i> Small Cover <button type="submit" class="btn btn-default pull-right" onclick="update_image_small_banner_journal(<?php echo $model->journal_id ?>)"><i class="fa fa-save"></i> Update</button>
                    <hr/>
                </div>
                <div class="box-body">
                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <div class="col-sm-3">
                            <label for="inputEmail3" class="pull-right">Existing</label>
                        </div>
                        <div class="col-sm-9" id="small-cover-image">
                            <img src="../../../../frontend/web/img/journal/<?php echo $model->journal_id; ?>/small_cover_<?php echo $cover->journal_image_id; ?>.jpg" class="img-responsive"/>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr/>
                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <div class="col-sm-3">
                            <label for="inputEmail3" class="pull-right">Change Image</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="file" id="smallcover" name="smallcover">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div id="big-cover-box" class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-picture-o"></i> Big Cover <button type="submit" class="btn btn-default pull-right" onclick="update_image_big_cover_journal(<?php echo $model->journal_id ?>)"><i class="fa fa-save"></i> Update</button>
                    <hr/>
                </div>
                <div class="box-body">
                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <div class="col-sm-3">
                            <label for="inputEmail3" class="pull-right">Existing</label>
                        </div>
                        <div class="col-sm-9">
                            <img src="../../../../frontend/web/img/journal/<?php echo $model->journal_id; ?>/big_cover_<?php echo $cover->journal_image_id; ?>.jpg" class="img-responsive"/>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr/>
                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <div class="col-sm-3">
                            <label for="inputEmail3" class="pull-right">Change Image</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="file" id="bigcover" name="bigcover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
            <div class="box box-primary" id="landscape-box">
                <div class="box-header">
                    <i class="fa fa-picture-o"></i> Landscape Image <button type="submit" class="btn btn-default pull-right" onclick="update_journal_image(<?php echo $model->journal_id ?>, 'L')"><i class="fa fa-save"></i> Update</button>
                    <hr/>
                </div>
                <div class="box-body">
                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <div class="col-sm-3">
                            <label for="inputEmail3" class="pull-right">Existing</label>
                        </div>
                        <div class="col-sm-9">
                            <?php
                            foreach ($imagelandscape as $row) {
                                ?>
                                <div class="col-sm-4" style="margin-bottom: 30px;">
                                    <img src="../../../../frontend/web/img/journal/<?php echo $model->journal_id; ?>/<?php echo $row->journal_image_id; ?>.jpg" class="img-responsive"/>
                                    <div class="text-center" style="margin-top: 20px;"><button type="button" class="btn btn-default" onclick="delete_image_journal(<?php echo $row->journal_image_id; ?>)"><i class="fa fa-close"></i>Delete</button></div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr/>
                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <div class="col-sm-3">
                            <label for="inputEmail3" class="pull-right">Change Image</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="file" id="landscapeimage" name="landscapeimage" multiple>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="box box-primary" id="portrait-box">
                <div class="box-header">
                    <i class="fa fa-picture-o"></i> Portrait Image <button type="submit" class="btn btn-default pull-right" onclick="update_journal_image(<?php echo $model->journal_id ?>, 'P')"><i class="fa fa-save"></i> Update</button>
                    <hr/>
                </div>
                <div class="box-body">
                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <div class="col-sm-3">
                            <label for="inputEmail3" class="pull-right">Existing</label>
                        </div>
                        <div class="col-sm-9">
                            <?php
                            foreach ($imageportrait as $row) {
                                ?>
                                <div class="col-sm-4" style="margin-bottom: 30px;">
                                    <img src="../../../../frontend/web/img/journal/<?php echo $model->journal_id; ?>/<?php echo $row->journal_image_id; ?>.jpg" class="img-responsive"/>
                                    <div class="text-center" style="margin-top: 20px;"><button type="button" class="btn btn-default" onclick="delete_image_journal(<?php echo $row->journal_image_id; ?>)"><i class="fa fa-close"></i>Delete</button></div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr/>
                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <div class="col-sm-3">
                            <label for="inputEmail3" class="pull-right">Change Image</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="file" id="portraitimage" name="portraitimage" multiple>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</section>
