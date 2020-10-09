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
                    <li ><a href="index" data-toggle="tab">JOIN NOW (IG)</a></li>
                    <li class="active"><a href="reservation">Reservation</a></li>
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
        Timex Reservation
    </h1>
    <ol class="breadcrumb">
        
        <li><a href="#">Timex Reservation</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
             	<!-- <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/timexlandingpage/createig'">Add IG</button> -->
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                   
                                    <th>Email</th>
                                    <th>Date</th>
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
                                    echo $row->timex_reservation_name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->timex_reservation_phone;
                                    echo '</td>';
                                   echo '<td>';
                                    echo $row->timex_reservation_email;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->timex_reservation_date;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->timex_reservation_sended;
                                    echo '</td>';
                                    
                                    echo '<td>';
                                    if($row->timex_reservation_sended == 'Email Sended'){
                                        echo '<a href="send?id='.$row->timex_reservation_id.'&email='.$row->timex_reservation_email.'">Send Email Again</a>';
                                    }else{
                                        echo '<a href="send?id='.$row->timex_reservation_id.'&email='.$row->timex_reservation_email.'">Send Email</a>';
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