<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Brands 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Catalogue</a></li>
        <li><a href="#">Brands</a></li>
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
                    <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/brands/create'">Add New</button>
                    <?php
                }
                ?>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Brand Name</th>
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
                                    echo $row->brand_name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->brand_status;
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->brand_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
                                    echo '<ul class="dropdown-menu" role="menu">';
                                    if ($update_access == 1) {
                                        echo '<li><a href="update/' . $row->brand_id . '"><i class="fa fa-fw fa-pencil"></i> Update</a></li>';
                                    }
                                    if ($delete_access == 1) {
                                        echo '<li><a style="cursor:pointer;" onclick="deleteBrand(' . $row->brand_id . ')"><i class="fa fa-fw fa-trash"></i> Delete</a></li>';
                                    }
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