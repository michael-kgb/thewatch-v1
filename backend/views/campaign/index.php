<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Marketing Campaign
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Marketing</a></li>
		<li><a href="#">Marketing Campaign</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/campaign/create'">Add New</button>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Banner</th>
                                    <th>Campaign Name</th>
                                    <th>Expiration Date</th>
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
                                    echo '<img width="200" src="../../../frontend/web/img/campaign/'.$row->marketing_campaign_id.'/'.$row->marketing_campaign_banner.'">';
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->marketing_campaign_name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo date_format(date_create($row->marketing_campaign_date_to), 'j F Y g:i A');
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->marketing_campaign_status == 1 ? 'Active' : 'Inactive';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->marketing_campaign_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
                                    echo '<ul class="dropdown-menu" role="menu">';
                                    echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/campaign/update/' . $row->marketing_campaign_id . '"><i class="fa fa-fw fa-pencil"></i> Edit</a></li>';
                                    echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/campaign/delete/' . $row->marketing_campaign_id . '"><i class="fa fa-fw fa-trash"></i> Delete</a></li>';
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
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</section>

<?php echo $this->render('/layouts/log', [ 'module' => Yii::$app->controller->id]); ?>