<?php \Cloudinary::config(array(    "cloud_name" => "thewatch-co",     "api_key" => "517924523584363",     "api_secret" => "xVVa4kXkWCV6T6CGIIS0DemOg28" ));?><!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      Home Banner 
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
      <li><a href="#">Homebanner</a></li>
    </ol>
</section>

<section class="content">
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-info" onclick="location.href='<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/homebanner/create'">Add New</button>
			<button style="float: right;" class="btn btn-info" onclick="location.href='<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/homebanner/sequence'">Homebanner Sequence</button>
          <div class="box" style="margin-top: 20px;">
            <div class="box-body">
              <table id="homebanner" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
					<th>Thumbnail</th>
                    <th>Homebanner Name</th>
                    <th>Landing Page</th>
                    <th>Sequence</th>
                    <th>Status</th>
                    <th>Link</th>
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
                            echo '<img width="200" src="https://www.thewatch.co/frontend/web/img/homebanner/'.$row->homebanner_images.'jpg">';
                            // echo '<img width="200" src="https://thewatch.imgix.net/homebanner/'.$row->homebanner_images.'jpg?auto=compress%2Cformat&amp;fm=pjpg" data-was-processed="true">';
                            echo '</td>';
                            echo '<td>'; 
                            echo $row->homebanner_name;
                            echo '</td>';
                            echo '<td>'; 
                            echo $row->homebanner_description;
                            echo '</td>';
                            echo '<td>'; 
                            echo $row->homebanner_sequence;
                            echo '</td>';
                            echo '<td>'; 
                            echo $row->homebanner_has_link;
                            echo '</td>';
                            echo '<td>'; 
                            echo $row->homebanner_status;
                            echo '</td>';
                            echo '<td>'; 
                            echo '<div class="btn-group">
                                  <button onclick="viewRecord('.$row->homebanner_id.', homebanner)" type="button" class="btn btn-default">
                                  <i class="fa fa-search"></i></button></div>';
                            echo '<div class="btn-group">
                                  <button onclick="updateRecord('.$row->homebanner_id.', homebanner)" type="button" class="btn btn-default">
                                  <i class="fa fa-edit"></i></button></div>';
                            echo '<div class="btn-group">
                                  <button type="button" class="btn btn-default" onclick="deleteRecordss('.$row->homebanner_id.', homebanner);">
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