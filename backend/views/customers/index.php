<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Customers 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Customers</a></li>
        <li><a href="#">Customers</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/customers/create'">Add New</button>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-customers" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Social Title</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email Address</th>
                                    <th>Status</th>
                                    <th>Newsletter</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</section>

<?php echo $this->render('/layouts/log', [ 'module' => Yii::$app->controller->id]); ?>