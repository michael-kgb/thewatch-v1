<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Journal Author : <?php echo $model->journal_author_name; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Blog</a></li>
        <li><a href="#">Journal Author</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-8">
            <div class="box box-info">
                <div class="form-group" style="padding: 2% 0 0 0;">
                    <label for="inputEmail3" class="col-sm-2 control-label">Author Name</label>
                    <div class="col-sm-10">
                        <?php echo $model->journal_author_name; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group" style="padding: 2% 0 0 0;">
                    <label for="inputEmail3" class="col-sm-2 control-label">Website</label>
                    <div class="col-sm-10">
                        <?php echo $model->journal_author_website; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group" style="padding: 2% 0 0 0;">
                    <label for="inputEmail3" class="col-sm-2 control-label">Phone Number</label>
                    <div class="col-sm-10">
                        <?php echo $model->journal_author_phone; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group" style="padding: 2% 0 0 0;">
                    <label for="inputEmail3" class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">
                        <?php echo $model->journal_author_country; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group" style="padding: 2% 0 0 0;">
                    <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <?php echo $model->journal_author_description; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group" style="padding: 2% 0 0 0;">
                    <label for="inputEmail3" class="col-sm-2 control-label">Age</label>
                    <div class="col-sm-10">
                        <?php echo $model->journal_author_age; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group" style="padding: 2% 0 0 0;">
                    <label for="inputEmail3" class="col-sm-2 control-label">Job</label>
                    <div class="col-sm-10">
                        <?php echo $model->journal_author_job; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group" style="padding: 2% 0 0 0;">
                    <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <?php echo ($model->journal_author_status == 1) ? "Active" : "Inactive"; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class='col-sm-4'>
            <div class="box box-info">
                <div class='box-header'>
                    Author Photo
                </div>
                <div class='box-body'>
                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-10">
                            <img class="img-responsive" height="150px" src="/twcnew/img/journal/author/<?php echo $model->journal_author_photo; ?>">
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>
