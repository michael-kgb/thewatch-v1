<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Product Sub Category
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Catalogue</a></li>
        <li><a href="#">Product Sub Category</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/productsubcategory/create'">Add New</button>
                <button style="float: right;" class="btn btn-info" onclick="location.href='<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/productsubcategory/sequence'">Product Category Sequence</button>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Image Mobile</th>
                                    <th>Name</th>
                                    <th>Sequence</th>
                                    <!-- <th>Status</th> -->
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
                                    echo \backend\models\ProductCategory::find()->where(['product_category_id'=>$row->product_category_id])->one()->product_category_name;
                                    echo '</td>';
                                    
                                    echo '<td>';
                                    echo '<img width="200" src="../../../../frontend/web/img/category/'.$row->product_sub_category_image.'">';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<img width="200" src="../../../../frontend/web/img/category/'.$row->product_sub_category_image_mobile.'">';
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->product_sub_category_name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->product_sub_category_sequence;
                                    echo '</td>';
                                   
                                    echo '<td>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->product_sub_category_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
                                    echo '<ul class="dropdown-menu" role="menu">';
                                    echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/productsubcategory/update/' . $row->product_sub_category_id . '"><i class="fa fa-fw fa-pencil"></i> Edit</a></li>';
                                    echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/productsubcategory/delete/' . $row->product_sub_category_id . '"><i class="fa fa-fw fa-trash"></i> Delete</a></li>';
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