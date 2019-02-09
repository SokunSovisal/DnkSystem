<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<section class="bg-white">

		<!-- Add Button & Error Message -->
		<?php $__env->startComponent('comps.btnAdd'); ?>
			<?php $__env->slot('btnAdd'); ?>
				<?php echo e(route('projectprocess.create')); ?>

			<?php $__env->endSlot(); ?>
		<?php echo $__env->renderComponent(); ?>
		
		<br/>
		<br/>
		<div class="vs-datatable">
			<table class="table table-striped table-hover" id="dataTable">
				<thead>
					<tr>
						<th width="5%">N&deg;</th>
						<th width="10%">ការបរិច្ឆេទ</th>
						<th>ក្រុមហ៊ុន</th>
						<th>សេវាកម្ម</th>
						<th>អនុញ្ញាត្តិដោយ</th>
						<th width="18%" class="text-right disabled-sorting">សកម្មភាព</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tr=> $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e(++$tr); ?></td>
							<td><?php echo e($transaction->tr_start_date); ?></td>
							<td><?php echo e($transaction->company->com_name); ?></td>
							<td><?php echo e($transaction->service->s_name); ?></td>
							<td><?php echo e($transaction->verify_by->name); ?></td>
							<td class="action text-right">
								<button class="btn btn-sm btn-warning" onclick="getTrID( '<?php echo e($transaction->id); ?>' )" data-toggle="modal" data-target=".bs-process-model"><i class="fa fa-shoe-prints"></i></button>
								<a href="<?php echo e(route('projectprocess.edit', $transaction->id)); ?>" title="Edit" class="edit btn btn-sm btn-info"><i class="fa fa-pencil-alt"></i></a>
								<?php echo e(Form::open(['url'=>route('projectprocess.destroy', $transaction->id)])); ?>

									<?php echo e(Form::hidden('_method','DELETE')); ?>

									<button type="button" title="លុបគម្រោង" class="delete btn btn-danger btn-sm" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបគម្រោងនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="គម្រោងត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
									</button>
									<button type="submit" class="sub_delete sr-only"></button>
								<?php echo e(Form::close()); ?>

							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>

		<!-- Large modal -->

		<div class="modal fade bs-process-model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg" role="document" style="width: 65%; margin-top: 80px;">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="modal-process-title">ដំណើរការគម្រោង</h4>
		      </div>
		      <div class="modal-body process" id="modal-process-body"  style="max-height: 65vh; overflow: auto;">

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn-sm btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &nbsp;<span class="roboto_r">CLOSE</span></button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div>
		</div>
		<!-- Large modal -->

		<div class="modal fade bs-tp-model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg" role="document" style="width: 75%; margin-top: 40px;">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="modal-tp-title"></h4>
		      </div>
		      <div class="modal-body" id="modal-tp-body" style="min-height: 70vh;">
		      		
		      </div>
		      <div class="modal-footer" id="modal-tp-footer">
		        
		      </div>
		    </div><!-- /.modal-content -->
		  </div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">

		// Alert Delete
		$("button.delete").click(alertYesNo);

		function getTpID(pr_id, tr_id, pr_name) {

			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: "<?php echo e(route('projectprocess.ajaxfindtp')); ?>",
				type: 'post',
				data: {pr_id:pr_id, tr_id:tr_id, _token:_token},
				success: function(result){
					var myObj = JSON.parse(result);

					$('#modal-tp-title').html(pr_name);
					$('#modal-tp-body').html(myObj.form_tp);
					$('#modal-tp-footer').html(myObj.submit_tp);

					// DatePicker
					$('.datepicker').datetimepicker({
					  format: 'YYYY-MM-DD'
				  });

					// CKEDITOR myEditor
					CKEDITOR.replace('tp_description', {
						toolbar: [
							{ name: 'document', items: [ 'Source' ] },
							{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Undo', 'Redo' ] },
							{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
							{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
							'/',
							{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },
							{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
							{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
						],
				    height: '300'
					});


					$('#submit_new_tp').click(function () {
					  var tp_start_date = $('#tp_start_date').val();
					  var tp_description = CKEDITOR.instances['tp_description'].getData();
					  var pr_id = $('#pr_id').val();
					  var tr_id = $('#tr_id').val();
					  if ($('#tp_status').is(':checked')) {
					 	 var tp_status = '1';
					  }else{
					  	var tp_status = '0';
					  }
						var _token = $('input[name="_token"]').val();
						$.ajax({
							url: "<?php echo e(route('projectprocess.ajaxstoretp')); ?>",
							type: 'post',
							data: {tp_start_date: tp_start_date, tp_description:tp_description, pr_id:pr_id, tr_id:tr_id, tp_status:tp_status, _token:_token},
							success: function(result){
								getTrID(tr_id);
								swal({
						      title: 'បានជោគជ័យ',
						      type: "success",
						      showConfirmButton: false,
								  timer: 1200,
								  onOpen: () => {
								    timerInterval = setInterval(() => {
								    }, 100)
								  },
								  onClose: () => {
								    clearInterval(timerInterval)
								  }
								})
							}
						});
					});

					$('#submit_update_tp').click(function () {
					  var tp_id = $('#tp_id').val();
					  var tp_start_date = $('#tp_start_date').val();
					  var tp_description = CKEDITOR.instances['tp_description'].getData();
					  var pr_id = $('#pr_id').val();
					  var tr_id = $('#tr_id').val();
					  if ($('#tp_status').is(':checked')) {
					 	 var tp_status = '1';
					  }else{
					  	var tp_status = '0';
					  }
						var _token = $('input[name="_token"]').val();
						$.ajax({
							url: "<?php echo e(route('projectprocess.ajaxupdatetp')); ?>",
							type: 'post',
							data: {tp_id:tp_id, tp_start_date:tp_start_date, tp_description:tp_description, pr_id:pr_id, tr_id:tr_id, tp_status:tp_status, _token:_token},
							success: function(result){
								getTrID(tr_id);
								swal({
						      title: 'បានជោគជ័យ',
						      type: "success",
						      showConfirmButton: false,
								  timer: 1200,
								  onOpen: () => {
								    timerInterval = setInterval(() => {
								    }, 100)
								  },
								  onClose: () => {
								    clearInterval(timerInterval)
								  }
								})
							}
						});
					});


				}
			});
		}

		function getTrID(id) {
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: "<?php echo e(route('projectprocess.ajaxtp')); ?>",
				type: 'post',
				data: {id:id, _token:_token},
				success: function(result){
					$('#modal-process-body').html(result);
				}
			});
		}

		// Reload page After Close Modal
		$('.bs-tp-model').on('hidden.bs.modal', function () {
			$('#modal-title').html('');
			$('#pr_id').val('');
			$('#tr_id').val('');
			$('#tp_start_date').val('');
			CKEDITOR.instances['tp_description'].setData('');
	  	$('#tp_status').prop('checked', false);
		})

	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>