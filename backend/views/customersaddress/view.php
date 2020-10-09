<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Customer Address: <?php echo strtoupper($model->firstname) . ' ' . strtoupper($model->lastname); ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Customers</a></li>
        <li><a href="#">Addresses</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-sm-12">
            <div class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-user"></i> <a href="../../customers/view/<?php echo $model->customer_id; ?>"><?php echo strtoupper($model->firstname) . ' ' . strtoupper($model->lastname); ?></a><button type="button" class="btn btn-default pull-right" onclick="location.href = '/twcnew/backend/web/customersaddress/update/<?php echo $model->customer_address_id; ?>'"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                    <hr/>
                </div>
                <div class="box-body">
                    <div class="col-sm-3" style="padding-bottom: 20px"><div class="pull-right">First Name :</div></div>
                    <div class="col-sm-9" style="padding-bottom: 20px"><div class="pull-left"><?php echo $model->firstname; ?></div></div>
                    <div class="col-sm-3" style="padding-bottom: 20px"><div class="pull-right">Last Name :</div></div>
                    <div class="col-sm-9" style="padding-bottom: 20px"><div class="pull-left"><?php if(!empty($model->lastname)) echo $model->lastname; else echo '<div class="text-light-blue">Not Set</div>'; ?></div></div>
                    <div class="col-sm-3" style="padding-bottom: 20px"><div class="pull-right">Country :</div></div>
                    <div class="col-sm-9" style="padding-bottom: 20px"><div class="pull-left"><?php echo $model->country->iso_code; ?></div></div>
                    <div class="col-sm-3" style="padding-bottom: 20px"><div class="pull-right">Province :</div></div>
                    <div class="col-sm-9" style="padding-bottom: 20px"><div class="pull-left"><?php if(!empty($model->province->name)) echo $model->province->name; else echo '<div class="text-light-blue">Not Set</div>'; ?></div></div>
                    <div class="col-sm-3" style="padding-bottom: 20px"><div class="pull-right">State :</div></div>
                    <div class="col-sm-9" style="padding-bottom: 20px"><div class="pull-left"><?php if(!empty($model->state->name)) echo $model->state->name; else echo '<div class="text-light-blue">Not Set</div>'; ?></div></div>
                    <div class="col-sm-3" style="padding-bottom: 20px"><div class="pull-right">District :</div></div>
                    <div class="col-sm-9" style="padding-bottom: 20px"><div class="pull-left"><?php if(!empty($model->district->name)) echo $model->district->name; else echo '<div class="text-light-blue">Not Set</div>'; ?></div></div>
                    <div class="col-sm-3" style="padding-bottom: 20px"><div class="pull-right">Address :</div></div>
                    <div class="col-sm-9" style="padding-bottom: 20px"><div class="pull-left"><?php echo $model->address1; ?></div></div>
                    <div class="col-sm-3" style="padding-bottom: 20px"><div class="pull-right">Post Code :</div></div>
                    <div class="col-sm-9" style="padding-bottom: 20px"><div class="pull-left"><?php if(!empty($model->postcode)) echo $model->postcode; else echo '<div class="text-light-blue">Not Set</div>'; ?></div></div>
                    <div class="col-sm-3" style="padding-bottom: 20px"><div class="pull-right">Phone :</div></div>
                    <div class="col-sm-9" style="padding-bottom: 20px"><div class="pull-left"><?php echo $model->phone; ?></div></div>
                    <div class="col-sm-3" style="padding-bottom: 20px"><div class="pull-right">Phone Mobile :</div></div>
                    <div class="col-sm-9" style="padding-bottom: 20px"><div class="pull-left"><?php echo $model->phone_mobile; ?></div></div>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
