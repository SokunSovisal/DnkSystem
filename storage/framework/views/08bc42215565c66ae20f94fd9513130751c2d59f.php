<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<section class="bg-white">

		<!-- Add Button & Error Message -->
		<?php $__env->startComponent('comps.btnAdd'); ?>
			<?php $__env->slot('btnAdd'); ?>
				<?php echo e(route('services.create')); ?>

			<?php $__env->endSlot(); ?>
		<?php echo $__env->renderComponent(); ?>
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>ឈ្មោះ</th>
					<th>តម្លៃ</th>
					<th>ស្ថិតក្នុងសេវាកម្មធំ</th>
					<!-- <th width="12%">បញ្ចូលដោយ</th> -->
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($i+1); ?></td>
					<td><?php echo e($s->s_name); ?></td>
					<td class="text-right"><span class="pull-left">$</span> <?php echo e(number_format($s->s_price, 2)); ?></td>
					<td class="text-center"><?php echo e($s->mainservice->ms_name); ?></td>
					<!-- <td><?php echo e($s->createdBy->name); ?></td> -->
					<td class="action">
						<a href="<?php echo e(route('services.edit',$s->id)); ?>" title="Edit" class="edit btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
						<?php echo e(Form::open(['url'=>route('services.destroy',$s->id)])); ?>

							<?php echo e(Form::hidden('_method','DELETE')); ?>

							<button type="button" title="លុបសេវាកម្ម" class="delete btn btn-danger btn-sm" data-text="តើអ្នកចង់លុបសេវាកម្មនេះមែទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="សេវាកម្មត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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