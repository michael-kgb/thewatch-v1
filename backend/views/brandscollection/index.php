<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Brands Collection 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Catalogue</a></li>
        <li><a href="#">Brands Collection</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/brandscollection/create'">Add New</button>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Brand Name</th>
                                    <th>Collection Name</th>
                                    <th>Total Product</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php
                                foreach ($data as $row) {
                                    $brand = backend\models\Brands::findOne($row->brands_brand_id);
                                    $product = \backend\models\Product::find()->where(['brands_collection_id' => $row->brands_collection_id])->all();
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $no;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $brand->brand_name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->brands_collection_name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo count($product);
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->brands_collection_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
                                    echo '<ul class="dropdown-menu" role="menu">';
                                    echo '<li><a href="update/' . $row->brands_collection_id . '"><i class="fa fa-fw fa-pencil"></i> Edit</a></li>';
                                    echo '<li><a style="cursor:pointer;" onclick="deletebrandcollection('.$row->brands_collection_id.')"><i class="fa fa-fw fa-trash"></i> Delete</a></li>';
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