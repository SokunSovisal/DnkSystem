<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<section class="bg-white" style=" height: calc(100vh - 110px);">
		<div class="row"style="font-size: 250px; margin-top: calc(20vh);">
			<div class="col-sm-5 text-center text-warning" >
				<i class="fa fa-exclamation-triangle"></i>
			</div>
			<div class="col-sm-7 pt-5 mt-5">
				<h2 class="pt-2" style="text-transform: uppercase;"><i class="fas fa-frown text-secondary"></i> <span class="roboto_r">Sorry, you don't have permission!</span> <br/></h2>
				<h4 class="roboto_r mt-4">to access this page, please contact IT administrator!</h4>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">

	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>