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
                            <label for="inputEmail3" class="pull-right">Name : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" id="journal-journal_category_id" class="form-control" name="JournalWriter[journal_author_name]">
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Website : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" id="journal-journal_category_id" class="form-control" name="JournalWriter[journal_author_website]">
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Phone Number : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" id="journal-journal_category_id" class="form-control" name="JournalWriter[journal_author_phone]">
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Country : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" id="journal-journal_category_id" class="form-control" name="JournalWriter[journal_author_country]">
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 5% 0 7% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Description : </label>
                        </div>
                        <div class="col-sm-10">
                            <textarea rows="5" class="form-control" id="journal-detail-description" name="JournalWriter[journal_author_description]"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Photo : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="file" id="photo" name="photo">
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Age : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" id="journal-journal_category_id" class="form-control" name="JournalWriter[journal_author_age]">
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 0 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Job : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" id="journal-journal_category_id" class="form-control" name="JournalWriter[journal_author_job]">
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 3% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="pull-right">Status : </label>
                        </div>
                        <div class="col-sm-10">
                            <?= $form->field($model, 'journal_author_status')->dropDownList([ '1' => 'Active', '0' => 'Inactive',], ['prompt' => ''])->label(false) ?>
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
