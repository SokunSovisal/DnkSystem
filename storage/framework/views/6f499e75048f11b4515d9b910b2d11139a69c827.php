<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo Form::open(['url' => route('districts.store')]); ?>

		<section class="bg-white">
			
			<!-- Back Button & Error Message -->
			<?php $__env->startComponent('comps.btnBack'); ?>
				<?php $__env->slot('btnBack'); ?>
					<?php echo e(route('districts.index')); ?>

				<?php $__env->endSlot(); ?>
			<?php echo $__env->renderComponent(); ?>
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('dist_name'))?'has-error':'')); ?>">
								<label class="control-label">ឈ្មោះ <small>*</small></label>
								<input class="form-control nbr" type="text" name="dist_name" placeholder="name" value="<?php echo e(((count($errors) > 0) ? old('dist_name') : '')); ?>" autocomplete="off" required />
							</div>
						</div>
						<br/>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ស្ថិតក្នុងខេត្ត <small>*</small></label>
								<select name="dist_province_id" class="form-control nbr select2" required>
									<option value="">-- ជ្រើសរើសខេត្ត --</option>
									<?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($pro->id); ?>" <?php echo e(($pro->id == old('dist_province_id')) ? 'selected':''); ?>><?php echo e($pro->pro_name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>
						<br/>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('dist_code'))?'has-error':'')); ?>">
								<label class="control-label">កូដតំបន់</label>
								<input class="form-control nbr" type="text" name="dist_code" placeholder="code" value="<?php echo e(((count($errors) > 0) ? old('dist_code') : '')); ?>" autocomplete="off" required />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control nbr" name="dist_description" style="height: 182px;" placeholder="description"><?php echo e(((count($errors) > 0) ? old('dist_description') : '')); ?></textarea>
							</div>
						</div>
					</div><!-- /.column -->
				</div><!--  /.row -->
		</section>
		<br/>

		<?php echo $__env->make('comps.btnsubmit', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>