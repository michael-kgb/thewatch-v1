<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Customer Address
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Customers</a></li>
        <li><a href="#">Addresses</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php
                if ($add_access == 1) {
                    ?>
                    <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/customersaddress/create'">Add New</button>
                    <?php
                }
                ?>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body" id="customer-address">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="2%">No</th>
                                    <th width="8%">First Name</th>
                                    <th width="8%">Last Name</th>
                                    <th width="15%">Address</th>
                                    <th width="5%">Postal Code</th>
                                    <th width="8%">City</th>
                                    <th width="8%">Country</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-customer-address">
                                <?php
                                $no = 1;
                                foreach ($data as $row) {
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $no;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->firstname;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->lastname;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->address1;
                                    echo '</td>';
                                    echo '<td>';
                                    if(!empty($row->postcode))
                                        echo $row->postcode;
                                    else
                                        echo '<p class="text-light-blue">-</p>';
                                    echo '</td>';
                                    echo '<td>';
                                    if(!empty($row->state->name))
                                        echo $row->state->name;
                                    else
                                        echo '<p class="text-light-blue">Not Set</p>';
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->country->iso_code;
                                    echo '</td>';
                                    echo '<td>';

                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->customer_address_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';

                                    if ($update_access == '1' || $delete_access == '1') {
                                        echo '<ul class="dropdown-menu" role="menu">';
                                        if ($update_access == '1') {
                                            echo '<li><a href="update/' . $row->customer_address_id . '"><i class="fa fa-fw fa-pencil"></i> Update</a></li>';
                                        }

                                        if ($delete_access == '1') {
                                            echo '<li><a style="cursor: pointer;" onclick="deletecustomeraddress('.$row->customer_address_id.')"><i class="fa fa-fw fa-trash"></i> Delete</a></li>';
                                        }
                                        echo '</ul></div>';
                                    }

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