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
                    <li><a href="index">Payment List</a></li>
                    <li class="active"><a href="reminder" data-toggle="tab" class="active">Invoice Reminder</a></li>
                  <!--   <li><a href="#warranty">OFFICIAL PARTNER</a></li>
                    <li><a href="#seo" data-toggle="tab">#TakeTime Content</a></li> -->

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="information">
                        <div class="box-body">
                            
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Invoice Reminder Setting
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
             	<button class="btn btn-info" data-toggle="modal" data-target="#addReminder">Add Reminder</button>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Reminder Name</th>
                                    <th>Reminder Time</th>
									<th>Reminder Periode</th>
									<th>Reminder Subject</th>
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
                                    echo $row->invoice_reminder_name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->invoice_reminder_day_to_send . ' Day';
                                    echo '</td>';
									echo '<td>';
									echo $row->invoice_reminder_periode_to_send;
									echo '</td>';
									echo '<td>';
									echo $row->invoice_reminder_subject;
									echo '</td>';
                                    echo '<td>';
                                    echo $row->invoice_reminder_status;
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->invoice_reminder_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button>';
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

<!-- Modal -->
<div id="addReminder" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width: 60%;">

		<!-- Modal content-->
		<div class="modal-content">
			<form class="form-horizontal" role="form" method="post" action="reminder">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Create Invoice Reminder</h4>
			</div>
			<div class="modal-body">
				<div class="form-group" style="padding: 2% 0 3% 0;">
					<div class="col-sm-3"> 
						<label for="inputEmail3" class="control-label pull-left" style="margin-top: 5px;">
							REMINDER NAME
						</label>
					</div>
					<div class="col-sm-9" style="margin-top: 1%;"> 
						<input type="textfield" name="reminder_name" class="col-sm-10" placeholder="Reminder Name">
					</div>
				</div>
				<div class="form-group" style="padding: 2% 0 3% 0;">
					<div class="col-sm-3"> 
						<label for="inputEmail3" class="control-label pull-left" style="margin-top: 5px;">
							WHEN TO SEND?
						</label>
					</div>
					<div class="col-sm-2">
						<select class="form-control" name="day" id="seopage">
							<?php for($i=1; $i <= 31; $i++){ ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-4" style="padding-left: 0;">
						<div class="col-sm-4">
							<label style="margin-top: 5px;">Days</label>
						</div>
						<div class="col-sm-8">
							<select class="form-control" name="whenday" id="seopage">
								<option value="after">After</option>
							</select>
						</div>
					</div>
					<div class="col-sm-3" style="padding-left: 0;">
						<div class="col-sm-12">
							<label style="margin-top: 5px;">Invoice due date</label>
						</div>
					</div>
				</div>
				<div class="form-group" style="padding: 2% 0 3% 0;">
					<div class="col-sm-3"> 
						<label for="inputEmail3" class="control-label pull-left" style="margin-top: 5px;">
							SUBJECT
						</label>
					</div>
					<div class="col-sm-9" style="margin-top: 1%;"> 
						<input type="textfield" name="subject" class="col-sm-10" placeholder="Email Subject">
					</div>
				</div>
				<div class="form-group" style="padding: 2% 0 3% 0;">
					<div class="col-sm-3"> 
						<label for="inputEmail3" class="control-label pull-left" style="margin-top: 5px;">
							STATUS
						</label>
					</div>
					<div class="col-sm-2">
						<select class="form-control" name="status" id="seopage">
							<option value="active">Active</option>
							<option value="inactive">Inactive</option>
						</select>
					</div>
				</div>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-default">Save</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		  </form>
		</div>

	</div>
</div>