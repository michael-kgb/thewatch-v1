<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Branches 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Administration</a></li>
        <li><a href="#">Branches</a></li>
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
                    <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/branches/create'">Add New</button>
                    <?php
                }
                ?>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="user" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Company Name</th>
                                    <th>Branch Name</th>
                                    <th>Branch Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php
                                foreach ($data as $row) {
                                    $company = backend\models\Companies::findOne($row->companies_company_id);
                                    ?>
                                    <?php
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $no;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $company->company_name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->branch_name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->branch_address;
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->branch_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';

                                    if ($update_access == '1' || $delete_access == '1') {
                                        echo '<ul class="dropdown-menu" role="menu">';
                                        if ($update_access == '1') {
                                            echo '<li><a href="update/' . $row->branch_id . '"><i class="fa fa-fw fa-pencil"></i> Update</a></li>';
                                        }

                                        if ($delete_access == '1') {
                                            echo '<li><a href="#"><i class="fa fa-fw fa-trash"></i> Delete</a></li>';
                                        }

                                        echo '</ul></div>';
                                    }
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