<?php 
use backend\models\User;

?>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">My Account</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/warranty">User</a></li>
					<li class="breadcrumb-item"><a href="#">Account</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6 col-lg-3">
			<div class="card m-b-30">
				<img class="card-img-top img-fluid" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/img/users/default.jpg" alt="Card image cap">
				<div class="card-body">
					<h5 class="card-title"><?php echo (Yii::$app->session->get('userInfo')['fullname']); ?></h5>
					<p class="card-text"><?php echo Yii::$app->session->get('userInfo')['departement']; ?></p>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">
						<b>Last Login</b>
						<span class="pull-right" style="font-size: 13px; margin-top: 2px;">19 April 2018 20:58</span>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-md-6 col-lg-9">
			<div class="card-box">
				<ul class="nav nav-tabs tabs-bordered">
					<li class="nav-item">
						<a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
							Profile
						</a>
					</li>
					<li class="nav-item">
						<a href="#activity-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
							Activity
						</a>
					</li>
					<li class="nav-item">
						<a href="#pwd-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
							Change Password
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<?php $userModel = User::findOne(Yii::$app->session->get('userInfo')['user_id']); ?>
					<div class="tab-pane active show" id="profile-b1">
						<form method="POST" action="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/user/account">
						<input type="hidden" name="user_id" value="<?php echo Yii::$app->session->get('userInfo')['user_id']; ?>" />
						<div class="col-md-12"> 
							<div class="form-group row">
								<label class="col-3 col-form-label">Fullname</label>
								<div class="col-9">
									<input type="text" name="fullname" class="form-control" value="<?php echo $userModel->fullname; ?>">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-3 col-form-label">Email Address</label>
								<div class="col-9">
									<input type="email" name="email" class="form-control" value="<?php echo $userModel->email; ?>">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-3 col-form-label">User Role</label>
								<div class="col-9" style="margin-top: 7px;">
									<?php echo $userModel->group->group_name; ?>
								</div>
							</div>
						</div>
						<div class="hidden-print" style="margin-top: 10px;">
							<div class="text-right">
								<button type="submit" class="btn btn-gradient waves-light waves-effect w-md">Update</button>
							</div>
						</div>
						</form>
					</div>
					<div class="tab-pane" id="activity-b1">
						<div class="col-md-12">
							
						</div>
					</div>
					<div class="tab-pane" id="pwd-b1">
						<form method="POST" action="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/user/account">
						<div class="col-md-12">
							<div class="form-group row">
								<label class="col-3 col-form-label">Current Password</label>
								<div class="col-9">
									<input type="password" class="form-control" value="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-3 col-form-label">New Password</label>
								<div class="col-9">
									<input type="password" class="form-control" value="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-3 col-form-label">New Password Confirmation</label>
								<div class="col-9">
									<input type="password" class="form-control" value="">
								</div>
							</div>
						</div>
						<div class="hidden-print" style="margin-top: 10px;">
							<div class="text-right">
								<button type="submit" class="btn btn-gradient waves-light waves-effect w-md">Update</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>