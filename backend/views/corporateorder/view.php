<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $model->fullname; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Orders</a></li>
        <li><a href="#">Corporate Order</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-sm-12">
            <div class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-eye"></i> <?php echo $model->fullname; ?>
                </div>
                <div class="box-body">
                    <div style="padding-bottom: 2%;">
                        <div class="col-sm-3">
                            <div class="pull-right">
                                <b>Fullname :</b>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <?php echo $model->fullname; ?>
                        </div>
                    </div>
                    <div style="padding-bottom: 2%;">
                        <div class="col-sm-3">
                            <div class="pull-right">
                                <b>Company Name :</b>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <?php echo $model->company_name; ?>
                        </div>
                    </div>
                    <div style="padding-bottom: 2%;">
                        <div class="col-sm-3">
                            <div class="pull-right">
                                <b>Phone Number :</b>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <?php echo $model->phone_number; ?>
                        </div>
                    </div>
                    <div style="padding-bottom: 2%;">
                        <div class="col-sm-3">
                            <div class="pull-right">
                                <b>Email Address :</b>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <?php echo $model->email; ?>
                        </div>
                    </div>
                    <div style="padding-bottom: 2%;">
                        <div class="col-sm-3">
                            <div class="pull-right">
                                <b>Message :</b>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <?php echo $model->message; ?>
                        </div>
                    </div>
                    <div style="padding-bottom: 2%;">
                        <div class="col-sm-3">
                            <div class="pull-right">
                                <b>Created Date :</b>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <?php echo date_format(date_create($row->created_at), 'j F Y g:i A'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
