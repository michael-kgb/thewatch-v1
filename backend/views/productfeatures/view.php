<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View Product Features: <?php echo $model->feature_name; ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Catalogue</a></li>
        <li><a href="#">Product Features</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php
            if ($add_access == 1) {
                ?>
                <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/productfeatures/addfeaturevalue/<?php echo $model->feature_id; ?>'">Add New</button>
                <?php
            }
            ?>
            <br/><br/>
            <div class="box">
                <div class="box-body">
                    <table id="data-grid" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Feature Name</th>
                                <th>Feature Value Name</th>
                                <th>Feature Value Variables</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data = backend\models\ProductFeatureValue::find()->where(['feature_id' => $model->feature_id])->all();
                            foreach ($data as $row) {
                                $value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->all();

                                echo '<tr>';
                                echo '<td>';
                                echo $no;
                                echo '</td>';
                                echo '<td>';
                                echo $model->feature_name;
                                echo '</td>';
                                echo '<td>';
                                echo $row->feature_value_name;
                                echo '</td>';
                                echo '<td>';
                                echo $row->feature_value_value;
                                echo '</td>';
                                echo '<td>';
                                echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;../updatefeaturevalue/' . $row->feature_value_id . '&#39;"><i class="fa fa-fw fa-pencil"></i> Edit</button><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
                                echo '<ul class="dropdown-menu" role="menu">';
                                if ($delete_access == 1) {
                                    echo '<li><a href="#" onclick="javascript:location.href=&#39;../deletefeaturevalue/' . $row->feature_value_id . '&#39;"><i class="fa fa-fw fa-trash"></i> Delete</a></li>';
                                }
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
