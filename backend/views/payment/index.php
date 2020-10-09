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
                    <li class="active"><a href="index" data-toggle="tab">Payment List</a></li>
                    <li><a href="reminder">Payment Reminder</a></li>
                  <!--   <li><a href="#warranty">OFFICIAL PARTNER</a></li>
                    <li><a href="#seo" data-toggle="tab">#TakeTime Content</a></li> -->

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="information">
                        <div class="box-body">
                            
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Payment List
    </h1>
    <ol class="breadcrumb">
        <li><a href="#">Payment</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12" style="padding-left: 0;">
             	<button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/payment/create'">Add Payment</button>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bank Name</th>
                                    <th>Payment Gateway Company</th>
									<th>Payment Method</th>
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
                                    echo $row->payment->name_bank;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->payment->payment_gateway_company;
                                    echo '</td>';
									echo '<td>';
									echo $row->paymentMethod->payment_method_name;
									echo '</td>';
                                    echo '<td>';
                                    echo $row->payment->active == 1 ? 'Active' : 'Inactive';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->payment_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button>';
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
                        </div>
                    </div>
                </div><!-- /tab-content -->
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