<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ @$title }} | DNK TAX SYSTEM</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('plugin/ckeditor/ckeditor.js') }}"></script>
	<script src="{{ asset('js/javascript.js') }}"></script>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/default-admin.css') }}" rel="stylesheet">
	<link href="{{ asset('css/admin.css') }}" rel="stylesheet">

	<!-- Customer CSS page -->
	@yield('css')
	

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<nav id="sidebar-left" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 animated">
				<div class="sidebar-sticky" id="hello">
					<span id="sidebar-close" class="sr-only"><i class="fa fa-times"></i></span>
					<header class="sidebar-brand">
						<h3><a href="{{route('home')}}"><i class="sidebar-icon"><img src="/images/logo.png" style="max-width: 50px; margin: 0 auto;" alt="..."/></i><span class="sidebar-text KHMERBTB">DNK SYSTEM</span></a></h3>
					</header>

					<div class="panel-heading">
						<h4 class="panel-title <?=((@$m=='home')?'active':'')?>">
							<a href="{{route('dashboard')}}" class="mb-0">
								<i class="fa fa-home sidebar-icon"></i> <span class="sidebar-text">ផ្ទាំងដើម</span>
							</a>
						</h4>
					</div>

					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

						<!-- ========== Companies and Business Objectives -->
						<div class="panel">
							<div class="panel-heading" role="tab" id="sidebar-processing-heading">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#sidebar-processing" aria-expanded="false" aria-controls="sidebar-processing">
										<i class="fa fa-handshake sidebar-icon"></i> <span class="sidebar-text">គ្រប់គ្រងការងារ <span class="badge badge-danger animated {{(($app_alert->count())>0)?'animated flash':''}} {{($app_alert->count()<=0)?'sr-only':''}}">{{$app_alert->count()}}</span><i class="fa fa-angle-down pull-right mt-05"></i></span>
									</a>
								</h4>
							</div>
							<div id="sidebar-processing" class="panel-collapse collapse <?=((@$m=='manage_processing')?'in':'collapse')?>" role="tabpanel" aria-labelledby="sidebar-processing-heading">
								<div class="panel-body">
									<ul class="nav">
										<li class="<?=((@$sm=='appointments')?'active':'')?> {{($app_alert->count()>0)?'animated bounceInLeft':''}}"><a href="{{route('appointments.index')}}"><i class="fa fa-comments sidebar-sub-icon"></i> <span class="sidebar-text">កាណាត់ជួប</span> <span class="badge badge-danger {{($app_alert->count()<=0)?'sr-only':''}}">{{$app_alert->count()}}</span></a></li>
										<li class="<?=((@$sm=='quotations')?'active':'')?>"><a href="{{route('quotations.index')}}"><i class="fa fa-file-alt sidebar-sub-icon"></i> <span class="sidebar-text">សម្រង់តម្លៃ</span></a></li>
									</ul>
								</div>
							</div>
						</div>

						<!-- ========== Companies and Business Objectives -->
						<div class="panel">
							<div class="panel-heading" role="tab" id="sidebar-company-heading">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#sidebar-company" aria-expanded="false" aria-controls="sidebar-company">
										<i class="fa fa-building sidebar-icon"></i> <span class="sidebar-text">គ្រប់គ្រងក្រុមហ៊ុន<i class="fa fa-angle-down pull-right mt-05"></i></span>
									</a>
								</h4>
							</div>
							<div id="sidebar-company" class="panel-collapse collapse <?=((@$m=='manage_companies')?'in':'collapse')?>" role="tabpanel" aria-labelledby="sidebar-company-heading">
								<div class="panel-body">
									<ul class="nav">
										<li class="<?=((@$sm=='objectives')?'active':'')?>"><a href="{{route('objectives.index')}}"><i class="fa fa-database sidebar-sub-icon"></i> <span class="sidebar-text">សកម្មភាពអាជីវភាព</span></a></li>
										<li class="<?=((@$sm=='companies')?'active':'')?>"><a href="{{route('companies.index')}}"><i class="fa fa-building sidebar-sub-icon"></i> <span class="sidebar-text">ក្រុមហ៊ុន</span></a></li>
									</ul>
								</div>
							</div>
						</div>
						
						<!-- ========== Services and Main Services -->
						<div class="panel">
							<div class="panel-heading" role="tab" id="sidebar-services-head">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#sidebar-services-body" aria-expanded="false" aria-controls="sidebar-services-body">
										<i class="fa fa-concierge-bell sidebar-icon"></i> <span class="sidebar-text">គ្រប់គ្រងសេវាកម្ម<i class="fa fa-angle-down pull-right mt-05"></i></span>
									</a>
								</h4>
							</div>
							<div id="sidebar-services-body" class="panel-collapse <?=((@$m=='services')?'in':'collapse')?>" role="tabpanel" aria-labelledby="sidebar-services-head">
								<div class="panel-body">
									<ul class="nav">
										<li class="<?=((@$sm=='mainservices')?'active':'')?>"><a href="{{ route('mainservices.index') }}"><i class="far fa-heart sidebar-sub-icon"></i> <span class="sidebar-text">សេវាកម្មធំៗ</span></a></li>
										<li class="<?=((@$sm=='services')?'active':'')?>"><a href="{{ route('services.index') }}"><i class="fa fa-heart sidebar-sub-icon"></i> <span class="sidebar-text">សេវាកម្មទាំងអស់</span></a></li>
									</ul>
								</div>
							</div>
						</div>

						<!-- ========== User -->
						<div class="panel <?=((Auth::user()->user_role_id!=1 && Auth::user()->user_role_id!=2)?'sr-only':'')?>">
							<div class="panel-heading" role="tab" id="sidebar-user-heading">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#sidebar-user" aria-expanded="false" aria-controls="sidebar-user">
										<i class="fa fa-users sidebar-icon"></i> <span class="sidebar-text">គ្រប់គ្រងបុគ្គលិក<i class="fa fa-angle-down pull-right mt-05"></i></span>
									</a>
								</h4>
							</div>
							<div id="sidebar-user" class="panel-collapse <?=((@$m=='manage_users')?'in':'collapse')?>" role="tabpanel" aria-labelledby="sidebar-user-heading">
								<div class="panel-body">
									<ul class="nav">
										<li class="<?=(($sm==='users')?'active':'')?>"><a href="{{route('users.index')}}"><i class="fa fa-user sidebar-sub-icon"></i> <span class="sidebar-text">អ្នកប្រើប្រាស់</span></a></li>
										<li class="<?=(($sm==='user_roles')?'active':'')?> <?=((Auth::user()->user_role_id!=1)?'sr-only':'')?>"><a href="{{route('roles.index')}}"><i class="fa fa-user-cog sidebar-sub-icon"></i> <span class="sidebar-text">ឋានៈអ្នកគ្រប់គ្រង</span></a></li>
									</ul>
								</div>
							</div>
						</div>

						<!-- ========== Location -->
						<div class="panel">
							<div class="panel-heading" role="tab" id="sidebar-location-heading">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#sidebar-location" aria-expanded="false" aria-controls="sidebar-location">
										<i class="fa fa-map sidebar-icon"></i> <span class="sidebar-text">គ្រប់គ្រងទីតាំង<i class="fa fa-angle-down pull-right mt-05"></i></span>
									</a>
								</h4>
							</div>
							<div id="sidebar-location" class="panel-collapse <?=((@$m=='manage_location')?'in':'collapse')?>" role="tabpanel" aria-labelledby="sidebar-location-heading">
								<div class="panel-body">
									<ul class="nav">
										<li class="<?=(($sm==='provinces')?'active':'')?>"><a href="{{route('provinces.index')}}"><i class="fa fa-location-arrow sidebar-sub-icon"></i> <span class="sidebar-text">ខេត្ត/ក្រុង</span></a></li>
										<li class="<?=(($sm==='districts')?'active':'')?>"><a href="{{route('districts.index')}}"><i class="fa fa-thumbtack sidebar-sub-icon"></i> <span class="sidebar-text">ស្រុក/ខណ្ឌ</span></a></li>
									</ul>
								</div>
							</div>
						</div>

					</div>


				</div>
			</nav>
		</div>
		<div class="row">
			<main id="main" class="col-md-12">
				<header id="body-header">
					<div class="row">
						<div class="col-xs-8">
							<ul class="list-inline">
								<li><span id="sidebar-toggle" class="mt-5 mb-2"><i class="fas fa-ellipsis-v"></i></span></li>
								<li>
									<ol class="breadcrumb">
										 <?=@$breadcrumb?>
									</ol>
								</li>
							</ul>
						</div>
						<div class="col-xs-4">
							<div class="dropdown pull-right mt-3 mb-3">
							  <button id="account-dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: url('/images/user/{{Auth::user()->image}}') center center no-repeat; background-size: cover;"></button>
							  <ul class="dropdown-menu" aria-labelledby="account-dropdown">
									<li class="mt-2"><a href="/user/?action=edit&u_id="><i class="fas fa-pencil-alt"></i> Edit Me</a></li>
									<li><a href="#"><i class="fas fa-cogs"></i> Setting</a></li>
							<li role="separator" class="divider"></li>
									<li>
										<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> 
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
							  </ul>
							</div>
						</div>
					</div>
				</header>


				<!-- ============= Customer Content page -->
				@yield('content')

			</main>
		</div>
	</div>
	<!-- Javascript -->
	@yield('js')
</body>
</html>
