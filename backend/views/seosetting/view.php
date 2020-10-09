<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      View Seo Setting
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Settings</a></li>
      <li><a href="#">Seo Settings</a></li>
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
                            <label for="inputEmail3" class="col-lg-2 control-label">Page : </label>
                            <div class="col-lg-10">
                                <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->seoPages->seo_pages_name; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-2 control-label">Meta Title : </label>
                            <div class="col-lg-10">
                                <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->seo_pages_meta_title; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-2 control-label">Meta Description : </label>
                            <div class="col-lg-10">
                                <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->seo_pages_meta_description; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-2 control-label">Meta Keywords : </label>
                            <div class="col-lg-10">
                                <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->seo_pages_meta_keywords; ?></label>
                            </div>
                        </div>												<div class="form-group">                            <label for="inputEmail3" class="col-lg-2 control-label">SEO Footer Content Left : </label>                            <div class="col-lg-10">                                <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->seo_footer_description_left; ?></label>                            </div>                        </div>												<div class="form-group">                            <label for="inputEmail3" class="col-lg-2 control-label">SEO Footer Content Right : </label>                            <div class="col-lg-10">                                <label for="inputEmail3" class="col-lg-8 control-label" style="text-align: left"><?php echo $model->seo_footer_description_right; ?></label>                            </div>                        </div>
                    </div><!-- /.box-body -->
                  <div class="box-footer">
                      <button onclick="location.href='<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/seosetting/index'" type="button" class="btn btn-info pull-right">View All</button>
                  </div>
                </form>
              </div><!-- /.box -->
        </div>
    </div>
</section>