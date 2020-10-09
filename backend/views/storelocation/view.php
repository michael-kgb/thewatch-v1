<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $model->store_name; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
        <li><a href="#">Stores</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-sm-12">
            <div class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-eye"></i> <?php echo $model->store_name; ?>
                    <hr/>
                </div>
                <div class="box-body">
                    <div style="padding-bottom: 2%;">
                        <div class="col-sm-3">
                            <div class="pull-right">
                                <b>Title :</b>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <?php echo $model->store_name; ?>
                        </div>
                    </div>
                    <div style="padding-bottom: 2%;">
                        <div class="col-sm-3">
                            <div class="pull-right">
                                <b>Province :</b>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <?php echo $model->store_location; ?>
                        </div>
                    </div>
                    <div style="padding-bottom: 2%;">
                        <div class="col-sm-3">
                            <div class="pull-right">
                                <b>Address :</b>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <?php echo $model->store_address; ?>
                        </div>
                    </div>
                    <div style="padding-bottom: 2%;">
                        <div class="col-sm-3">
                            <div class="pull-right">
                                <b>Contact Number :</b>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <?php echo $model->store_contact_number; ?>
                        </div>
                    </div>
                    <div style="padding-bottom: 2%;">
                        <div style="padding-bottom: 2%;">
                        <div class="col-sm-3">
                            <div class="pull-right">
                                <b>Store Status :</b>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <?php echo $model->store_status; ?>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
