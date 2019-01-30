<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<section class="bg-white">

		<!-- Add Button & Error Message -->
		<?php $__env->startComponent('comps.btnAdd'); ?>
			<?php $__env->slot('btnAdd'); ?>
				<?php echo e(route('appointments.create')); ?>

			<?php $__env->endSlot(); ?>
		<?php echo $__env->renderComponent(); ?>
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>ថ្ងៃនិងម៉ោង</th>
					<th>បុគ្គលិក</th>
					<th>បុគ្គលត្រូវជួប</th>
					<th>ចម្លើយ</th>
					<th width="12%">បញ្ចូលដោយ</th>
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($i+1); ?></td>
						<td><?php echo e($app->app_datetime); ?></td>
						<td><?php echo e($app->user->name); ?></td>
						<td><?php echo e($app->company->com_cp_name); ?></td>
						<td><span class="label label-<?php echo e(($app->app_status==1)?'warning':(($app->app_status==2)?'success':'danger')); ?> btn-xs"><?php echo e(($app->app_status==1)?'មិនទាន់មានចម្លើយ':(($app->app_status==2)?'ជោគជ័យ':'មិនជោគជ័យ')); ?></span></td>
						<td><?php echo e($app->user->name); ?></td>
						<td class="action">
							<a href="<?php echo e(route('appointments.edit',$app->id)); ?>" title="Edit" class="edit btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
							<?php echo e(Form::open(['url'=>route('appointments.destroy',$app->id)])); ?>

								<?php echo e(Form::hidden('_method','DELETE')); ?>

								<button type="button" title="លុបការណាត់ជួប" class="delete btn btn-sm btn-danger" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបការណាត់ជួបនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="ការណាត់ជួបត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
								</button>
								<button type="submit" class="sub_delete sr-only"></button>
							<?php echo e(Form::close()); ?>

						</td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">
		// Alert Delete
		$("button.delete").click(alertYesNo);
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>