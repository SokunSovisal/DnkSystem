<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo Form::open(['url' => route('staffs.store')]); ?>

		<section class="bg-white">
			
			<!-- Back Button & Error Message -->
			<?php $__env->startComponent('comps.btnBack'); ?>
				<?php $__env->slot('btnBack'); ?>
					<?php echo e(route('staffs.index')); ?>

				<?php $__env->endSlot(); ?>
			<?php echo $__env->renderComponent(); ?>
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('st_name'))?'has-error':'')); ?>">
								<label class="control-label">ឈ្មោះ <small>*</small></label>
								<input class="form-control nbr" type="text" name="st_name" placeholder="name" value="<?php echo e(((count($errors) > 0) ? old('st_name') : '')); ?>" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ភេទ <small>*</small></label>
								<select class="form-control nbr" name="st_gender" id="st_gender">
									<option value="">-- ជ្រើសរើសភេទ --</option>
									<option value="1" <?php echo e(((old('st_gender')==1)? 'selected':'')); ?> >ប្រុស</option>
									<option value="2" <?php echo e(((old('st_gender')==2)? 'selected':'')); ?> >ស្រី</option>
									<option value="3" <?php echo e(((old('st_gender')==3)? 'selected':'')); ?> >ផ្សេងៗ</option>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('st_salary'))?'has-error':'')); ?>">
								<label class="control-label">ប្រាក់ខែ <small>*</small></label>
								<input class="form-control nbr" type="text" name="st_salary" placeholder="salary" value="<?php echo e(((count($errors) > 0) ? old('st_salary') : '')); ?>" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('st_position'))?'has-error':'')); ?>">
								<label class="control-label">តំណែង</label>
								<input class="form-control nbr" type="text" name="st_position" placeholder="position" value="<?php echo e(((count($errors) > 0) ? old('st_position') : '')); ?>" autocomplete="off" />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('st_phone'))?'has-error':'')); ?>">
								<label class="control-label">លេខទូរស័ព្ទ</label>
								<input class="form-control nbr" type="text" name="st_phone" placeholder="phone" value="<?php echo e(((count($errors) > 0) ? old('st_phone') : '')); ?>" autocomplete="off" />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('st_email'))?'has-error':'')); ?>">
								<label class="control-label">អ៊ីមែល</label>
								<input class="form-control nbr" type="text" name="st_email" placeholder="email" value="<?php echo e(((count($errors) > 0) ? old('st_email') : '')); ?>" autocomplete="off" />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control nbr" name="st_description" style="height: 108px;" placeholder="description"><?php echo e(((count($errors) > 0) ? old('st_description') : '')); ?></textarea>
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