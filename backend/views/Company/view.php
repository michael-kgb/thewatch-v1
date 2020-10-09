<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      View Company 
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
      <li><a href="#">Company</a></li>
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
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('company_logo'); ?> : </label>
                      <div class="col-lg-10">
                          <img width="50%" height="50%" src="<?php echo Yii::$app->urlManager->getBaseUrl() . Yii::$app->params['logoAsset'] . $model->company_logo; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('company_name'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->company_name; ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('company_email'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->company_email; ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('company_address'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->company_address; ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('company_phone'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->company_phone; ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('company_status'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->company_status; ?></label>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <button onclick="location.href='<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/company/index'" type="button" class="btn btn-info pull-right">View All</button>
                  </div>
                </form>
              </div><!-- /.box -->
        </div>
    </div>
</section>