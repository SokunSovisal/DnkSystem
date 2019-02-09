<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<title><?php echo e(@$title); ?> | DNK TAX SYSTEM</title>

	<!-- Scripts -->
	<script src="<?php echo e(asset('js/app.js')); ?>"></script>
	<script src="<?php echo e(asset('plugin/ckeditor/ckeditor.js')); ?>"></script>
	<script src="<?php echo e(asset('js/javascript.js')); ?>"></script>

	<!-- Styles -->
	<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/default-admin.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/admin.css')); ?>" rel="stylesheet">

	<!-- Customer CSS page -->
	<?php echo $__env->yieldContent('css'); ?>
	
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<nav id="sidebar-left" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 animated">
				<div class="sidebar-sticky" id="hello">
					<span id="sidebar-close" class="sr-only"><i class="fa fa-times"></i></span>
					<header class="sidebar-brand">
						<h3><a href="<?php echo e(route('home')); ?>" class="waves-effect"><i class="sidebar-icon"><img src="/images/logo.png" style="max-width: 50px; margin: 0 auto;" alt="..."/></i><span class="sidebar-text KHMERBTB">DNK SYSTEM</span></a></h3>
					</header>

					<div class="panel-heading">
						<h4 class="panel-title <?=((@$m=='home')?'active':'')?>">
							<a href="<?php echo e(route('dashboard')); ?>" class="mb-0 waves-effect">
								<i class="fa fa-home sidebar-icon"></i> <span class="sidebar-text">ផ្ទាំងដើម</span>
							</a>
						</h4>
					</div>

					<div class="sidebar-divider"></div>

					<div class="panel-heading">
						<h4 class="panel-title <?=((@$sm=='28')?'active':'')?>">
							<a href="<?php echo e(route('alertmanagement.index')); ?>" class="mb-0 waves-effect">
								<i class="fa fa-bell sidebar-icon"></i> <span class="sidebar-text">ការជូនដំណឹង</span>
							</a>
						</h4>
					</div>

					<div class="panel-heading">
						<h4 class="panel-title <?=((@$sm=='27')?'active':'')?>">
							<a href="<?php echo e(route('projectprocess.index')); ?>" class="mb-0 waves-effect">
								<i class="fa fa-project-diagram sidebar-icon"></i> <span class="sidebar-text">ដំណើរការគម្រោង</span>
							</a>
						</h4>
					</div>

					<div class="sidebar-divider"></div>

					<div class="panel-group" id="accordion-report" role="tablist" aria-multiselectable="true">

						<!-- ========== Manage Income -->
						<div class="panel">
							<div class="panel-heading" role="tab" id="sidebar-processing-heading">
								<h4 class="panel-title">
									<a class="collapsed waves-effect" role="button" data-toggle="collapse" data-parent="#accordion-report" href="#sidebar-processing" aria-expanded="false" aria-controls="sidebar-processing">
										<i class="fa fa-funnel-dollar sidebar-icon"></i> <span class="sidebar-text">គ្រប់គ្រងចំណូល  <span class="badge badge-danger animated <?php echo e(($appNotify>0)?'animated flash':''); ?> <?php echo e(($appNotify<=0)?'sr-only':''); ?>"><?php echo e($appNotify); ?></span><i class="fa fa-angle-down pull-right mt-05"></i></span>
									</a>
								</h4>
							</div>
							<div id="sidebar-processing" class="panel-collapse collapse <?=((@$m=='manage_income')?'in':'collapse')?>" role="tabpanel" aria-labelledby="sidebar-processing-heading">
								<div class="panel-body">
									<ul class="nav">
										<li class="<?=((@$sm=='2')?'active':'')?> <?php echo e(($appNotify>0)?'animated bounceInLeft':''); ?>"><a href="<?php echo e(route('appointments.index')); ?>" class="waves-effect"><i class="fa fa-comments sidebar-sub-icon"></i> <span class="sidebar-text">កាណាត់ជួប</span> <span class="badge badge-danger <?php echo e(($appNotify<=0)?'sr-only':''); ?>"><?php echo e($appNotify); ?></span></a></li>
										<li class="<?=((@$sm=='3')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('quotations.index')); ?>"><i class="fa fa-file-alt sidebar-sub-icon"></i> <span class="sidebar-text">សម្រង់តម្លៃ</span></a></li>
										<li class="<?=((@$sm=='4')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('invoices.index')); ?>"><i class="fa fa-file-invoice sidebar-sub-icon"></i> <span class="sidebar-text">វិក្កយបត្រចំណូល</span></a></li>
										<li class="<?=((@$sm=='5')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('receipts.index')); ?>"><i class="fa fa-receipt sidebar-sub-icon"></i> <span class="sidebar-text">ប័ណ្ណទទួលប្រាក់</span></a></li>
									</ul>
								</div>
							</div>
						</div>

						<!-- ========== Manage expense -->
						<div class="panel">
							<div class="panel-heading" role="tab" id="sidebar-expense-heading">
								<h4 class="panel-title">
									<a class="collapsed waves-effect" role="button" data-toggle="collapse" data-parent="#accordion-report" href="#sidebar-expense" aria-expanded="false" aria-controls="sidebar-expense">
										<i class="fa fa-money-check-alt sidebar-icon"></i> <span class="sidebar-text">គ្រប់គ្រងចំណាយ <i class="fa fa-angle-down pull-right mt-05"></i></span>
									</a>
								</h4>
							</div>
							<div id="sidebar-expense" class="panel-collapse collapse <?=((@$m=='manage_expense')?'in':'collapse')?>" role="tabpanel" aria-labelledby="sidebar-expense-heading">
								<div class="panel-body">
									<ul class="nav">
										<li class="<?=((@$sm=='6')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('billsreceived.index')); ?>"><i class="fa fa-file-invoice sidebar-sub-icon"></i> <span class="sidebar-text">វិក្កយបត្រចំណាយ</span></a></li>
										<li class="<?=((@$sm=='7')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('accountpayables.index')); ?>"><i class="fa fa-file-invoice-dollar sidebar-sub-icon"></i> <span class="sidebar-text">ការទូទាត់ប្រាក់</span></a></li>
									</ul>
								</div>
							</div>
						</div>

						<!-- ========== Manage report -->
						<div class="panel">
							<div class="panel-heading" role="tab" id="sidebar-report-heading">
								<h4 class="panel-title">
									<a class="collapsed waves-effect" role="button" data-toggle="collapse" data-parent="#accordion-report" href="#sidebar-report" aria-expanded="false" aria-controls="sidebar-report">
										<i class="fa fa-copy sidebar-icon"></i> <span class="sidebar-text">របាយការណ៍ <i class="fa fa-angle-down pull-right mt-05"></i></span>
									</a>
								</h4>
							</div>
							<div id="sidebar-report" class="panel-collapse collapse <?=((@$m=='manage_reports')?'in':'collapse')?>" role="tabpanel" aria-labelledby="sidebar-report-heading">
								<div class="panel-body">
									<ul class="nav">
										<li class="<?=((@$sm=='8')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('ARReport.index')); ?>"><i class="fa fa-donate sidebar-sub-icon"></i> <span class="sidebar-text">ប្រាក់មិនទាន់ទទួល</span></a></li>
										<li class="<?=((@$sm=='9')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('APReport.index')); ?>"><i class="fa fa-hand-holding-usd sidebar-sub-icon"></i> <span class="sidebar-text">ប្រាក់មិនទាន់បង់</span></a></li>
										<li class="<?=((@$sm=='10')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('incomereport.index')); ?>"><i class="fa fa-file-import sidebar-sub-icon"></i> <span class="sidebar-text">ចំណូល</span></a></li>
										<li class="<?=((@$sm=='11')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('expensereport.index')); ?>"><i class="fa fa-file-export sidebar-sub-icon"></i> <span class="sidebar-text">ចំណាយ</span></a></li>
										<li class="<?=((@$sm=='12')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('profitloss.index')); ?>"><i class="fa fa-chart-line sidebar-sub-icon"></i> <span class="sidebar-text">ចំណេញ-ខាត</span></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="sidebar-divider"></div>
					<div class="panel-group" id="accordion-basic" role="tablist" aria-multiselectable="true">
						<!-- ========== Companies and Business Objectives -->
						<div class="panel">
							<div class="panel-heading" role="tab" id="sidebar-company-heading">
								<h4 class="panel-title">
									<a class="collapsed waves-effect" role="button" data-toggle="collapse" data-parent="#accordion-basic" href="#sidebar-company" aria-expanded="false" aria-controls="sidebar-company">
										<i class="fa fa-building sidebar-icon"></i> <span class="sidebar-text">គ្រប់គ្រងក្រុមហ៊ុន<i class="fa fa-angle-down pull-right mt-05"></i></span>
									</a>
								</h4>
							</div>
							<div id="sidebar-company" class="panel-collapse collapse <?=((@$m=='manage_companies')?'in':'collapse')?>" role="tabpanel" aria-labelledby="sidebar-company-heading">
								<div class="panel-body">
									<ul class="nav">
										<li class="<?=((@$sm=='13')?'active':'')?>"><a  class="waves-effect" href="<?php echo e(route('objectives.index')); ?>"><i class="fa fa-database sidebar-sub-icon"></i> <span class="sidebar-text">សកម្មភាពអាជីវភាព</span></a></li>
										<li class="<?=((@$sm=='14')?'active':'')?>"><a  class="waves-effect" href="<?php echo e(route('companies.index')); ?>"><i class="fa fa-building sidebar-sub-icon"></i> <span class="sidebar-text">ក្រុមហ៊ុន</span></a></li>
										<li class="<?=((@$sm=='15')?'active':'')?>"><a  class="waves-effect" href="<?php echo e(route('filecategories.index')); ?>"><i class="fa fa-file sidebar-sub-icon"></i> <span class="sidebar-text">ផ្នែកឯកសារ</span></a></li>
										<li class="<?=((@$sm=='16')?'active':'')?>"><a  class="waves-effect" href="<?php echo e(route('files.index')); ?>"><i class="far fa-file-alt sidebar-sub-icon"></i> <span class="sidebar-text">ឯកសារ</span></a></li>
									</ul>
								</div>
							</div>
						</div>
						<!-- ========== Services and Main Services -->
						<div class="panel">
							<div class="panel-heading" role="tab" id="sidebar-services-head">
								<h4 class="panel-title">
									<a class="collapsed waves-effect" role="button" data-toggle="collapse" data-parent="#accordion-basic" href="#sidebar-services-body" aria-expanded="false" aria-controls="sidebar-services-body">
										<i class="fa fa-concierge-bell sidebar-icon"></i> <span class="sidebar-text">គ្រប់គ្រងសេវាកម្ម<i class="fa fa-angle-down pull-right mt-05"></i></span>
									</a>
								</h4>
							</div>
							<div id="sidebar-services-body" class="panel-collapse <?=((@$m=='services')?'in':'collapse')?>" role="tabpanel" aria-labelledby="sidebar-services-head">
								<div class="panel-body">
									<ul class="nav">
										<li class="<?=((@$sm=='17')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('mainservices.index')); ?>"><i class="far fa-heart sidebar-sub-icon"></i> <span class="sidebar-text">សេវាកម្មធំៗ</span></a></li>
										<li class="<?=((@$sm=='24')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('services.index')); ?>"><i class="fa fa-heart sidebar-sub-icon"></i> <span class="sidebar-text">សេវាកម្មទាំងអស់</span></a></li>
										<li class="<?=((@$sm=='25')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('checklist.index')); ?>"><i class="fa fa-clipboard-check sidebar-sub-icon"></i> <span class="sidebar-text">ឯកសារតម្រូវ</span></a></li>
										<li class="<?=((@$sm=='26')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('process.index')); ?>"><i class="fa fa-shoe-prints sidebar-sub-icon"></i> <span class="sidebar-text">ដំណើរការការងារ</span></a></li>
									</ul>
								</div>
							</div>
						</div>

						<!-- ========== User -->
						<div class="panel">
							<div class="panel-heading" role="tab" id="sidebar-user-heading">
								<h4 class="panel-title">
									<a class="collapsed waves-effect" role="button" data-toggle="collapse" data-parent="#accordion-basic" href="#sidebar-user" aria-expanded="false" aria-controls="sidebar-user">
										<i class="fa fa-users sidebar-icon"></i> <span class="sidebar-text">គ្រប់គ្រងបុគ្គលិក<i class="fa fa-angle-down pull-right mt-05"></i></span>
									</a>
								</h4>
							</div>
							<div id="sidebar-user" class="panel-collapse <?=((@$m=='manage_users')?'in':'collapse')?>" role="tabpanel" aria-labelledby="sidebar-user-heading">
								<div class="panel-body">
									<ul class="nav">
										<li class="<?=(($sm==='18')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('staffs.index')); ?>"><i class="fa fa-user-friends sidebar-sub-icon"></i> <span class="sidebar-text">បុគ្គលិក</span></a></li>
										<li class="<?=(($sm==='19')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('users.index')); ?>"><i class="fa fa-user sidebar-sub-icon"></i> <span class="sidebar-text">អ្នកប្រើប្រាស់</span></a></li>
										<li class="<?=(($sm==='21')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('permissions.index')); ?>"><i class="fa fa-user-graduate sidebar-sub-icon"></i> <span class="sidebar-text">សិទ្ធិអ្នកគ្រប់គ្រង</span></a></li>
										<li class="<?=(($sm==='20')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('roles.index')); ?>"><i class="fa fa-user-cog sidebar-sub-icon"></i> <span class="sidebar-text">ឋានៈអ្នកគ្រប់គ្រង</span></a></li>
									</ul>
								</div>
							</div>
						</div>

						<!-- ========== Location -->
						<div class="panel">
							<div class="panel-heading" role="tab" id="sidebar-location-heading">
								<h4 class="panel-title">
									<a class="collapsed waves-effect" role="button" data-toggle="collapse" data-parent="#accordion-basic" href="#sidebar-location" aria-expanded="false" aria-controls="sidebar-location">
										<i class="fa fa-map sidebar-icon"></i> <span class="sidebar-text">គ្រប់គ្រងទីតាំង<i class="fa fa-angle-down pull-right mt-05"></i></span>
									</a>
								</h4>
							</div>
							<div id="sidebar-location" class="panel-collapse <?=((@$m=='manage_location')?'in':'collapse')?>" role="tabpanel" aria-labelledby="sidebar-location-heading">
								<div class="panel-body">
									<ul class="nav">
										<li class="<?=(($sm==='22')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('provinces.index')); ?>"><i class="fa fa-location-arrow sidebar-sub-icon"></i> <span class="sidebar-text">ខេត្ត/ក្រុង</span></a></li>
										<li class="<?=(($sm==='23')?'active':'')?>"><a class="waves-effect" href="<?php echo e(route('districts.index')); ?>"><i class="fa fa-thumbtack sidebar-sub-icon"></i> <span class="sidebar-text">ស្រុក/ខណ្ឌ</span></a></li>
									</ul>
								</div>
							</div>
						</div>

					</div>
				<br/>
				<br/>
				<br/>
				</div>
			</nav>
		</div>
		<div class="row">
			<main id="main" class="col-md-12">
				<header id="body-header">
					<div class="row">
						<div class="col-xs-2 col-sm-6">
							<ul class="list-inline">
								<li><span id="sidebar-toggle" class="mt-5 mb-2"><i class="fas fa-list-ul"></i></span></li>
								<li>
									<ol class="breadcrumb">
										 <?=@$breadcrumb?>
									</ol>
								</li>
							</ul>
						</div>
						<div class="col-xs-10 col-sm-6">
							<ul class="navbar-right list-inline">
					      <li class="dropdown" id="notifications">
					        <a href="#notification" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					          <i class="fa fa-bell">
					            <span class="badge badge-danger">11</span>
					          </i>
					          ការជូនដំណឹង
					        </a>
				          <ul class="dropdown-menu notify-drop nbr">
				            <div class="notify-drop-title">
				            	ការជួនដំណឹង (<b>2</b>)
				            </div>
				            <!-- end notify title -->
				            <!-- notify content -->
				            <ul class="drop-content nav">

					          	<li class="notify-item">
					          		<a href="#" class="notify-link">
					          			<div class="row" style="max-width: 100%;margin-left: 0px;">
						            		<div class="col-xs-3" style="padding: 0;">
						            			<div class="notify-icon">
																<i class="fa fa-project-diagram"></i>
							            		</div>
							            	</div>
						            		<div class="col-xs-9" style="padding: 0;">
						            			<div class="notify-text">
							            			<div>Title name document haha testing....</div>
							            			<p class="time" style="margin-bottom: 0 !important;">10-Apr-2019</p>
						            			</div>
						            		</div>
					          			</div>
					          		</a>
					          	</li>

					          	<li class="notify-item">
					          		<a href="#" class="notify-link">
					          			<div class="row" style="max-width: 100%;margin-left: 0px;">
						            		<div class="col-xs-3" style="padding: 0;">
						            			<div class="notify-icon">
																<i class="fa fa-comments"></i>
							            		</div>
							            	</div>
						            		<div class="col-xs-9" style="padding: 0;">
						            			<div class="notify-text">
							            			<div>Title name document haha testing....</div>
							            			<p class="time" style="margin-bottom: 0 !important;">10-Apr-2019</p>
						            			</div>
						            		</div>
					          			</div>
					          		</a>
					          	</li>

					          	<li class="notify-item">
					          		<a href="#" class="notify-link">
					          			<div class="row" style="max-width: 100%;margin-left: 0px;">
						            		<div class="col-xs-3" style="padding: 0;">
						            			<div class="notify-icon">
																<i class="fa fa-bell"></i>
							            		</div>
							            	</div>
						            		<div class="col-xs-9" style="padding: 0;">
						            			<div class="notify-text">
							            			<div>Title name document haha testing....</div>
							            			<p class="time" style="margin-bottom: 0 !important;">10-Apr-2019</p>
						            			</div>
						            		</div>
					          			</div>
					          		</a>
					          	</li>

					          	<li class="notify-item">
					          		<a href="#" class="notify-link">
					          			<div class="row" style="max-width: 100%;margin-left: 0px;">
						            		<div class="col-xs-3" style="padding: 0;">
						            			<div class="notify-icon">
																<i class="fa fa-bell"></i>
							            		</div>
							            	</div>
						            		<div class="col-xs-9" style="padding: 0;">
						            			<div class="notify-text">
							            			<div>Title name document haha testing....</div>
							            			<p class="time" style="margin-bottom: 0 !important;">10-Apr-2019</p>
						            			</div>
						            		</div>
					          			</div>
					          		</a>
					          	</li>

				            </ul>
				            <div class="notify-drop-footer text-center">
				            	<a href=""><i class="fa fa-eye"></i> បង្ហាញទាំងអស់</a>
				            </div>
				          </ul>
				        </li>

								<li class="dropdown" id="account">
								  <a href="#account" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="background: url('/images/user/<?php echo e(Auth::user()->image); ?>') center center no-repeat; background-size: cover;"></a>
								  <ul class="dropdown-menu nbr" aria-labelledby="account-dropdown">
										<li class="mt-2"><a href="<?php echo e(route('users.index')); ?>"><i class="fas fa-user-friends"></i> &nbsp;&nbsp;អ្នប្រើប្រាស់</a></li>
										<li class="mt-2"><a href="<?php echo e(route('users.edit', Auth::id())); ?>"><i class="fas fa-pencil-alt"></i> &nbsp;&nbsp;កែប្រែព័ត៌មានខ្ញុំ</a></li>
										<!-- <li><a href="#"><i class="fas fa-cogs"></i> Setting</a></li> -->
										<li role="separator" class="divider"></li>
										<li>
											<a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();  document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> &nbsp;&nbsp;ចាកចេញ</a>

	                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
	                        <?php echo csrf_field(); ?>
	                    </form>
								  </ul>
								</li>
				      </ul>
						</div>
					</div>
				</header>


				<!-- ============= Customer Content page -->
				<?php echo $__env->yieldContent('content'); ?>

			</main>
		</div>
	</div>
	<!-- Javascript -->
	<style>
    $(function () {
		  $('[data-tooltip="tooltip"]').tooltip()
		});
	</style>
	<?php echo $__env->yieldContent('js'); ?>
</body>
</html>
