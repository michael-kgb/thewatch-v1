<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Brands Category
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Catalogue</a></li>
        <li><a href="#">Brands Category</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Brand Category</th>
                                    <th>Brands</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($data as $row) {
                                    $product_category_brands = \backend\models\ProductCategoryBrands::find()->where(['product_category_category_id' => $row->product_category_id])->all();
                                ?>
                                    <?php
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $no;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->product_category_name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo count($product_category_brands);
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;update/' . $row->product_category_id . '&#39;"><i class="fa fa-fw fa-pencil"></i> update</button></div>';
                                     // echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;update2/' . $row->product_category_id . '&#39;"><i class="fa fa-fw fa-pencil"></i> update menu</button></div>';
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