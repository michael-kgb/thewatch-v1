<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      View News 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/news/index"><i class="glyphicon glyphicon-bullhorn"></i>News</a></li>
      <li><a href="#">view</a></li>
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
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('news_caption'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->news_caption; ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('news_thumbnail'); ?> : </label>
                      <div class="col-lg-10">
                          <img width="50%" height="50%" src="<?php echo Yii::$app->urlManager->getBaseUrl() . Yii::$app->params['newsAsset'] . $model->news_thumbnail; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('news_video_url'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->news_video_url; ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('news_created_date'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->news_created_date; ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('news_status'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->news_status; ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('news_featured'); ?> : </label>
                      <div class="col-lg-10">
                          <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->news_featured; ?></label>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <button onclick="location.href='<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/news/index'" type="button" class="btn btn-info pull-right">View All</button>
                  </div>
                </form>
              </div><!-- /.box -->
        </div>
    </div>
</section>