<div class="content-wrapper" style="margin-left: 0;">
    
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/dist/img/user2-160x160.jpg" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $profile != NULL ? $profile->fullname : ""; ?></h3>

              <p class="text-muted text-center"><?php echo $profile != NULL ? $profile->departements->departement_name : ""; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Last Login</b> <a class="pull-right"><?php echo $profile != NULL ? date_format(date_create($profile->last_login), 'l, d F Y') : ""; ?></a>
                </li>
                <li class="list-group-item">
                    <b>Created Date</b> 
                    <a class="pull-right">
                        <?php 
                        $unixtime = 000000;
                        if ($profile != NULL){
                            $unixtime = $profile->created_at;
                        }
                        $epoch = $unixtime;
                        $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
                        echo $dt->format('d-M-Y H:i:s'); // output = 2017-01-01 00:00:00
                        ?>
                    </a>
                </li>
<!--                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>-->
              </ul>

              <!--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Activity Log</h3>
            </div>
            <div class="box-body chat" id="chat-box">
                <div class="row">
                    <div class="col-xs-12" style="padding-left: 0; padding-right: 0;">
                        <div class="box" style="border-top: none;">
                            <div class="box-body">
                                <ul class="timeline">

                                    <?php
                                    
                                    $fullname = '';
                                    if($profile != NULL){
                                        $fullname = $profile->fullname;
                                    }
                                    
                                    $log = backend\models\Log::find()->where(['fullname' => $fullname])->orderBy('date_time DESC')->all();
                                    $on_date = "";

                                    foreach ($log as $row) {
                                        $date = date_create($row->date_time);
                                        $date_formated = date_format($date, 'l, d F Y');

                                        if ($on_date != $date_formated) {
                                            $on_date = $date_formated;
                                            ?>
                                            <li class="time-label">
                                                <span class="bg-blue">
                                                    <?php echo $date_formated; ?>
                                                </span>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        <li>
                                            <i class="fa" style="background: url('<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/dist/img/user2-160x160.jpg' );background-size: cover;"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> <?php echo date_format($date, 'g:ia'); ?></span>
                                                <h3 class="timeline-header no-border"><a href="#"><?php echo $row->fullname; ?></a> <b><?php echo $row->action; ?></b> on module <b><?php echo $row->module; ?></b> at ID <a href='view/<?php echo $row->id_onChanged; ?>'><?php echo $row->id_onChanged; ?></a></h3>
                                                                                        <div class="timeline-body">
                                                                                                <?php echo $row->action_text; ?>
                                                                                        </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
            <!-- /.chat -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>