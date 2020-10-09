<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View Product Attributes 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Catalogue</a></li>
        <li><a href="#">Product Attributes</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-xs-12">
            <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/productattributes/addattributevalue/<?php echo $model->attribute_id; ?>'">Add New</button>
            <br/><br/>
            <div class="box">
                <div class="box-body">
                    <table id="data-grid" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Attribute Name</th>
                                <th>Attribute Value Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data = backend\models\AttributeValueCombination::find()->where(['attribute_id' => $model->attribute_id])->all();
                            foreach ($data as $row) {
                                $value = backend\models\AttributeValue::find()->where(['attribute_value_id' => $row->attribute_value_id])->one();
                                $product_attribute = \backend\models\ProductAttributeCombination::findAll(['attribute_value_id' => $row->attribute_value_id]);

                                echo '<tr>';
                                echo '<td>';
                                echo $no;
                                echo '</td>';
                                echo '<td>';
                                echo $model->name;
                                echo '</td>';
                                echo '<td>';
                                echo $value['value'];
                                echo '</td>';
                                echo '<td>';
                                echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;../updateattributevalue/' . $row->attribute_value_id . '&#39;"><i class="fa fa-fw fa-pencil"></i> Edit</button><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
                                echo '<ul class="dropdown-menu" role="menu">';
                                echo '<li><a href="#" onclick="delete_attribute_value(' . $row->attribute_value_id . ',' . count($product_attribute) . ')"><i class="fa fa-fw fa-trash"></i> Delete</a></li>';
                                echo '</ul></div>';
                                echo '</td>';
                                echo '</tr>';
                                $no++;
                                ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>