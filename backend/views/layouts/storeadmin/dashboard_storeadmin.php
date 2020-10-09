<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\DashboardstoreAsset;
use yii\helpers\Html;

DashboardstoreAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?= Html::csrfMetaTags() ?>
        <title>Admin Page | <?= Html::encode($this->context->id) ?></title>
        <script>
            var baseUrl = '<?php echo Yii::$app->urlManager->getBaseUrl(); ?>',
				storeUrl = 'https://www.thewatch.co/',
				dataUrl = "",
				isAdminService = false,
				dataColumn = [];
        </script>
        <?php $this->head() ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="<?php echo \Yii::$app->urlManagerFrontEnd->baseUrl; ?>/img/icons/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    </head>
    
    <body>
        <?php $this->beginBody() ?>
        <div class="wrapper">
			
			<div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/orders" class="logo">
                        <span>
                            <img src="https://www.thewatch.co/img/logos/logo-putih-04.png" alt="" height="16">
                        </span>
                    </a>
                </div>

                <nav class="navbar-custom">

                    <ul class="list-unstyled topbar-right-menu float-right mb-0">
                        <li class="dropdown notification-list hide-phone">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                               <i class="mdi mdi-earth"></i> English  <i class="mdi mdi-chevron-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    Indonesia
                                </a>

                            </div>
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <i class="fi-bell noti-icon"></i>
                                <span class="badge badge-danger badge-pill noti-icon-badge">1</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h6 class="m-0"><span class="float-right"><a href="" class="text-dark"><small>Clear All</small></a> </span>Notification</h6>
                                </div>

                                <div class="slimscroll" style="max-height: 190px;">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-success"><i class="mdi mdi-cart"></i></div>
										<?php 
											$connection = Yii::$app->getDb();
											$orderDateFrom = date('Y-m-d');
											$orderDateTo = date('Y-m-d');
											$store_id = Yii::$app->session->get('userInfo')['store_id'];
											$orderDate = "(orders.date_add BETWEEN '".$orderDateFrom." 00:00:00 ' AND '".$orderDateTo." 23:59:00 ')";
											$command = $connection->createCommand("SELECT COUNT(*) AS total FROM orders WHERE store_id = " . $store_id . " AND ".$orderDate." ");
											$data = $command->queryAll();
											
											foreach($data as $row){
												$total_orders = $row['total'];
											}
										?>
                                        <p class="notify-details">You Have <?php echo $total_orders; ?> Order today<small class="text-muted">1 min ago</small></p>
                                    </a>
                                </div>

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                    View all <i class="fi-arrow-right"></i>
                                </a>

                            </div>
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/img/users/default.jpg" alt="user" class="rounded-circle"> <span class="ml-1"><?php echo (Yii::$app->session->get('userInfo')['fullname']); ?> <i class="mdi mdi-chevron-down"></i> </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/user/account" class="dropdown-item notify-item">
                                    <i class="fi-head"></i> <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/dashboard/signout" class="dropdown-item notify-item">
                                    <i class="fi-power"></i> <span>Logout</span>
                                </a>

                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="dripicons-menu"></i>
                            </button>
                        </li>
                        <!--<li class="hide-phone app-search">
                            <form role="search" class="">
                                <input type="text" placeholder="Search..." class="form-control">
                                <a href=""><i class="fa fa-search"></i></a>
                            </form>
                        </li>-->
                    </ul>

                </nav>

            </div>
			
			<!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
						<?php echo $this->render('_leftmenu'); ?>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
			
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
					<?php echo $content; ?>
				</div>
            </div><!-- /.content-wrapper -->
			
        </div><!-- ./wrapper -->
        <?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>
