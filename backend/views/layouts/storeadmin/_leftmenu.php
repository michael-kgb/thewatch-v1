<?php 

use \backend\models\Permissions;

?>
<script>
isAdminService = <?php echo Yii::$app->session->get('userInfo')['group_id'] == 6 ? "true" : "false"; ?>;
</script>
<ul class="metismenu" id="side-menu">
	<li class="menu-title">Navigation</li>
	
	<?php 
		$permissions = Permissions::find()
			->leftJoin('module', 'module.id = permissions.module_id')
			->orderBy("module.module_group_id, module.module_parent, module.show_number ASC")
			->where(["permissions.group_id" => Yii::$app->session->get('userInfo')['group_id']])
			->andWhere(["view_access"=>1,"add_access"=>1,"update_access"=>1,"delete_access"=>1])
			->all(); 
		$moduleGroupId = 0;
		$i = 1;
		$totalModule = 0;
	?>
	
	<?php if(count($permissions) > 0){ ?>
	<?php foreach($permissions as $permission){ ?>
		<?php if($permission->module->module_parent == 0){ ?>
	<li class="<?php echo Yii::$app->controller->id == $permission->module->module_controller ? "active" : ""; ?>">
		<a href="javascript: void(0);" aria-expanded="<?php echo Yii::$app->controller->id == $permission->module->module_controller ? "true" : "false"; ?>"><i class="<?php echo $permission->module->material_design_icon; ?>"></i> <span> <?php echo $permission->module->module_name; ?> </span> <span class="menu-arrow"></span></a>
		<ul class="nav-second-level" aria-expanded="<?php echo Yii::$app->controller->id == $permission->module->module_controller ? "true" : "false"; ?>">
		<?php } else { ?>
			<li class="<?php echo Yii::$app->controller->id == $permission->module->module_controller ? "active" : ""; ?>"><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() . '/' . $permission->module->module_controller; ?>"><?php echo $permission->module->module_name; ?></a></li>
		<?php } ?>
	<?php if($permission->module->module_position == "last"){ ?>
		</ul>
	</li>
	<?php } ?>
	<?php } ?>
	<?php } ?>

</ul>