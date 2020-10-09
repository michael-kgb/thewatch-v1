<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Countries 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Shipping</a></li>
        <li><a href="#">Country</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php
                if ($add_access == 1) {
                    ?>
                    <button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/country/create'">Add New</button>
                    <?php
                }
                ?>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Country Name</th>
                                    <th>Zone</th>
                                    <th>ISO Code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $names = json_decode(file_get_contents("http://country.io/names.json"), true);
                                ?>
                                <?php foreach ($data as $row) { ?>
                                    <?php
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $no;
                                    echo '</td>';
                                    echo '<td>';
                                    try {
                                        echo $names[$row->iso_code];
                                    } catch (Exception $ex) {
                                        echo "Undefined";
                                    }

                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->zone->name;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row->iso_code;
                                    echo '</td>';
                                    echo '<td>';
                                    if ($row->active == 0)
                                        echo "Inactive";
                                    else
                                        echo "Active";
                                    echo '</td>';
                                    echo '<td>';

                                    echo '<div class="btn-group"><button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;update/' . $row->country_id . '&#39;"><i class="fa fa-fw fa-pencil"></i> Update</button>';

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