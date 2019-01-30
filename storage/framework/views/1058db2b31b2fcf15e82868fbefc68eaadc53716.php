<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<section class="bg-white">
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>ឡូហ្គោ</th>
					<th>ឈ្មោះក្រុមហ៊ុន</th>
					<th>សកម្មភាពអាជីវកម្ម</th>
					<th>បុគ្គលិកទាក់ទង</th>
					<th width="13%">ផែនទី</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $com): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($i+1); ?></td>
					<td><span class="img_column" style=" display: block; background: url('/images/companies/<?php echo e($com->com_logo); ?>') center center no-repeat; background-size: cover;" /></span></td>
					<td><?php echo e($com->com_name); ?></td>
					<td><?php echo e($com->objective->obj_name); ?></td>
					<td><?php echo e($com->com_cp_phone); ?></td>
					<td><a href="<?php echo e($com->com_addr_map); ?>" class="btn btn-warning btn-sm btn-block" target="_blank"><i class="fa fa-map-marked-alt"></i> មើលផែនទី</a></td>
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