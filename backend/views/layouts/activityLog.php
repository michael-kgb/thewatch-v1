<section class="content">
    <!-- Main content -->
    <section class="content">
        <span style="font-size: 18px;">Activity Log</span>
        <div class="row">
            <div class="col-xs-12" style="padding-left: 0; padding-right: 0;">
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <ul class="timeline">

                            <?php
                            $log = backend\models\Log::find()->where(['module' => $module, 'id_onChanged' => $orders_id])->orderBy('date_time DESC')->limit(25)->all();
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
    </section><!-- /.content -->
</section>