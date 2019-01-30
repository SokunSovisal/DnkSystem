<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<section class="bg-white">

		<!-- Add Button & Error Message -->
		<?php $__env->startComponent('comps.btnAdd'); ?>
			<?php $__env->slot('btnAdd'); ?>
				<?php echo e(route('users.create')); ?>

			<?php $__env->endSlot(); ?>
		<?php echo $__env->renderComponent(); ?>
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>ឈ្មោះ</th>
					<th>លេខទូរស័ព្ទ</th>
					<th>ឋានៈ</th>
					<th width="100px">ដំណើរការ</th>
					<th width="20%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($i+1); ?></td>
					<td><?php echo e($user->name); ?></td>
					<td><?php echo e($user->phone); ?></td>
					<td><?php echo e($user->userrole->ur_name); ?></td>
					<td>
						<?php echo e(Form::open(['url'=>route('users.status',$user->id)])); ?>

							<?php echo e(Form::hidden('_method','PUT')); ?>

							<input type="hidden" name="status" value="<?php echo e((($user->status==1)?'0':'1')); ?>"/>
			        <div class="togglebutton">
			          <label>
			            <input type="checkbox" title="ចុចដើម្បី <?php echo e((($user->status==1)?'បិទ':'បើក')); ?>គណនី" data-text="តើអ្នកចង់<?php echo e((($user->status==1)?'បិទ':'បើក')); ?>គណនីអ្នកប្រើប្រាស់មួយនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="គណនីនេះត្រូវបាន<?php echo e((($user->status==1)?'បិទ':'បើក')); ?>." class="submit_status" <?php echo e((($user->status==1)? 'checked' : '')); ?> >
			            <span class="toggle toggle-active"></span>
									<button type="submit" class="sub_status sr-only"></button>
			          </label>
			        </div>
						<?php echo e(Form::close()); ?></td>
					<td class="action">
						<a href="<?php echo e(route('users.role',$user->id)); ?>" title="Click to Change User Role" class="btn btn-primary btn-sm"><i class="fa fa-user-cog"></i></a>
						<a href="<?php echo e(route('users.image',$user->id)); ?>" title="Click to Change Image" class="btn btn-warning btn-sm"><i class="fa fa-image"></i></a>
						<a href="<?php echo e(route('users.password',$user->id)); ?>" title="Click to Change Password" class="btn-sm btn btn-success"><i class="fa fa-key"></i></a>
						<a href="<?php echo e(route('users.edit',$user->id)); ?>" title="Edit Information" class="edit btn-sm btn btn-info"><i class="fa fa-pencil-alt"></i></a>
						<?php echo e(Form::open(['url'=>route('users.destroy',$user->id)])); ?>

							<?php echo e(Form::hidden('_method','DELETE')); ?>

							<button type="button" title="លុបអ្នកប្រើប្រាស់" class="delete btn btn-sm btn-danger" data-text="តើអ្នកចង់លុបអ្នកប្រើប្រាស់នេះមែទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="អ្នកប្រើប្រាស់ត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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
		// Alert Status
		$('.submit_status').change( function () {
			var text = $(this).data('text');
			var type = $(this).data('type');
			var rstitle = $(this).data('rstitle');
			var rstext = $(this).data('rstext');
			swal({
			  title: 'តើអ្នកប្រាកដ ឬទេ?',
			  text: text,
			  type: type,
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'យល់ព្រម',
		    cancelButtonText: 'បោះបង'
			}).then((result) => {
			  if (result.value) {
				  let timerInterval
					swal({
			      title: rstitle,
			      text: rstext,
			      type: "success",
			      showConfirmButton: false,
					  timer: 800,
					  onOpen: () => {
					    timerInterval = setInterval(() => {
					    }, 100)
					  },
					  onClose: () => {
					    clearInterval(timerInterval)
					  }
					}).then((result) => {
					  if (result.dismiss === swal.DismissReason.timer) {
					  	$(this).nextAll('.sub_status').click();
					  }
					})
				}
			})
		});

		// Alert Delete
		$("button.delete").click(alertYesNo);
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>