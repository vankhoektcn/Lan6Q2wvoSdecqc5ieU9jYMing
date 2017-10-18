@inject('config', 'App\Config')
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" type="image/png" href="/backend/img/favicon.png" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="/backend/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="/backend/plugins/font-awesome/css/font-awesome.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="/backend/plugins/iCheck/square/green.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="/backend/plugins/select2/select2.min.css">
	<!-- toastr -->
	<link rel="stylesheet" href="/backend/plugins/toastr/toastr.min.css">
	<!-- Datatables -->
	<link rel="stylesheet" href="/backend/plugins/datatables/css/dataTables.bootstrap.min.css">
	<!-- bootstrap-fileinput -->
	<link href="/backend/plugins/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
	<!-- datepicker -->
	<link href="/backend/plugins/datepicker/datepicker3.css" media="all" rel="stylesheet" type="text/css" />
	@yield('plugins.css')
	<!-- Theme style -->
	<link rel="stylesheet" href="/backend/css/AdminLTE.min.css">
	<link rel="stylesheet" href="/backend/css/skins/skin-green.min.css">
	<link rel="stylesheet" href="/backend/css/customize.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition skin-green sidebar-mini fixed">
	<div class="wrapper">

		<!-- Main Header -->
		<header class="main-header">

			<!-- Logo -->
			<a href="{{ route('dashboard.index') }}" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>C</b>MS</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>Admin</b>CMS</span>
			</a>

			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- Messages: style can be found in dropdown.less-->
						<li class="dropdown messages-menu hide">
							<!-- Menu toggle button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-envelope-o"></i>
								<span class="label label-success">4</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header">You have 4 messages</li>
								<li>
									<!-- inner menu: contains the messages -->
									<ul class="menu">
										<li><!-- start message -->
											<a href="#">
												<div class="pull-left">
													<!-- User Image -->
													<img src="/backend/img/user2-160x160.jpg" class="img-circle" alt="User Image">
												</div>
												<!-- Message title and timestamp -->
												<h4>
													Support Team
													<small><i class="fa fa-clock-o"></i> 5 mins</small>
												</h4>
												<!-- The message -->
												<p>Why not buy a new awesome theme?</p>
											</a>
										</li>
										<!-- end message -->
									</ul>
									<!-- /.menu -->
								</li>
								<li class="footer"><a href="#">See All Messages</a></li>
							</ul>
						</li>
						<!-- /.messages-menu -->

						<!-- Notifications Menu -->
						<li class="dropdown notifications-menu hide">
							<!-- Menu toggle button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i>
								<span class="label label-warning">10</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header">You have 10 notifications</li>
								<li>
									<!-- Inner Menu: contains the notifications -->
									<ul class="menu">
										<li><!-- start notification -->
											<a href="#">
												<i class="fa fa-users text-aqua"></i> 5 new members joined today
											</a>
										</li>
										<!-- end notification -->
									</ul>
								</li>
								<li class="footer"><a href="#">View all</a></li>
							</ul>
						</li>
						<!-- Tasks Menu -->
						<li class="dropdown tasks-menu hide">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-flag-o"></i>
								<span class="label label-danger">9</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header">You have 9 tasks</li>
								<li>
									<!-- Inner menu: contains the tasks -->
									<ul class="menu">
										<li><!-- Task item -->
											<a href="#">
												<!-- Task title and progress text -->
												<h3>
													Design some buttons
													<small class="pull-right">20%</small>
												</h3>
												<!-- The progress bar -->
												<div class="progress xs">
													<!-- Change the css width attribute to simulate progress -->
													<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
														<span class="sr-only">20% Complete</span>
													</div>
												</div>
											</a>
										</li>
										<!-- end task item -->
									</ul>
								</li>
								<li class="footer">
									<a href="#">View all tasks</a>
								</li>
							</ul>
						</li>
						<!-- User Account Menu -->
						<li class="dropdown user user-menu">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<!-- The user image in the navbar-->
								<img src="/backend/img/user2-160x160.jpg" class="user-image" alt="{{ Auth::user()->getFullname() }}">
								<!-- hidden-xs hides the username on small devices so only the image appears. -->
								<span class="hidden-xs">{{ Auth::user()->getFullname() }}</span>
							</a>
							<ul class="dropdown-menu">
								<!-- The user image in the menu -->
								<li class="user-header">
									<img src="/backend/img/user2-160x160.jpg" class="img-circle" alt="{{ Auth::user()->getFullname() }}">

									<p>
										{{ Auth::user()->getFullname() }} - {{ Auth::user()->job_title }}
										<small>{{ date_format(Auth::user()->created_at, 'd/m/Y') }}</small>
									</p>
								</li>
								<!-- <li class="user-body">
									<div class="row">
										<div class="col-xs-4 text-center">
											<a href="#">Followers</a>
										</div>
										<div class="col-xs-4 text-center">
											<a href="#">Sales</a>
										</div>
										<div class="col-xs-4 text-center">
											<a href="#">Friends</a>
										</div>
									</div>
								</li> -->
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="{{ route('users.profile') }}" class="btn btn-success btn-flat">Tài khoản</a>
									</div>
									<div class="pull-right">
										<a href="{{ url('/logout') }}" class="btn btn-warning btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
										<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
									</div>
								</li>
							</ul>
						</li>
						<!-- Control Sidebar Toggle Button -->
						<li class="hide">
							<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			@include('backend.partials.sidebar')
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			@yield('content.head')
			
			<!-- Main content -->
			<section class="content">

				@yield('content')

			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- To the right -->
			<div class="pull-right hidden-xs">
				Phát triển bởi <a href="http://ketnoimoi.com" target="_blank">ketnoimoi.com</a>
			</div>
			<!-- Default to the left -->
			<strong>Copyright &copy; 2016 {{ $config->getValueByKey('site_name') }}.</strong> All rights reserved.
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Create the tabs -->
			<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
				<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
				<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Home tab content -->
				<div class="tab-pane active" id="control-sidebar-home-tab">
					<h3 class="control-sidebar-heading">Recent Activity</h3>
					<ul class="control-sidebar-menu">
						<li>
							<a href="javascript::;">
								<i class="menu-icon fa fa-birthday-cake bg-red"></i>

								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

									<p>Will be 23 on April 24th</p>
								</div>
							</a>
						</li>
					</ul>
					<!-- /.control-sidebar-menu -->

					<h3 class="control-sidebar-heading">Tasks Progress</h3>
					<ul class="control-sidebar-menu">
						<li>
							<a href="javascript::;">
								<h4 class="control-sidebar-subheading">
									Custom Template Design
									<span class="pull-right-container">
										<span class="label label-danger pull-right">70%</span>
									</span>
								</h4>

								<div class="progress progress-xxs">
									<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
								</div>
							</a>
						</li>
					</ul>
					<!-- /.control-sidebar-menu -->

				</div>
				<!-- /.tab-pane -->
				<!-- Stats tab content -->
				<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
				<!-- /.tab-pane -->
				<!-- Settings tab content -->
				<div class="tab-pane" id="control-sidebar-settings-tab">
					<form method="post">
						<h3 class="control-sidebar-heading">General Settings</h3>

						<div class="form-group">
							<label class="control-sidebar-subheading">
								Report panel usage
								<input type="checkbox" class="pull-right" checked>
							</label>

							<p>
								Some information about this general settings option
							</p>
						</div>
						<!-- /.form-group -->
					</form>
				</div>
				<!-- /.tab-pane -->
			</div>
		</aside>
		<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
	immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="/backend/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/backend/bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="/backend/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/backend/plugins/fastclick/fastclick.js"></script>
<!-- Bootbox -->
<script src="/backend/plugins/bootbox/bootbox.min.js"></script>
<!-- toastr -->
<script src="/backend/plugins/toastr/toastr.min.js"></script>
<!-- iCheck -->
<script src="/backend/plugins/iCheck/icheck.min.js"></script>
<!-- Select2 -->
<script src="/backend/plugins/select2/select2.full.min.js"></script>
<!-- blockUI -->
<script src="/backend/plugins/blockUI/jquery.blockUI.js"></script>
<!-- numbro 1.9.0 -->
<script src="/backend/plugins/numbro/numbro.min.js"></script>
<script src="/backend/plugins/numbro/languages.min.js"></script>
<!-- moment -->
<script src="/backend/plugins/moment/moment-with-locales.min.js"></script>
<!-- Cookie -->
<script src="/backend/plugins/cookie/js.cookie.js"></script>
<!-- Datatables -->
<script src="/backend/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/backend/plugins/datatables/js/dataTables.bootstrap.min.js"></script>
<!-- bootstrap-fileinput -->
<script src="/backend/plugins/bootstrap-fileinput/js/fileinput.min.js"></script>
<!-- CK Editor -->
<script src="/backend/plugins/ckeditor/ckeditor.js"></script>
<script src="/backend/plugins/ckeditor/config.js"></script>

<!-- datepicker -->
<script src="/backend/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
//The final solution code for all bugs ckeditor in twitter bootstrap3' modal
$.fn.modal.Constructor.prototype.enforceFocus = function() {
		var $modalElement = this.$element;
		$(document).on('focusin.modal',function(e) {
				var $parent = $(e.target.parentNode);
				if ($modalElement[0] !== e.target
								&& !$modalElement.has(e.target).length
								&& $(e.target).parentsUntil('*[role="dialog"]').length === 0) {
						$modalElement.focus();
				}
		});
};
</script>
@yield('plugins.js')
<!-- AdminLTE App -->
<script src="/backend/js/app.min.js"></script>

<script src="/backend/js/core.js"></script>
<script src="/backend/js/CDatatable.js"></script>
<script src="/backend/js/CSelect.js"></script>
<script src="/backend/js/CControl.js"></script>
<script src="/backend/js/commons.js"></script>
<script src="{{ route('buildJsHiddenControls') }}"></script>
<script type="text/javascript">
	numbro.culture('vi-VN');
	moment.locale('vi');
</script>
@yield('javascript.customize')
</body>
</html>
