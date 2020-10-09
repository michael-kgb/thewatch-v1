<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View Marketing Campaign
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Marketing Campaign</a></li>
        <li><a href="#">View</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="box box-info">
                <div class="box-header">
                    <b>Information</b>
                </div>
                <div class="box-body">
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Name :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->marketing_campaign_name; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Description :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->marketing_campaign_description; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Date From :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->marketing_campaign_date_from; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Date To :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->marketing_campaign_date_to; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="margin-bottom: 20px;">
                        <div class="pull-right">
                            <b>Status :</b>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $model->marketing_campaign_status == 1 ? 'Active' : 'Not Active'; ?>
                    </div>
                    
                    
                </div>
            </div>
            

        </div>

       
    </div>
    <div class="row">
            <div class="col-xs-12">
                <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/campaign/create3/<?php echo $model->marketing_campaign_id;?>'">Add New</button>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-header">
                        <b>Bulkhead</b>
                    </div>
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bulkhead Name</th>
                                    <th>Bulkhead Text</th>
                                    <th>Expiration Date</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php
                                foreach ($data as $row) {
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $no;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->marketing_bulkhead_name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->marketing_bulkhead_text;
                                    echo '</td>';
                                    echo '<td>';
                                    echo date_format(date_create($row->marketing_bulkhead_date_to), 'j F Y g:i A');
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->marketing_bulkhead_type;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->marketing_bulkhead_status == 1 ? 'Active' : 'Inactive';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
                                    echo '<ul class="dropdown-menu" role="menu">';
                                    echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/campaign/update2/' . $row->marketing_bulkhead_id . '"><i class="fa fa-fw fa-pencil"></i> Edit</a></li>';
                                    echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/campaign/delete2/' . $row->marketing_bulkhead_id . '"><i class="fa fa-fw fa-trash"></i> Delete</a></li>';
                                    echo '</ul></div>';
                                    echo '</td>';
                                    echo '</tr>';
                                    $no++;
                                    ?>
<?php } ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
</section>