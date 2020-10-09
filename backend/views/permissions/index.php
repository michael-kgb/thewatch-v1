<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Permissions 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Administration</a></li>
        <li><a href="#">Permissions</a></li>
    </ol>
</section>

<section class="content-header">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-left">
                <ul class="nav nav-tabs">
                    <?php
                    $no = 0;
                    $group = backend\models\Group::find()->all();
                    foreach ($group as $row) {
                        $no++;
                        ?>
                        <li <?php echo $no == 1 ? "class='active'" : "" ?>><a href="#<?php echo 'menu' . $no; ?>" data-toggle="tab"><?php echo $row->group_name; ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <form method="post" action="index2">
                        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                        <?php
                        $module = \backend\models\Module::find()->orderBy('module_group_id ASC')->all();
                        $count = 0;
                        foreach ($group as $roww) {
                            $count++;
                            ?>

                            <div class="tab-pane <?php echo $count == 1 ? "active" : "" ?>" id="<?php echo 'menu' . $count; ?>">
                                <div class="box-body">
                                    <div class="form-group" style="padding: 2% 0 3% 0;">
                                        <table id="user" class="table table-bordered table-striped">
                                            <thead>
                                                <tr class="bg-black">
                                                    <th>No</th>
                                                    <th>Module Name</th>
                                                    <th width="10%"><input type="checkbox" id="checkboxview<?php echo $roww->id; ?>" onclick="checkboxclick('view', <?php echo $roww->id; ?>)"/> View</th>
                                                    <th width="10%"><input type="checkbox" id="checkboxadd<?php echo $roww->id; ?>"/> Add</th>
                                                    <th width="10%"><input type="checkbox" id="checkboxupdate<?php echo $roww->id; ?>"/> Update</th>
                                                    <th width="10%"><input type="checkbox" id="checkboxdelete<?php echo $roww->id; ?>"/> Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 0;
                                                $group_active = "";
                                                foreach ($module as $row) {
                                                    if($row->module_group_id != $group_active){
                                                        $group_active = $row->module_group_id;
                                                        $modulegroup = backend\models\ModuleGroup::findOne($row->module_group_id);
                                                        echo "<td colspan='6' style='background: #999999; color: #fff;'><b>".$modulegroup->module_group_name."<b></td>";
                                                    }
                                                    $no++;
                                                    $permissions = \backend\models\Permissions::find()->where(array('group_id' => $roww->id, 'module_id' => $row->id))->one();
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo $row->module_name; ?></td>

                                                <input type="hidden" name="<?php echo 'group' . $roww->id . 'module' . $row->id . 'view'; ?>" value="0">
                                                <input type="hidden" name="<?php echo 'group' . $roww->id . 'module' . $row->id . 'add'; ?>" value="0">
                                                <input type="hidden" name="<?php echo 'group' . $roww->id . 'module' . $row->id . 'update'; ?>" value="0">
                                                <input type="hidden" name="<?php echo 'group' . $roww->id . 'module' . $row->id . 'delete'; ?>" value="0">

                                                <td><input type="checkbox" id="checkboxgroup<?php echo $row->id;?>moduleview<?php echo $roww->id; ?>" name="<?php echo 'group' . $roww->id . 'module' . $row->id . 'view'; ?>" value="1" <?php echo $permissions['view_access'] == 1 ? "checked" : ""; ?>></td>
                                                <td><input type="checkbox" id="checkboxgroup<?php echo $row->id;?>moduleadd<?php echo $roww->id; ?>" name="<?php echo 'group' . $roww->id . 'module' . $row->id . 'add'; ?>" value="1" <?php echo $permissions['add_access'] == 1 ? "checked" : ""; ?>></td>
                                                <td><input type="checkbox" id="checkboxgroup<?php echo $row->id;?>moduleupdate<?php echo $roww->id; ?>" name="<?php echo 'group' . $roww->id . 'module' . $row->id . 'update'; ?>" value="1" <?php echo $permissions['update_access'] == 1 ? "checked" : ""; ?>></td>
                                                <td><input type="checkbox" id="checkboxgroup<?php echo $row->id;?>moduledelete<?php echo $roww->id; ?>" name="<?php echo 'group' . $roww->id . 'module' . $row->id . 'delete'; ?>" value="1" <?php echo $permissions['delete_access'] == 1 ? "checked" : ""; ?>></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                            <button type="submit" class="btn btn-default pull-right">
                                                <i class="fa fa-save"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </form>
                </div><!-- /tab-content -->
            </div><!-- /tabbable -->
        </div><!-- /col -->
    </div><!-- /row -->
</section><!-- /container -->


<script>
    
    function checkboxclick(action, group_id){
        if(document.getElementById('checkbox' + action + group_id).checked){
            console.log(action + ' - ' + group_id);
        }
    }

</script>