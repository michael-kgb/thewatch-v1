<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Seo Setting 
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
      <li><a href="#">Seo Setting</a></li>
    </ol>
</section>

<section class="content">
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-info" onclick="location.href='<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/seosetting/create'">Add New</button>
          <div class="box" style="margin-top: 20px;">
            <div class="box-body">
              <table id="homebanner" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Page Location</th>
                    <th>Meta Title</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach($data as $row){ ?>
                        <?php 
                            echo '<tr>';
                            echo '<td>'; 
                            echo $no;
                            echo '</td>';
                            echo '<td>'; 														if($row->seoPages->seo_pages_name == 'Brands'){								echo $row->seoPages->seo_pages_name . ' - ' . \backend\models\SeoPagesContentBrands::findOne(['seo_pages_content_id' => $row->seo_pages_content_id])->brands->brand_name;							} else {								echo $row->seoPages->seo_pages_name;							}
                            echo '</td>';
                            echo '<td>'; 
                            echo $row->seo_pages_meta_title;
                            echo '</td>';
                            echo '<td>'; 
                            echo '<div class="btn-group">'
                                . '<a href="' . \yii\helpers\Url::base() . '/seosetting/view/' . $row->seo_pages_content_id . '" class="btn btn-default"><i class="fa fa-fw fa-search"></i> Preview</a>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                    <li><a href="' . \yii\helpers\Url::base() . '/seosetting/update/' . $row->seo_pages_content_id . '"><i class="fa fa-fw fa-edit"></i> Edit</a></li>
                                    <li><a href="' . \yii\helpers\Url::base() . '/seosetting/delete/' . $row->seo_pages_content_id . '"><i class="fa fa-fw fa-trash"></i> Delete</a></li>';
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