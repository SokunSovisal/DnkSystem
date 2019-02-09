<?php $__env->startSection('css'); ?>
	<style type="text/css">
	
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<?php echo Form::open(['url' => route('process.update', $process->id)]); ?>

		<?php echo e(Form::hidden('_method', 'PUT')); ?>

		<section class="bg-white">
			<?php $__env->startComponent('comps.btnBack'); ?>
				<?php $__env->slot('btnBack'); ?>
					<?php echo e(route('process.index')); ?>

				<?php $__env->endSlot(); ?>
			<?php echo $__env->renderComponent(); ?>
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('pr_name'))?'has-error':'' )); ?>">
								<label class="control-label">ឈ្មោះឯកសារ <small>*</small></label>
								<input class="form-control nbr" type="text" name="pr_name" placeholder="document name" value="<?php echo e(((count($errors) > 0)? old('pr_name') : $process->pr_name)); ?>" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('pr_service_id'))?'has-error':'' )); ?>">
								<label class="control-label">សេវាកម្ម <small>*</small></label>
                <select name="pr_service_id" class="form-control nbr select2" id="pr_service_id" required>
                  <option value="">-- ជ្រើសរើសសេវាកម្ម --</option>
                  <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($service->id); ?>" <?php echo e((($service->id==$process->pr_service_id)? 'selected':'')); ?> ><?php echo e($service->s_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control" name="pr_description"  style="height: 108px;" placeholder="description"><?php echo e(((count($errors) > 0) ? old('pr_description') : $process->pr_description)); ?></textarea>
							</div>
						</div>
					</div><!-- /.column -->
				</div><!--  /.row -->
		</section>
		<br/>
		<?php echo e(csrf_field()); ?>


		<?php echo $__env->make('comps.btnsubmit', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">

	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>