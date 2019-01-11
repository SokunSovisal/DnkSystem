@extends('layouts.app')

@section('content')

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js"></script>
	<script type="text/javascript">
		var myCenter=new google.maps.LatLng(11.549178,104.928271);
		var marker;
		function initialize(){
			var mapProp = {
				center:myCenter,
				zoom: 9,
				mapTypeId:google.maps.MapTypeId.ROADMAP
			 };
			var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
			var marker=new google.maps.Marker({
				position:myCenter,
				animation:google.maps.Animation.BOUNCE
			});
			marker.setMap(map);
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
  <div id="googleMap" style="width:100%;height:380px;"></div>

	<section id="dashboard">
		<div id="clock" class="">
			<div class="time">
				<span class="hour-min"></span>
				<ul class="list-unstyled">
					<li class="am-pm"></li>
					<li class="sec"></li>
				</ul>
			</div>
			<div class="date"></div>
		</div>

		<div class="row">
			<div class="col-sm-6 col-md-6 col-lg-3">
				<article class="dash-card">
					<header>
						<div class="row">
							<div class="col-xs-6">
								<span class="dash-card-icon" style="background: #49B6D6;">
									<i class="fa fa-plus"></i>
								</span>
							</div>
							<div class="col-xs-6">
								<ul class="list-unstyled pull-right mt-1">
									<li><h5 class="dash-card-title">All unknown</h5></li>
									<li><h3 class="dash-card-counting mt-2 mb-2">{{$services->count()}}</h3></li>
								</ul>
							</div>
						</div>
					</header>
					<footer>
						<i class="fa fa-plus"></i> All unknown in the system.
					</footer>
				</article>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-3">
				<article class="dash-card">
					<header>
						<div class="row">
							<div class="col-xs-6">
								<span class="dash-card-icon" style="background: #E35B5A;">
									<i class="fa fa-heart"></i>
								</span>
							</div>
							<div class="col-xs-6">
								<ul class="list-unstyled pull-right mt-1">
									<li><h5 class="dash-card-title">All Services</h5></li>
									<li><h3 class="dash-card-counting mt-2 mb-2">{{$services->count()}}</h3></li>
								</ul>
							</div>
						</div>
					</header>
					<footer>
						<i class="fa fa-heart"></i> All services in the system.
					</footer>
				</article>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-3">
				<article class="dash-card">
					<header>
						<div class="row">
							<div class="col-xs-6">
								<span class="dash-card-icon" style="background: #44B6AE;">
									<i class="fa fa-building"></i>
								</span>
							</div>
							<div class="col-xs-6">
								<ul class="list-unstyled pull-right mt-1">
									<li><h5 class="dash-card-title">All Companies</h5></li>
									<li><h3 class="dash-card-counting mt-2 mb-2">{{$companies->count()}}</h3></li>
								</ul>
							</div>
						</div>
					</header>
					<footer>
						<i class="fa fa-building"></i> All companies in the system.
					</footer>
				</article>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-3">
				<article class="dash-card">
					<header>
						<div class="row">
							<div class="col-xs-6">
								<span class="dash-card-icon" style="background: #54AD58;">
									<i class="fa fa-user-friends"></i>
								</span>
							</div>
							<div class="col-xs-6">
								<ul class="list-unstyled pull-right mt-1">
									<li><h5 class="dash-card-title">All Users</h5></li>
									<li><h3 class="dash-card-counting mt-2 mb-2">{{$users->count()}}</h3></li>
								</ul>
							</div>
						</div>
					</header>
					<footer>
						<i class="fa fa-user"></i> All users in the system.
					</footer>
				</article>
			</div>
		</div>
	</section>
@endsection

@section('js')
	<script type="text/javascript">
		
		var interval = setInterval(function() {
				var momentNow = moment();
				$('#clock .date').html(momentNow.format('dddd') +', '+ momentNow.format('DD') +'-'+ momentNow.format('MMM') +'-'+ momentNow.format('YYYY'));
				$('#clock .hour-min').html(momentNow.format('hh:mm'));
				$('#clock .am-pm').html(momentNow.format('A'));
				$('#clock .sec').html(momentNow.format('ss'));
		}, 100);
	</script>
@endsection
