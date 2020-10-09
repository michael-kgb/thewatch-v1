<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Homebanner */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content-header">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-left">
                <ul class="nav nav-tabs" id="product_left">
                    <li class="active"><a href="index" data-toggle="tab">JOIN NOW (IG)</a></li>
                    <li><a href="reservation">Reservation</a></li>
                  <!--   <li><a href="#warranty">OFFICIAL PARTNER</a></li>
                    <li><a href="#seo" data-toggle="tab">#TakeTime Content</a></li> -->

                </ul>
                <div class="tab-content">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                    <div class="tab-pane active" id="information">
                        <div class="box-body">
                            
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Instagram
    </h1>
    <ol class="breadcrumb">
        
        <li><a href="#">Instagram</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
             	<button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/timexlandingpage/createig'">Add IG</button>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Url</th>
                                   
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
                                    echo $row->timex_ig_img;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->timex_ig_url;
                                    echo '</td>';
                                   
                                    echo '<td>';
                                    if($row->timex_ig_status == 1){
                                        echo '<div class="btn-group"><button type="button" class="btn btn-warning">Active</button><button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
                                        echo '<ul class="dropdown-menu" role="menu">';
                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/timexlandingpage/approved/' . $row->timex_ig_status . '">Approved</a></li>';
                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/kontes/disapproved/' . $row->timex_ig_status . '">Disapproved</a></li>';
                                        echo '</ul></div>';
                                    }
                                    if($row->timex_ig_status == 0){
                                        echo '<div class="btn-group"><button type="button" class="btn btn-success">Not Active</button><button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
                                        echo '<ul class="dropdown-menu" role="menu">';
                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/kontes/pending/' . $row->timex_ig_status . '">Pending</a></li>';
                                        echo '<li><a style="cursor:pointer;" href="'. \yii\helpers\Url::base() .'/kontes/disapproved/' . $row->timex_ig_status . '">Disapproved</a></li>';
                                        echo '</ul></div>';
                                    }
                              

                                    // echo $row->kontes_seo_status;
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->timex_ig_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button>';
                                    echo '<ul class="dropdown-menu" role="menu">';
                                  
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
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div><!-- /tab-content -->
				<?php echo $this->render('/layouts/activityLog', [ 'module' => Yii::$app->controller->id, 'orders_id' => $model->product_id ]); ?>
            </div><!-- /tabbable -->
        </div><!-- /col -->
    </div><!-- /row -->
</section><!-- /container -->

<script>
    function validation() {
        if (document.getElementById('example2').value != "" && document.getElementById('example1').value == "" || document.getElementById('example1').value != "" && document.getElementById('example2').value == "") {
            alert('New arrival date not valid!');
            return false;
        }
    }
</script>