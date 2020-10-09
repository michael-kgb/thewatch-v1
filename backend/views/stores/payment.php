<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Stores 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/stores/index"><i class="glyphicon glyphicon-shopping-cart"></i>Stores</a></li>
        <li><a href="#">index</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/stores/create'">Add New</button>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Store Name</th>
                                    <th>Store Slug</th>
                                    <th>Location</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($data as $row) { ?>
                                <?php
                                echo '<tr>';
                                echo '<td>';
                                echo $no;
                                echo '</td>';
                                echo '<td>';
                                echo $row->store_name;
                                echo '</td>';
                                echo '<td>';
                                echo $row->store_slug;
                                echo '</td>';
                                echo '<td>';
                                echo $row->store_location;
                                echo '</td>';
                                echo '<td>';
                                $paymentMethodDetail = \backend\models\PaymentMethodDetail::findAll(["store_id" => $row->store_id]); 
									
									if(count($paymentMethodDetail) > 0){
									    foreach($paymentMethodDetail as $payment){
									        echo '- '.$payment->payment->name_bank.'<br>';
									    }
									}
								echo '</td>';
                                echo '<td>';
                                echo $row->store_status;
                                echo '</td>';
                                echo '<td>';

                                echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->store_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';

                                echo '<ul class="dropdown-menu" role="menu">';
                                echo '<li><a href="updatepayment/' . $row->store_id . '"><i class="fa fa-fw fa-pencil"></i> Update</a></li>';
                                echo '<li><a style="cursor: pointer;" onclick="deletecustomer(' . $row->store_id . ')"><i class="fa fa-fw fa-trash"></i> Delete</a></li>';
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