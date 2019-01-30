<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<section class="bg-white">

		<!-- Add Button & Error Message -->
		<?php $__env->startComponent('comps.btnAdd'); ?>
			<?php $__env->slot('btnAdd'); ?>
				<?php echo e(route('billsreceived.create')); ?>

			<?php $__env->endSlot(); ?>
		<?php echo $__env->renderComponent(); ?>
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th width="12%">លេខរៀង</th>
					<th width="12%">ការបរិច្ឆេទ</th>
					<th>ក្រុមហ៊ុន</th>
					<th>តម្លៃសរុប</th>
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $billsreceived; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($i+1); ?></td>
						<td><?php echo e($bill->br_number); ?></td>
						<td><?php echo e($bill->br_date); ?></td>
						<td><?php echo e($bill->company->com_name); ?></td>
						<td><i class="fa fa-dollar-sign"></i> <?php echo e(number_format($bill->br_total, 2)); ?></td>
						<td class="action">
							<a href="<?php echo e(route('billsreceived.edit', $bill->id)); ?>" title="Edit" class="edit btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
							<?php echo e(Form::open(['url'=>route('billsreceived.destroy', $bill->id)])); ?>

								<?php echo e(Form::hidden('_method','DELETE')); ?>

								<button type="button" title="លុបវិក្កយបត្រ" class="delete btn btn-sm btn-danger" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបវិក្កយបត្រនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="វិក្កយបត្រត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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