<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<section class="bg-white">

		<!-- Add Button & Error Message -->
		<?php $__env->startComponent('comps.btnAdd'); ?>
			<?php $__env->slot('btnAdd'); ?>
				<?php echo e(route('process.create')); ?>

			<?php $__env->endSlot(); ?>
		<?php echo $__env->renderComponent(); ?>
		
		<br/>
		<br/>
		<div class="vs-datatable">
			<table class="table table-striped table-hover" id="dataTable">
				<thead>
					<tr>
						<th width="5%">N&deg;</th>
						<th>ឈ្មោះឯកសារ</th>
						<th width="30%">សេវាកម្ម</th>
						<th width="20%">បរិយាយ</th>
						<th width="10%" class="disabled-sorting text-right">សកម្មភាព</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $processes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $process): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($i+1); ?></td>
							<td><?php echo e($process->pr_name); ?></td>
							<td><?php echo e($process->service->s_name); ?></td>
							<td><?php echo e($process->pr_description); ?></td>
							<td class="action text-right">
								<a href="<?php echo e(route('process.edit',$process->id)); ?>" title="Edit" class="edit btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
								<?php echo e(Form::open(['url'=>route('process.destroy',$process->id)])); ?>

									<?php echo e(Form::hidden('_method','DELETE')); ?>

									<button type="button" title="លុបសម្រង់តម្លៃ" class="delete btn btn-danger btn-sm" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបសម្រង់តម្លៃនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="សម្រង់តម្លៃត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
									</button>
									<button type="submit" class="sub_delete sr-only"></button>
								<?php echo e(Form::close()); ?>

							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">
		// Alert Delete
		$("button.delete").click(alertYesNo);
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>