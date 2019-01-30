<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<section class="bg-white">

		<!-- Add Button & Error Message -->
		<?php $__env->startComponent('comps.btnAdd'); ?>
			<?php $__env->slot('btnAdd'); ?>
				<?php echo e(route('invoices.create')); ?>

			<?php $__env->endSlot(); ?>
		<?php echo $__env->renderComponent(); ?>
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th width="10%">លេខរៀង</th>
					<th width="10%">ការបរិច្ឆេទ</th>
					<th>ក្រុមហ៊ុន</th>
					<th>តម្លៃមុនVAT</th>
					<th>តម្លៃសរុបចុងក្រោយ</th>
					<th width="18%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($i+1); ?></td>
						<td><?php echo e($invoice->inv_number); ?></td>
						<td><?php echo e($invoice->inv_date); ?></td>
						<td><?php echo e($invoice->company->com_name); ?></td>
						<td><i class="fa fa-dollar-sign"></i> <?php echo e(number_format($invoice->inv_total, 2)); ?></td>
						<td><i class="fa fa-dollar-sign"></i> <?php echo e((($invoice->inv_vat_status==1)? number_format($invoice->inv_total, 2) : number_format($invoice->inv_total*1.1, 2) )); ?></td>
						<td class="action">
							<a href="<?php echo e(route('invoices.detail',$invoice->id)); ?>" class="btn btn-primary btn-sm" /><i class="fa fa-info"></i></a>
							<a href="<?php echo e(route('invoices.show', $invoice->id)); ?>" title="Show" class="edit btn btn-success btn-sm"><i class="fa fa-print"></i></a>
							<a href="<?php echo e(route('invoices.edit', $invoice->id)); ?>" title="Edit" class="edit btn btn-sm btn-info"><i class="fa fa-pencil-alt"></i></a>
							<?php echo e(Form::open(['url'=>route('invoices.destroy', $invoice->id)])); ?>

								<?php echo e(Form::hidden('_method','DELETE')); ?>

								<button type="button" title="លុបវិក្កយបត្រ" class="delete btn btn-danger btn-sm" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបវិក្កយបត្រនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="វិក្កយបត្រត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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