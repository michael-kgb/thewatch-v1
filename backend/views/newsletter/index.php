<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Newsletter
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Marketing</a></li>
        <li><a href="#">Newsletter</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/newsletter/create'">Add New</button>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Banner</th>
                                    <th>Subject</th>
                                    <th>Send Date</th>
                                    <th>Type</th>
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
                                    echo $row->newsletter_poster;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->newsletter_subject;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->newsletter_send_date;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->newsletter_type;
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->newsletter_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button>';
                                    echo '</div>';
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