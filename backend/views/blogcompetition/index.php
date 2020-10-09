
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Blog Competion
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Setting</a></li>
        <li><a href="#">Blog Competition</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/blogcompetition/create'">Edit Content</button>
                <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/blogcompetition/export'">Export Excel</button>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>No HP</th>
                                    <th>Email</th>
                                    <th>URL</th>
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
                                    echo $row->kontes_seo_name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->kontes_seo_hp;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->kontes_seo_email;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->kontes_seo_url;
                                    echo '</td>';
                                    echo '<td>';
                                    if($row->kontes_seo_status == 'pending'){
                                        echo '<div class="btn-group"><button type="button" class="btn btn-warning">Pending</button><button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
                                        echo '<ul class="dropdown-menu" role="menu">';
                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/blogcompetition/approved/' . $row->kontes_seo_id . '">Approved</a></li>';
                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/blogcompetition/disapproved/' . $row->kontes_seo_id . '">Disapproved</a></li>';
                                        echo '</ul></div>';
                                    }
                                    if($row->kontes_seo_status == 'approved'){
                                        echo '<div class="btn-group"><button type="button" class="btn btn-success">Approved</button><button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
                                        echo '<ul class="dropdown-menu" role="menu">';
                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/blogcompetition/pending/' . $row->kontes_seo_id . '">Pending</a></li>';
                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/blogcompetition/disapproved/' . $row->kontes_seo_id . '">Disapproved</a></li>';
                                        echo '</ul></div>';
                                    }
                                    if($row->kontes_seo_status == 'disapproved'){
                                        echo '<div class="btn-group"><button type="button" class="btn btn-danger">Disapproved</button><button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
                                        echo '<ul class="dropdown-menu" role="menu">';
                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/blogcompetition/pending/' . $row->kontes_seo_id . '">Pending</a></li>';
                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/blogcompetition/approved/' . $row->kontes_seo_id . '">Approved</a></li>';
                                        echo '</ul></div>';
                                    }
                                    

                                    // echo $row->kontes_seo_status;
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->kontes_seo_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button>';
                                    echo '<ul class="dropdown-menu" role="menu">';
                                  
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