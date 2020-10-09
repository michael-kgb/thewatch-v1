<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      Users 
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
      <li><a href="#">Users</a></li>
    </ol>
</section>

<section class="content">
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-info" onclick="location.href='<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/user/create'">Add New</button>
          <div class="box" style="margin-top: 20px;">
            <div class="box-body">
              <table id="user" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Email</th>
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
                            echo $row->username;
                            echo '</td>';
                            echo '<td>'; 
                            echo $row->fullname;
                            echo '</td>';
                            echo '<td>'; 
                            echo $row->email;
                            echo '</td>';
                            echo '<td>'; 
                            echo '<div class="btn-group">
                                  <button onclick="javascript:location.href=&#39;view/'.$row->id.'&#39;" type="button" class="btn btn-default">
                                  <i class="fa fa-search"></i></button></div>';
                            echo '<div class="btn-group">
                                  <button onclick="javascript:location.href=&#39;update/'.$row->id.'&#39;" type="button" class="btn btn-default">
                                  <i class="fa fa-edit"></i></button></div>';
                                  echo '<div class="btn-group">
                                  <button onclick="javascript:location.href=&#39;reset/'.$row->id.'&#39;" type="button" class="btn btn-default">
                                  Reset</button></div>';
                            echo '<div class="btn-group">
                                  <button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;delete/'.$row->id.'&#39;">
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

<?php echo $this->render('/layouts/log', [ 'module' => Yii::$app->controller->id]); ?>