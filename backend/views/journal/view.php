<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $model->journalDetail->journal_detail_title . ' by ' . $model->journalAuthor->journal_author_name; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
        <li><a href="#">Journal</a></li>
    </ol>
</section>

<?php
$cover = \backend\models\JournalImage::find()->where(['journal_id' => $model->journal_id, 'big_cover' => 1])->one();
$imagelandscape = \backend\models\JournalImage::find()->where(['journal_id' => $model->journal_id, 'orientation' => 'L', 'small_cover' => null, 'big_cover' => 0])->all();
$imageportrait = \backend\models\JournalImage::find()->where(['journal_id' => $model->journal_id, 'orientation' => 'P', 'small_cover' => null, 'big_cover' => 0])->all();
$img_base = \Yii::$app->urlManagerFrontEnd->baseUrl;
?>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-sm-8">
            <div class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-eye"></i> Journal Preview <a class="btn btn-default pull-right" href = '../../../../journal/preview/<?php echo $model->journalDetail->link_rewrite; ?>' target="_blank"><i class="fa fa-fw fa-desktop"></i> Live view</a>
                    <hr/>
                </div>
                <div class="box-body">
                    <div class="col-sm-12" style="margin-bottom: 30px;">
                        <img src="<?= $img_base; ?>/img/journal/<?php echo $model->journal_id; ?>/big_cover_<?php echo $cover->journal_image_id; ?>.jpg" class="img-responsive"/>
                    </div>
                    <div class="col-sm-3">
                        <b><?php echo $model->journalDetail->journal_detail_title; ?></b>
                        <br/>
                        By <?php echo $model->journalAuthor->journal_author_name; ?>
                        <br/>
                        <?php echo date_format(date_create($model->journal_created_date), 'j F Y g:i A'); ?>
                    </div>
                    <div class="col-sm-9">
                        <?php
                        echo $model->journalDetail->journal_detail_description;
                        foreach ($imagelandscape as $row) {
                            ?>
                            <img src="<?= $img_base; ?>/img/journal/<?php echo $model->journal_id; ?>/<?php echo $row->journal_image_id; ?>.jpg" class="img-responsive" style="margin-top: 30px; width:80%"/>
                            <?php
                        }
                        ?>
                        <div style="margin-top: 30px; width: 100%; overflow: auto;">
                            <?php echo $model->journalDetail->journal_detail_content1; ?>
                        </div>
                        <?php
                        foreach ($imageportrait as $row) {
                            ?>
                            <img src="<?= $img_base; ?>/img/journal/<?php echo $model->journal_id; ?>/<?php echo $row->journal_image_id; ?>.jpg" class="img-responsive" style="margin-top: 30px; width:80%"/>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-list"></i> Journal Description <a class="btn btn-default pull-right" href = '../update/<?php echo $model->journal_id; ?>' target="_blank"><i class="fa fa-fw fa-pencil"></i> Edit</a>
                    <hr/>
                </div>
                <div class="box-body">
                    <?php
                        $category = \backend\models\JournalDetailCategory::find()->where(['journal_detail_id' => $model->journalDetail->journal_detail_id])->all();
                    ?>
                    <div class="col-sm-3"><div class="pull-right"><b>Title :</b></div></div>
                    <div class="col-sm-9"><div class="pull-left"><?php echo $model->journalDetail->journal_detail_title; ?></div></div>
                    <div class="col-sm-3" style="margin-top: 10px;"><div class="pull-right"><b>Category :</b></div></div>
                    <div class="col-sm-9" style="margin-top: 10px;">
                        <div class="pull-left">
                        <?php 
                            $i = 0;
                            foreach($category as $row){
                                $i++;
                                echo $row->journalCategory->journal_category_name;
                                echo ($i == count($category) ? '' : ', ');
                            }
                        ?>
                        </div>
                    </div>
                    <div class="col-sm-3" style="margin-top: 10px;"><div class="pull-right"><b>Writer :</b></div></div>
                    <div class="col-sm-9" style="margin-top: 10px;"><div class="pull-left"><?php echo $model->journalAuthor->journal_author_name; ?></div></div>
                    <div class="col-sm-3" style="margin-top: 10px;"><div class="pull-right"><b>Date Create :</b></div></div>
                    <div class="col-sm-9" style="margin-top: 10px;"><div class="pull-left"><?php echo date_format(date_create($model->journal_created_date), 'j F Y g:i A'); ?></div></div>
                    <div class="col-sm-3" style="margin-top: 10px;"><div class="pull-right"><b>Status :</b></div></div>
                    <div class="col-sm-9" style="margin-top: 10px;"><div class="pull-left"><?php echo ($model->journal_status == 0) ? "Inactive" : "Active"; ?></div></div>
                </div>
            </div>
        </div>
    </div>
</section>
