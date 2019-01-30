<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<section class="bg-white">

		<!-- Add Button & Error Message -->
		<?php $__env->startComponent('comps.btnAdd'); ?>
			<?php $__env->slot('btnAdd'); ?>
				<?php echo e(route('quotations.create')); ?>

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
					<th>លេខទំនាក់ទំនង</th>
					<th width="110px">ចម្លើយ</th>
					<th width="16%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $quotations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($i+1); ?></td>
						<td><?php echo e($quote->quote_number); ?></td>
						<td><?php echo e($quote->quote_date); ?></td>
						<td><?php echo e($quote->company->com_name); ?></td>
						<td><?php echo e($quote->quote_cp_phone); ?></td>
						<td><span class="label label-<?php echo e(($quote->quote_status==1)?'warning':(($quote->quote_status==2)?'success':'danger')); ?> btn-xs"><?php echo e(($quote->quote_status==1)?'មិនទាន់មានចម្លើយ':(($quote->quote_status==2)?'ជោគជ័យ':'មិនជោគជ័យ')); ?></span></td>
						<td class="action">
							<a href="<?php echo e(route('quotationservices.index','qid='.$quote->id)); ?>" class="btn btn-primary btn-sm" /><i class="fa fa-heart"></i></a>
							<a href="<?php echo e(route('quotations.show',$quote->id)); ?>" title="Show" class="edit btn btn-success btn-sm"><i class="fa fa-print"></i></a>
							<a href="<?php echo e(route('quotations.edit',$quote->id)); ?>" title="Edit" class="edit btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
							<?php echo e(Form::open(['url'=>route('quotations.destroy',$quote->id)])); ?>

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
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">
		// Alert Delete
		$("button.delete").click(alertYesNo);
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>