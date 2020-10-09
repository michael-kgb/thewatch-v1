<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      View Our People Setting
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Settings</a></li>
      <li><a href="#">Our People Settings</a></li>
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
                            <div class="col-sm-2"> 
                                <label for="inputEmail3" class="control-label pull-right">
                                    Name
                                </label>
                            </div>
                            <div class="col-sm-10">
                                <?php echo $model->our_people_name; ?>
                            </div>
                        </div>
                        
                        <div class="form-group" style="padding: 2% 0 3% 0;">
                            <div class="col-sm-2"> 
                                <label for="inputEmail3" class="control-label pull-right">
                                    Short Description
                                </label>
                            </div>
                            <div class="col-sm-10" style="margin-bottom: 4%;">
                                <?php echo $model->our_people_short_description; ?>
                            </div>
                        </div>

                        <div class="form-group" style="padding: 2% 0 3% 0;">
                            <div class="col-sm-2"> 
                                <label for="inputEmail3" class="control-label pull-right">
                                    Current Profile Picture
                                </label>
                            </div>
                            <div class="col-sm-10" style="margin-bottom: 4%;">
                                <img width="300" src="/frontend/web/img/ourpeople/<?php echo $model->our_people_profile_picture; ?>">
                            </div>
                        </div>
						
						<div class="form-group" style="padding: 2% 0 3% 0;">
                            <div class="col-sm-2"> 
                                <label for="inputEmail3" class="control-label pull-right">
                                    Status
                                </label>
                            </div>
                            <div class="col-sm-10" style="margin-bottom: 4%;">
                                <?php echo $model->our_people_status === 1 ? 'Active' : 'Inactive'; ?>
                            </div>
                        </div>
                        
                        <div class="form-group" style="padding: 2% 0 3% 0;">
                            <div class="col-sm-2"> 
                                <label for="inputEmail3" class="control-label pull-right">
                                    Product List
                                </label>
                            </div>
                            <div class="col-sm-10">
                                <?php 
                                    $productList = \backend\models\OurPeopleProduct::findAll(['our_people_id' => $model->our_people_id]); 
                                    if(count($productList) > 0){
                                        foreach($productList as $product){
                                ?>
                                <a target="_blank" href="https://thewatch.co/product/<?php echo $product->product->productDetail->link_rewrite; ?>"><?php echo $product->product->productDetail->name; ?></a><br>
                                <?php 
                                        } 
                                    } 
                                ?>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                  <div class="box-footer">
                      <button onclick="location.href='<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/ourpeople/index'" type="button" class="btn btn-info pull-right">View All</button>
                  </div>
                </form>
              </div><!-- /.box -->
        </div>
    </div>
</section>