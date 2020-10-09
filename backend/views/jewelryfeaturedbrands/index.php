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
                                    <th>Brand</th>
                                    <th>IMG Large</th>
                                    <th>IMG Square</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($data as $row) {
                                    $brands = \backend\models\Brands::find()->where(['brand_id' => $row->brands_brand_id])->one();
                                ?>
                                    <?php
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $no;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $brands->brand_name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<td><img src='.$row->brand_featured_jewelry_1.'>';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<td><img src='.$row->brand_featured_jewelry_2.'>';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;jewelryfeaturedbrands/update/' . $row->brands_featured_jewelry_id . '&#39;"><i class="fa fa-fw fa-pencil"></i> update</button></div>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;jewelryfeaturedbrands/delete?id=' . $row->brands_featured_jewelry_id . '&#39;"><i class="fa fa-fw fa-pencil"></i> delete</button></div>';
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