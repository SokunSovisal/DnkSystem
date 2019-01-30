<?php $__env->startSection('content'); ?>
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
		<br/>
		<div class="row">
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
									<li><h5 class="dash-card-title">សរុបសេវាកម្ម</h5></li>
									<li><h3 class="dash-card-counting mt-2 mb-2"><?php echo e($services->count()); ?></h3></li>
								</ul>
							</div>
						</div>
					</header>
					<footer>
						<i class="fa fa-heart"></i> សេវាកម្មទាំងអស់ដែលមានក្នុងប្រព័ន្ធ.
					</footer>
				</article>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-3">
				<a href="<?php echo e(route('companies.list')); ?>">
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
										<li><h5 class="dash-card-title">សរុបក្រុមហ៊ុន</h5></li>
										<li><h3 class="dash-card-counting mt-2 mb-2"><?php echo e($companies->count()); ?></h3></li>
									</ul>
								</div>
							</div>
						</header>
						<footer>
							<i class="fa fa-building"></i> ក្រុមហ៊ុនទាំងអស់ដែលមានក្នុងប្រព័ន្ធ
						</footer>
					</article>
				</a>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-3">
				<article class="dash-card">
					<header>
						<div class="row">
							<div class="col-xs-6">
								<span class="dash-card-icon" style="background: #49B6D6;">
									<i class="fa fa-users"></i>
								</span>
							</div>
							<div class="col-xs-6">
								<ul class="list-unstyled pull-right mt-1">
									<li><h5 class="dash-card-title">សរុបបុគ្គលិក</h5></li>
									<li><h3 class="dash-card-counting mt-2 mb-2"><?php echo e($staffs->count()); ?></h3></li>
								</ul>
							</div>
						</div>
					</header>
					<footer>
						<i class="fa fa-users"></i> បុគ្គលិកទាំងអស់ដែលមានក្នុងប្រព័ន្ធ.
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
									<li><h5 class="dash-card-title">សរុបអ្នកប្រើប្រាស់</h5></li>
									<li><h3 class="dash-card-counting mt-2 mb-2"><?php echo e($users->count()); ?></h3></li>
								</ul>
							</div>
						</div>
					</header>
					<footer>
						<i class="fa fa-user"></i> អ្នកប្រើប្រាស់ទាំងអស់ក្នុងប្រព័ន្ធ
					</footer>
				</article>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">
		
		var interval = setInterval(function() {
				var momentNow = moment();
				momentNow.locale('km');
				$('#clock .date').html(momentNow.format('dddd') +', '+ momentNow.format('DD') +'-'+ momentNow.format('MMM') +'-'+ momentNow.format('YYYY'));
				$('#clock .hour-min').html(momentNow.format('hh:mm'));
				$('#clock .am-pm').html(momentNow.format('A'));
				$('#clock .sec').html(momentNow.format('ss'));
		}, 100);
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>