<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      News 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Yii::$app->urlManager->getBaseUrl() . "/news/index"; ?>"><i class="glyphicon glyphicon-bullhorn"></i>News</a></li>
      <li><a href="#">Index</a></li>
    </ol>
</section>

<section class="content">
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-info" onclick="location.href='<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/news/create'">Add New</button>
          <div class="box" style="margin-top: 20px;">
            <div class="box-body">
              <table id="news" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>News Name</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th>Publish Date</th>
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
                            echo '<td>'; 
                            echo $row->news_caption;
                            echo '</td>';
                            echo '<td>'; 
                            echo $row->news_status;
                            echo '</td>';
                            echo '<td>'; 
                            echo $row->news_featured;
                            echo '</td>';
                            echo '<td>'; 
                            echo $row->news_publish_date;
                            echo '</td>';
                            echo '<td>'; 
                            echo '<div class="btn-group">
                                  <button onclick="viewRecord('.$row->news_id.', news)" type="button" class="btn btn-default">
                                  <i class="fa fa-search"></i></button></div>';
                            echo '<div class="btn-group">
                                  <button onclick="updateRecord('.$row->news_id.', news)" type="button" class="btn btn-default">
                                  <i class="fa fa-edit"></i></button></div>';
                            echo '<div class="btn-group">
                                  <button type="button" class="btn btn-default" onclick="deleteRecord('.$row->news_id.', news);">
                                  <i class="fa fa-trash"></i></button></div>';
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
