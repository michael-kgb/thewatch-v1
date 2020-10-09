<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <!--<li class="<?php echo Yii::$app->controller->id == "dashboard" ? "active" : "" ?> treeview">
        <a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/dashboard/index">
            <i class="glyphicon glyphicon-home"></i> <span>Home</span> 
        </a>
    </li>-->

    <?php
    $modulegroup = \backend\models\ModuleGroup::find()->orderBy('show_number ASC')->all();
    $controller = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
    $controller_group = \backend\models\ModuleGroup::findOne($controller->module_group_id);
    $permissions = backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'view_access' => '1'])->all();

    foreach ($modulegroup as $row) {
        ?>
        <li <?php echo $controller_group->module_group_id == $row->module_group_id ? "class='active treeview'" : "" ?>>
            <a href="#">
                <i class="<?php echo $row->glyphicon; ?>"></i> <span><?php echo $row->module_group_name; ?></span> 
            </a>
            <ul class="treeview-menu">
                <?php
                $module = \backend\models\Module::find()->where(['module_group_id' => $row->module_group_id])->orderBy('show_number ASC')->all();
                foreach ($module as $roww) {
                    $permissions = backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $roww->id, 'view_access' => '1'])->one();
                    if (count($permissions) > 0) {
                        ?>
                        <li <?php echo $controller->id == $roww->id ? "class='active'" : "" ?>><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/<?php echo $roww->module_controller; ?>/index"><?php echo $roww->module_name; ?></a></li>
                        <?php
                    }
                }
                ?>
            </ul>
        </li>
        <?php
    }
    ?>
</ul>