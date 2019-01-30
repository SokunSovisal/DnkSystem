<?php $__env->startSection('css'); ?>
	<style type="text/css">
		.fileinput-new{
			width: 100%;

		}
		.thumbnail{
			width: 100%;

		}
		.thumbnail img{
			width: 100%;
		}
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo Form::open(['enctype'=>'multipart/form-data', 'url' => route('companies.image_update', $company->id)]); ?>

		<?php echo e(Form::hidden('_method', 'PUT')); ?>

			<?php $__env->startComponent('comps.btnBack'); ?>
				<?php $__env->slot('btnBack'); ?>
					<?php echo e(route('companies.index')); ?>

				<?php $__env->endSlot(); ?>
			<?php echo $__env->renderComponent(); ?>
			<br/>
			<br/>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<section class="bg-white">
						<div class="fileinput fileinput-new" data-provides="fileinput">
						  <div class="fileinput-new thumbnail">
						    <img data-src="/images/companies/<?php echo e($company->com_logo); ?>" src="/images/companies/<?php echo e($company->com_logo); ?>" alt="...">
						  </div>
						  <div class="fileinput-preview fileinput-exists thumbnail" style="width: 100%;"></div>
						  <div>
						    <span class="btn btn-primary btn-file mt-2">
						    	<span class="fileinput-new">Select image</span>
						    	<span class="fileinput-exists">Change</span><input type="file" name="com_logo">
						    </span>
						    <a href="#" class="btn btn-warning fileinput-exists mt-2" data-dismiss="fileinput">Remove</a>
						  </div>
						</div>
					</section>
				</div>
			</div>
		<br/>
		<br/>

		<?php echo $__env->make('comps.btnsubmit', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::close(); ?>

		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">

	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>