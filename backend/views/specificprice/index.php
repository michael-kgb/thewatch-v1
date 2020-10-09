<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Cart Rules 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Price Rules</a></li>
        <li><a href="#">Cart Rules</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/cartrules/create" target="_blank" class="btn btn-info">Add New</a>
               
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Quantity</th>
                                    <th>Expiration Date</th>
									<th>Discount Amount</th>
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
                                    echo $row->cartRuleLang->name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->code;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->quantity;
                                    echo '</td>';
                                    echo '<td>';
                                    echo date_format(date_create($row->date_to), 'j F Y g:i A');
                                    echo '</td>';
									echo '<td>';
									echo $row->reduction_percent != 0 ? number_format($row->reduction_percent, 0, '', '.') . ' %' : 'IDR ' . number_format($row->reduction_amount, 0, '', '.');
									echo '</td>';
                                    echo '<td>';
                                    echo $row->active == 1 ? 'Active' : 'Inactive';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->cart_rule_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
                                    echo '<ul class="dropdown-menu" role="menu">';
                                    echo '<li><a style="cursor:pointer;" href="https://thewatch.co/backend/web/cartrules/update/' . $row->cart_rule_id . '"><i class="fa fa-fw fa-pencil"></i> Edit</a></li>';
                                    echo '<li><a style="cursor:pointer;" onclick="deletecartrule('.$row->cart_rule_id.')"><i class="fa fa-fw fa-trash"></i> Delete</a></li>';
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