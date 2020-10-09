<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Corporate Order 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Orders</a></li>
        <li><a href="#">Corporate Order</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php
                $store_id = Yii::$app->session->get('userInfo')['store_id'];
                ?>

                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Fullname</th>
                                    <th>Company Name</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data as $row) {
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $no;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->fullname;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->company_name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo date_format(date_create($row->created_at), 'j F Y g:i A');
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group">';
									echo '<a href="' . \yii\helpers\Url::base() . '/corporateorder/view/' . $row->corporate_order_id . '" class="btn btn-default" ><i class="fa fa-fw fa-eye"></i> View</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</section>

<?php echo $this->render('/layouts/log', [ 'module' => Yii::$app->controller->id]); ?>