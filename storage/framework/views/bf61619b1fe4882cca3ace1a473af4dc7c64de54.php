<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo Form::open(['url' => route('users.update', $user->id)]); ?>

		<?php echo e(Form::hidden('_method', 'PUT')); ?>

		<section class="bg-white">
			<?php $__env->startComponent('comps.btnBack'); ?>
				<?php $__env->slot('btnBack'); ?>
					<?php echo e(route('users.index')); ?>

				<?php $__env->endSlot(); ?>
			<?php echo $__env->renderComponent(); ?>
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('name'))?'has-error':'')); ?>">
								<label for="">ឈ្មោះ</label>
								<input class="form-control nbr" type="text" name="name" placeholder="name" value="<?php echo e($errors->has('name') ? old('name') : $user->name); ?>" autocomplete="off" required="" />
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('name'))?'has-error':'')); ?>">
								<label for="">ភេទ <small>*</small></label>
								<select name="gender" class="form-control nbr" required>
									<option value="">-- ជ្រើសរើសភេទ --</option>
										<option value="1" <?php echo e((($user->gender == 1) || ((count($errors) > 0) && (old('gender') == 1))) ? 'selected':''); ?>>ប្រុស</option>
										<option value="2" <?php echo e((($user->gender == 2) || ((count($errors) > 0) && (old('gender') == 1))) ? 'selected':''); ?>>ស្រី</option>
										<option value="3" <?php echo e((($user->gender == 3) || ((count($errors) > 0) && (old('gender') == 1))) ? 'selected':''); ?>>ផ្សេងៗ</option>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('email'))?'has-error':'')); ?>">
								<label for="">អ៊ីមែល <small>*</small></label>
								<input class="form-control nbr" type="email" name="email" placeholder="email" value="<?php echo e($errors->has('email') ? old('email') : $user->email); ?>" autocomplete="off" required="" />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('phone'))?'has-error':'')); ?>">
								<label for="">លេខទូរស័ព្ទ <small>*</small></label>
								<input class="form-control nbr" type="text" name="phone" placeholder="phone" value="<?php echo e($errors->has('phone') ? old('phone') : $user->phone); ?>" autocomplete="off" required="" />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control nbr" name="description" style="height: 108px;" placeholder="description"><?php echo e(((count($errors) > 0) ? old('description') : $user->description)); ?></textarea>
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