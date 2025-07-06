<?php
$user_id = $this->session->userdata("user_id");
$profile = $this->profile->profile_info($user_id);
?>
<!DOCTYPE html>
<!-- 
Template Name: AdminUX-Pro - Responsive Admin Dashboard Template build with Bootstrap 4.3.1
Version: 1.0.0
Author: Maxartkiller
Website: https://www.maxartkiller.com/
Contact: info@maxartkiller.com
Follow: www.twitter.com/maxartkiller
Like: www.facebook.com/maxartkiller
Purchase: https://www.maxartkiller.com/
License: You must have a valid license purchased only from maxartkiller.com in order to legally use the theme for your project.
-->
<html lang="en">

<!-- Head tag -->


<!-- Mirrored from maxartkiller.com/website/AdminuxPRO/HTML/pages/dashboard-production.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Nov 2023 07:16:39 GMT -->

<head>
	<meta charset="utf-8" />
	<title>
		<?= $this->conn->company_info('company_name'); ?>
	</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta
		content="Worlds Best Admin UX Dashbaoard PRO version for bootstrap template, Select, Calandar, Report, Charts, Tables etc."
		name="description" />
	<meta content="" name="author" />
	<link rel="shortcut icon" href="<?= $panel_url; ?>assets/img/logoicon.png">

	<!-- g fonts style -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&amp;display=swap" rel="stylesheet">
	<!-- g fonts style ends -->

	<!-- Vendor or 3rd party style -->

	<!-- material icons -->
	<link href="<?= $panel_url; ?>assets/vendor/material-icons/material-icons.css" rel="stylesheet">
	<!-- flags icons -->
	<link href="<?= $panel_url; ?>assets/vendor/flags/css/flag-icon.min.css" rel="stylesheet">
	<!-- daterange picker -->
	<link href="<?= $panel_url; ?>assets/vendor/daterangepicker-master/daterangepicker.css" rel="stylesheet">
	<!-- vector map -->
	<link href="<?= $panel_url; ?>assets/vendor/jquery-toast-plugin-master/dist/jquery.toast.min.css" rel="stylesheet">
	<!-- Toast message -->
	<link href="<?= $panel_url; ?>assets/vendor/jquery-jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet">
	<!-- dataTables picker -->
	<link href="<?= $panel_url; ?>assets/vendor/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="<?= $panel_url; ?>assets/vendor/DataTables-1.10.18/css/responsive.dataTables.min.css" rel="stylesheet">

	<!-- Vendor or 3rd party style ends -->

	<!-- Customized template style mandatory -->
	<link href="<?= $panel_url; ?>assets/css/style-darkblue-dark.css" rel="stylesheet" id="stylelink">
	<!-- Customized template style ends -->
</head>

<!-- Head tag ends -->

<!-- Body -->

<body class="template-bg sidemenu-open">
	<div class="loader container-fluid">
		<div class="row h-100">
			<div class="col-auto align-self-center  mx-auto text-center">
				<div class="loader-ripple">
					<div></div>
					<div></div>
				</div>
				<h2>
					<?= $this->conn->company_info('company_name'); ?>
				</h2>
			</div>
		</div>
	</div>

	<!-- Sidebar starts -->
	<div class="sidebar">
		<!-- Logo sidebar -->
		<a href="#" class="logo">
			<img src="https://maxartkiller.com/website/AdminuxPRO/HTimg/logoicon.svg" alt=""
				class="logo-icon">
			<div class="logo-text">
				<h5 class="fs22 mb-0">
					<?= $this->conn->company_info('company_name'); ?>
				</h5>
				<p class="text-uppercase fs11">User Dashboard</p>
			</div>
		</a>
		<!-- Logo sidebar ends -->

		<!-- Navigation menu sidebar-->
		<h6 class="subtitle fs11">Navigation Menu</h6>

		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link" href="<?= $panel_path . 'dashboard'; ?>"><i
						class="material-icons icon">dashboard</i><span>Dashboard</span></a>
			</li>

		</ul>

		<h6 class="subtitle fs11">Customized</h6>

		<?php
		if ($this->conn->plan_setting('profile_section') == 1) {
			?>
			<ul class="nav flex-column">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="javascript:void(0)"><i
							class="material-icons icon">games</i><span>My Account</span> <i
							class="material-icons arrow">expand_more</i></a>
					<div class="nav flex-column">
						<?php if ($this->conn->plan_setting('welcome_letter') == 1) { ?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'profile/letter'; ?>"><span>Welcome Letter</span></a></div>
							<?php
						}
						if ($this->conn->plan_setting('profile_page') == 1) {
							?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'profile'; ?>"><span>Profile</span></a></div>
						<?php } ?>
						<?php if ($this->conn->plan_setting('profile_page') == 1) { ?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'profile/edit-profile'; ?>"><span>Edit Profile</span></a></div>
						<?php } ?>

						<?php if ($this->conn->plan_setting('id_card') == 1) { ?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'profile/id-card'; ?>"><span>Vcard</span></a></div>
							<?php
						}
						if ($this->conn->plan_setting('change_password') == 1) {
							?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'profile/change-password'; ?>"><span>Change Password</span></a>
							</div>

							<?php
						}
						if ($this->conn->plan_setting('add_account_section') == 1) {
							?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'payment/add-account'; ?>"><span>Account</span></a>
							</div>
						<?php }
						if ($this->conn->plan_setting('change_tx_password') == 1) {
							?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'profile/tx-change-password'; ?>"><span>Change Tx
										Password</span></a></div>
						<?php }
						if ($this->conn->plan_setting('set_tx_password') == 1) {
							?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'profile/set_user_password'; ?>"><span>Set
										Tx Password</span></a></div>

						<?php } ?>

					</div>
				</li>
			</ul>
		<?php } ?>

		<?php
		if ($this->conn->plan_setting('team_section') == 1) {
			?>
			<ul class="nav flex-column">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="javascript:void(0)"><i
							class="material-icons icon">turned_in_not</i><span>My Genealogy</span> <i
							class="material-icons arrow">expand_more</i></a>
					<div class="nav flex-column">
						<?php if ($this->conn->plan_setting('direct_team') == 1) { ?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'team/team-direct'; ?>"><span>Directs</span></a></div>
						<?php } ?>
						<?php if ($this->conn->plan_setting('left_team') == 1) { ?>
							<div class="nav-item"><a class="nav-link" href="<?= $panel_path . 'team/team-left'; ?>"><span>Left
										Team</span></a></div>
						<?php } ?>
						<?php if ($this->conn->plan_setting('right_team') == 1) { ?>
							<div class="nav-item"><a class="nav-link" href="<?= $panel_path . 'team/team-right'; ?>"><span>Right
										team</span></a></div>
						<?php } ?>
						<?php if ($this->conn->plan_setting('generation_team') == 1) { ?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'team/team-generation'; ?>"><span>Generation</span></a></div>
						<?php } ?>
						<?php if ($this->conn->plan_setting('tree') == 1) { ?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'team/team-tree'; ?>"><span>Tree</span></a></div>
						<?php } ?>

					</div>
				</li>
			</ul>
		<?php } ?>

		<?php
		$topup_type = $this->conn->setting('topup_type');
		if ($this->conn->plan_setting('fund_section') == 1 && $topup_type == 'amount') {
			?>
			<ul class="nav flex-column">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="javascript:void(0)"><i
							class="material-icons icon">library_books</i><span>Fund</span> <i
							class="material-icons arrow">expand_more</i></a>
					<div class="nav flex-column">
						 <?php if ($this->conn->plan_setting('add_fund') == 1) { ?>
							<div class="nav-item"><a class="nav-link" href="<?= $panel_path . 'fund/add_fund'; ?>"><span>Deposit By JASMY</span></a></div>
							<div class="nav-item"><a class="nav-link" href="<?= $panel_path . 'fund/fund_add_new_usdt'; ?>"><span>Deposit By USDT</span></a></div>
							<!--<div class="nav-item"><a class="nav-link"-->
									<!--href="<?= $panel_path . 'fund/fund-add-history'; ?>"><span>Add Fund History</span></a></div>-->
						<?php } ?> 
						<?php if ($this->conn->plan_setting('fund_request') == 1) { ?>
							
						<?php } ?>
						<!-- <?php if ($this->conn->plan_setting('transfer_fund') == 1) { ?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'fund/fund-transfer'; ?>"><span>Fund Trasfer</span></a></div>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'fund/transfer-history'; ?>"><span>Fund Trasfer History</span></a>
							</div>
						<?php } ?> -->
						<!-- <?php if ($this->conn->plan_setting('fund_convert') == 1) { ?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'fund/fund-convert'; ?>"><span>Fund Convert</span></a></div>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'fund/convert-history'; ?>"><span>Fund Convert History</span></a>
							</div>
						<?php } ?> -->
						<!--<div class="nav-item"><a class="nav-link"-->
						<!--			href="<?= $panel_path . 'fund/fund-request'; ?>"><span>Fund Request</span></a></div>-->
						<!--	<div class="nav-item"><a class="nav-link"-->
						<!--			href="<?= $panel_path . 'fund/request_history'; ?>"><span>Fund Request History</span></a>-->
						<!--	</div>-->
					</div>
				</li>
			</ul>
		<?php } ?>

		<h6 class="subtitle fs11">Controls</h6>
		<ul class="nav flex-column">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="javascript:void(0)"><i
						class="material-icons icon">favorite</i><span>Payout Reports</span> <i
						class="material-icons arrow">expand_more</i></a>
				<div class="nav flex-column">
					<?php
					$reg_plan = $this->session->userdata('reg_plan');

					$all_income = $this->conn->runQuery('*', 'wallet_types', "wallet_type='income' and status='1' and $reg_plan='1' ");
					if ($all_income) {
						foreach ($all_income as $income) {
							?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'income/details?source=' . $income->slug; ?>"><span>
										<?= $income->name; ?>
									</span></a>
							</div>
						<?php }
					} ?>
				</div>
			</li>
		</ul>

		<!-- <?php
		if ($this->conn->plan_setting('invest_section') == 1) {
			?>
			<ul class="nav flex-column">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="javascript:void(0)"><i
							class="material-icons icon">poll</i><span>Topup</span> <i
							class="material-icons arrow">expand_more</i></a>
					<div class="nav flex-column">
						<?php if ($this->conn->plan_setting('investment') == 1) { ?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'invest/investment'; ?>"><span>Member Topup</span></a></div>
						<?php } ?>
						<?php if ($this->conn->plan_setting('reinvestment') == 1) { ?>
							<div class="nav-item"><a class="nav-link"
									href="<?= $panel_path . 'invest/reinvestment'; ?>"><span>Upgrade</span></a></div>
						<?php } ?>
					</div>
				</li>
			</ul>
		<?php } ?> -->

		<?php //if ($this->conn->plan_setting('withdraw_fund') == 1 && $this->conn->setting('earning_type') == 'withdrawal') { ?>
			<ul class="nav flex-column">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="javascript:void(0)"><i
							class="material-icons icon">storage</i><span>Withdrawal</span> <i
							class="material-icons arrow">expand_more</i></a>
					<div class="nav flex-column">
				
						<div class="nav-item"><a class="nav-link"
								href="<?= $panel_path . 'transactions/withdrawals'; ?>"><span>Withdrawal Report</span></a>
						</div>

					</div>
				</li>
			</ul>
		<?php //} ?>

		<h6 class="subtitle fs11">Layout</h6>
		<ul class="nav flex-column">
			<?php
			if ($this->conn->plan_setting('order_section') == 1) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $panel_path . 'orders'; ?>"><i
							class="material-icons icon">filter_none</i><span>Orders</span></a>
				</li>
			<?php } ?>

			<?php
			if ($this->conn->plan_setting('reward_section') == 1) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $panel_path . 'team/reward'; ?>"><i
							class="material-icons icon">style</i><span>Reward</span></a>
				</li>
			<?php } ?>


			<li class="nav-item">
				<a class="nav-link"
					href="<?php echo $right_link = base_url('register?ref=' . $profile->username); ?>"><i
						class="material-icons icon">web</i><span>Register New User</span></a>
			</li>

			<?php
			if ($this->conn->plan_setting('income_report_section') == 1) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $panel_path . '/report/income'; ?>"><i class="material-icons icon">event_note</i><span>Report</span></a>
				</li>
			<?php } ?>

			<?php
			if ($this->conn->plan_setting('news_alert_section') == 1) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $panel_path . 'profile/news'; ?>"><i class="material-icons icon">border_all</i><span>News & Event</span></a>
				</li>
			<?php } ?>

			<?php
			if ($this->conn->plan_setting('support_section') == 1) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $panel_path . 'support'; ?>"><i class="material-icons icon">settings_applications</i><span>Support</span></a>
				</li>
			<?php } ?>

			<li class="nav-item">
				<a class="nav-link" href="<?= $panel_path . 'logout'; ?>"><i
						class="material-icons icon">web</i><span>Logout</span></a>
			</li>
		</ul>




		<!-- Navigation menu sidebar ends -->

		<!-- Setting link -->

		<!-- Setting link -->
	</div>
	<!-- Sidebar ends -->

	<!-- wrapper starts -->
	<div class="wrapper">
		<div class="content shadow-sm">

			<div class="container-fluid header-container">
				<div class="row header">
					<div class="container-fluid " id="header-container">
						<div class="row">
							<!-- Header starts -->
							<nav class="navbar col-12 navbar-expand ">
								<button class="menu-btn btn btn-link btn-sm" type="button">
									<i class="material-icons">menu</i>
								</button>
								<div class="collapse navbar-collapse" id="navbarSupportedContent">
									<!-- search starts -->
									
									<!-- search ends -->

									

									<!-- icons dropwdowns starts -->
									<ul class="navbar-nav ml-auto">
										<!-- profile dropdown-->
										<li class="nav-item dropdown ml-0 ml-sm-4">
											<a class="nav-link dropdown-toggle profile-link" href="#"
												id="navbarDropdown6" role="button" data-toggle="dropdown"
												aria-haspopup="true" aria-expanded="false">
												<figure class="rounded avatar avatar-30" style="width: 20px; min-width: 20px;">
												<?php  if($profile->img!=''){?>
                                                        <img src="<?=base_url('images/users/').$profile->img;?>" alt="images">
                                                        <?php }else{ ?>
                                                        <img src="<?= $this->conn->company_info('logo');?>" alt="images">
                                                <?php } ?>
												</figure>
												
												<div class="username-text ml-2 mr-2 d-none d-lg-inline-block">
													<h6 class="username"><span>Welcome,</span><?= $this->session->userdata('profile')->name; ?></h6>
												</div>
												<figure class="rounded avatar avatar-30 d-none d-md-inline-block">
													<i class="material-icons">expand_more</i>
												</figure>
											</a>
											<div class="dropdown-menu dropdown-menu-right w-300 pt-0 overflow-hidden"
												aria-labelledby="navbarDropdown6">
												<div class="position-relative text-center rounded py-5">
													<div class="background">
														<img src="<?= $panel_url; ?>assets/img/background-part.png"
															alt="">
													</div>
												</div>
												<div class="text-center mb-3 top-60 z-2">
													<figure class="avatar avatar-120 mx-auto shadow"><?php  if($profile->img!=''){?>
                                                        <img src="<?=base_url('images/users/').$profile->img;?>" alt="images">
                                                        <?php }else{ ?>
                                                        <img src="<?= $this->conn->company_info('logo');?>" alt="images">
                                                <?php } ?>
													</figure>
												</div>
												<h5 class="text-center mb-0">	<?= $this->session->userdata('profile')->name; ?></h5>
												<p class="text-center">	<?= $this->session->userdata('profile')->username; ?></p>
												<p class="text-center   fs13"><?= $profile->name; ?>, <?= $profile->country; ?></p>
												<a class="dropdown-item border-top" href="<?= $panel_path . 'profile'; ?>">
													<div class="row">
														<div class="col-auto align-self-center">
															<i class="material-icons text-success">account_box</i>
														</div>
														<div class="col pl-0">
															<p class="mb-0">My Profile</p>
															<p class="small text-mute text-trucated">Update details and
																information</p>
														</div>
														<div class="col-auto align-self-center text-right pl-0">
															<i class="material-icons text-mute small">chevron_right</i>
														</div>
													</div>
												</a>
												<a class="dropdown-item border-top" href="#">
													<div class="row">
														<div class="col-auto align-self-center">
															<i
																class="material-icons text-info">account_balance_wallet</i>
														</div>
														<div class="col pl-0">
															<p class="mb-0">My Wallet</p>
															<p class="small text-mute text-trucated">Add Money or
																withdrow</p>
														</div>
														<div class="col-auto align-self-center text-right pl-0">
															<i class="material-icons text-mute small">chevron_right</i>
														</div>
													</div>
												</a>
												
												<a class="dropdown-item border-top" href="<?= $panel_path . 'logout'; ?>">
													<div class="row">
														<div class="col-auto align-self-center">
															<i class="material-icons text-danger">exit_to_app</i>
														</div>
														<div class="col pl-0">
															<p class="mb-0 text-danger">Logout</p>
														</div>
														<div class="col-auto align-self-center text-right pl-0">
															<i
																class="material-icons text-mute small text-danger">chevron_right</i>
														</div>
													</div>
												</a>
											</div>
										</li>
									</ul>
									<!-- icons dropwdowns starts -->
								</div>
							</nav>
							<!-- Header ends -->
						</div>
					</div>
				</div>
				<div class="row submenu">
					<div class="container-fluid " id="submenu-container">
						<div class="row">
							<!-- Submenu section starts -->
							<nav class="navbar col-12 ">
								<div class="dropdown mr-auto d-flex d-sm-none">
									<button class="btn dropdown-toggle btn-sm btn-primary" type="button"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Dashboard
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="#">Dashboard</a>
										<!-- <a class="dropdown-item" href="#">Featured</a>
										<a class="dropdown-item" href="#">popular</a> -->
									</div>
								</div>
								<ul class="nav nav-pills mr-auto d-none d-sm-flex">
									<li class="nav-item ">
										<a class="nav-link active" href="#">Dashboard</a>
									</li>
									<!-- <li class="nav-item">
										<a class="nav-link" href="#">Featured</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">popular</a>
									</li> -->
								</ul>
								
								<!-- <form class="form-inline ml-auto ml-sm-3">
									<div id="daterangeadminux" class="form-control form-control-sm">
										<span></span> <i
											class="material-icons avatar avatar-26 text-template-primary cal-icon">event</i>
									</div>

								</form> -->
							</nav>
							<!-- Submenu section ends -->
						</div>
					</div>
				</div>
			</div>