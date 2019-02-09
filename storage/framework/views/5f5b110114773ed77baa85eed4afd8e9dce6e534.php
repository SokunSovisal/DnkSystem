<?php $__env->startSection('css'); ?>
	<style type="text/css">
		#service_items .service_id{
			padding: 0;
			border: none;
		}
		#service_items .input-group-addon input{
			width: 34px;
		}
		#btn-add{
			padding: 24px 0 0 5px;
		}
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo Form::open(['url' => route('projectprocess.store')]); ?>

		<section class="bg-white">
			
			<!-- Back Button & Error Message -->
			<?php $__env->startComponent('comps.btnBack'); ?>
				<?php $__env->slot('btnBack'); ?>
					<?php echo e(route('projectprocess.index')); ?>

				<?php $__env->endSlot(); ?>
			<?php echo $__env->renderComponent(); ?>
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('tr_start_date'))?'has-error':'' )); ?>">
								<label class="control-label">ការបរិច្ឆេទ <small>*</small></label>
								<div class='input-group date'>
									<input class="form-control" type="text" id='tr_start_date' name="tr_start_date" placeholder="date & time" value="<?php echo e(((count($errors) > 0) ? old('tr_start_date') : '')); ?>" autocomplete="off" required data-mask="9999-99-99" />
								  <span class="input-group-addon">
									  <span class="glyphicon glyphicon-calendar"></span>
								  </span>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('tr_date_count'))?'has-error':'' )); ?>">
								<label class="control-label">ការប៉ានប្រម៉ានពេលវេលា <small>*</small></label>
								<div class='input-group date'>
									<input class="form-control" type="number" pattern="[0-9]" min="0" id='tr_date_count' name="tr_date_count" placeholder="estimate time" value="<?php echo e(((count($errors) > 0) ? old('tr_date_count') : '')); ?>" autocomplete="off" />
								  <span class="input-group-addon">
									  ថ្ងៃ
								  </span>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('tr_invoice_id'))?'has-error':'' )); ?>">
								<label class="control-label">វិក្កយត្រប័ត្រ</label>
                <select name="tr_invoice_id" class="form-control select2" id="tr_invoice_id">
                  <option value="">-- សូមជ្រើសរើស --</option>
                  <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($invoice->id); ?>"  <?php echo e((($invoice->id == old('tr_invoice_id'))? 'selected':'')); ?>><?php echo e($invoice->inv_number); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('tr_company_id'))?'has-error':'' )); ?>">
								<label class="control-label">ក្រុមហ៊ុន <small>*</small></label>
                <select name="tr_company_id" class="form-control select2" id="tr_company_id" required>
                  <option value="">-- សូមជ្រើសរើស --</option>
                  <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($company->id); ?>"  <?php echo e((($company->id == old('tr_company_id'))? 'selected':'')); ?>><?php echo e($company->com_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('tr_service_id'))?'has-error':'' )); ?>">
								<label class="control-label">សេវាកម្ម <small>*</small></label>
                <select name="tr_service_id" class="form-control select2" id="tr_service_id" required>
                  <option value="">-- សូមជ្រើសរើស --</option>
                  <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($service->id); ?>"  <?php echo e((($service->id == old('tr_service_id'))? 'selected':'')); ?>><?php echo e($service->s_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('tr_date_alert'))?'has-error':'' )); ?>">
								<label class="control-label">ការបរិច្ឆេទជូនដំណឹង <small>*</small></label>
								<div class='input-group date'>
									<input class="form-control" type="text" id='tr_date_alert' name="tr_date_alert" placeholder="date & time" value="<?php echo e(((count($errors) > 0) ? old('tr_date_alert') : '')); ?>" autocomplete="off" required data-mask="9999-99-99" />
								  <span class="input-group-addon">
									  <span class="glyphicon glyphicon-calendar"></span>
								  </span>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('tr_verify_by'))?'has-error':'' )); ?>">
								<label class="control-label">អនុញ្ញាត្ដិដោយ <small>*</small></label>
                <select name="tr_verify_by" class="form-control select2" id="tr_verify_by" required>
                  <option value="">-- សូមជ្រើសរើស --</option>
                  <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>" <?php echo e((($user->id==Auth::id())? 'selected':'' )); ?>><?php echo e($user->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control" name="tr_description"  style="height: 183px;" placeholder="description"><?php echo e(((count($errors) > 0) ? old('tr_description') : '')); ?></textarea>
							</div>
						</div>
					</div><!-- /.column -->
				</div><!--  /.row -->
		</section>
		<br/>
		<?php echo e(csrf_field()); ?>


		<?php echo $__env->make('comps.btnsubmit', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">


		$(document).ready(function() {

			$('#tr_invoice_id').change(function(){

				var services = $('#tr_service_id').html();
				if ($(this).val()!='') {
				  var inv_id = $(this).val();
	 				var _token = $('input[name="_token"]').val();
					$.ajax({
						url: "<?php echo e(route('projectprocess.ajaxinvoice')); ?>",
						type: 'post',
						data: {inv_id:inv_id, _token:_token},
						success: function(result){
							// alert(result);
							var myObj = JSON.parse(result);
							$('#tr_company_id').val(myObj.inv_company_id).trigger('change');
							$('#tr_service_id').html(myObj.services);
						}
					});
				}else{
					$('#tr_service_id').html(services);
				}
			});
		});

		// DatePicker
		$('#tr_date_alert').datetimepicker({
		  format: 'YYYY-MM-DD'
	  });
		$('#tr_start_date').datetimepicker({
		  format: 'YYYY-MM-DD'
	  });
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>