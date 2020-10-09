<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      View Homebanner 
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
      <li><a href="#">homebanner</a></li>
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
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('homebanner_name'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->homebanner_name; ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('homebanner_images'); ?> : </label>
                      <div class="col-lg-10">
                          <img width="50%" height="50%" src="/frontend/web/img/homebanner/<?php echo $model->homebanner_images; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('homebanner_description'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->homebanner_description; ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('homebanner_created_date'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->homebanner_created_date; ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('homebanner_sequence'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->homebanner_sequence; ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('homebanner_has_link'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->homebanner_has_link; ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('homebanner_status'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->homebanner_status; ?></label>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <button onclick="location.href='<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/homebannerjewelry/index'" type="button" class="btn btn-info pull-right">View All</button>
                  </div>
                </form>
              </div><!-- /.box -->
        </div>
    </div>
</section>