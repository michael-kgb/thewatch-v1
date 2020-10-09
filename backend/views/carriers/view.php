<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View Carriers 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Shipping</a></li>
        <li><a href="#">Carriers</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group" style="padding: 2% 0 1% 0;">
                            <div class="col-sm-2">
                                <label for="inputEmail3" class="pull-right">Name : </label>
                            </div>
                            <div class="col-sm-10">
                                <?php echo $model->name; ?>
                            </div>
                        </div>
                        <div class="form-group" style="padding: 0 0 1% 0;">
                            <div class="col-sm-2">
                                <label for="inputEmail3" class="pull-right">URL : </label>
                            </div>
                            <div class="col-sm-10">
                                <?php echo $model->url; ?>
                            </div>
                        </div>
                        <div class="form-group" style="padding: 0 0 1% 0;">
                            <div class="col-sm-2">
                                <label for="inputEmail3" class="pull-right">Free shipping : </label>
                            </div>
                            <div class="col-sm-10">
                                <?php if($model->is_free == 1) echo "Yes"; else echo "No" ?>
                            </div>
                        </div>
                        <div class="form-group" style="padding: 0 0 1% 0;">
                            <div class="col-sm-2">
                                <label for="inputEmail3" class="pull-right">Status : </label>
                            </div>
                            <div class="col-sm-10">
                                <?php if($model->active == 1) echo "Active"; else echo "Inactive" ?>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button onclick="location.href = '<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/carriers/index'" type="button" class="btn btn-info pull-right">View All</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>