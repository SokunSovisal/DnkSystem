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
	<?php echo Form::open(['url' => route('appointments.store')]); ?>

		<section class="bg-white">
			
			<!-- Back Button & Error Message -->
			<?php $__env->startComponent('comps.btnBack'); ?>
				<?php $__env->slot('btnBack'); ?>
					<?php echo e(route('appointments.index')); ?>

				<?php $__env->endSlot(); ?>
			<?php echo $__env->renderComponent(); ?>
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('app_datetime'))?'has-error':'')); ?>">
								<label class="control-label">ថ្ងៃខែ & ម៉ោង <small>*</small></label>
								<div class='input-group date'>
									<input class="form-control" type="text" id='datetimepicker' name="app_datetime" placeholder="date & time" value="<?php echo e(((count($errors) > 0) ? old('app_datetime') : '')); ?>" autocomplete="off" required data-mask="9999-99-99 99:99:99" />
								  <span class="nbr input-group-addon">
									  <span class="glyphicon glyphicon-calendar"></span>
								  </span>
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">បុគ្គលិក <small>*</small></label>
								<select name="app_user_id" class="form-control select2" required>
									<option value="">-- ជ្រើសរើសបុគ្គលិក --</option>
									<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($user->id); ?>" <?php echo e(($user->id == old('app_user_id')) ? 'selected':''); ?>><?php echo e($user->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ក្រុមហ៊ុន <small>*</small></label>
								<select name="app_company_id" class="form-control select2" required>
									<option value="">-- ជ្រើសរើសក្រុមហ៊ុន --</option>
									<?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $com): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($com->id); ?>" <?php echo e(($com->id == old('app_company_id')) ? 'selected':''); ?>><?php echo e($com->com_name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ដំណើរការចម្លើយ <small>*</small></label>
								<select name="app_status" class="form-control" required>
									<option value="">-- ជ្រើសរើសដំណើរការចម្លើយ --</option>
									<option value="1" <?php echo e((old('app_status')==1) ? 'selected':''); ?>>មិនទាន់មានចម្លើយ</option>
									<option value="2" <?php echo e((old('app_status')==2) ? 'selected':''); ?>>ជោគជ័យ</option>
									<option value="3" <?php echo e((old('app_status')==3) ? 'selected':''); ?>>មិនជោគជ័យ</option>
								</select>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control" name="app_description" style="height: 108px;" placeholder="description"><?php echo e(((count($errors) > 0) ? old('app_description') : '')); ?></textarea>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<div class='input-group my-group'>
									<label class="control-label">ប្រធានបទសេវាកម្ម <small>*</small></label>
									<select name="services" id="services" class="form-control select2">
										<option value="">-- ជ្រើសរើសប្រធានបទសេវាកម្ម --</option>
										<?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($s->id); ?>"><?php echo e($s->s_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
							  <span class="input-group-btn" id="btn-add">
									<span class="nbr btn btn-success"><i class="fa fa-plus"></i></span>
							  </span>
								</div>
							</div>
						</div>

						<div class="col-sm-12" id="service_items">
							<label for="">សេវាកម្ម៖</label>
						</div>
					</div><!-- /.column -->
				</div><!--  /.row -->
		</section>
		<br/>

		<?php echo $__env->make('comps.btnsubmit', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">

	$('#datetimepicker').datetimepicker({
    format: 'YYYY-MM-DD HH:mm:ss'
	});

		$(document).ready(function() {
    	$("#btn-add").click(function() {
				if ($('#services').val()!='') {
					if ($("#field-"+$('#services').val()).length > 0) {
						swal({
						  title: 'តម្លៃជាន់គ្នា!',
						  text: 'តម្លៃដែលបានជ្រើសរើសមានរួចហើយ',
						  type: 'warning',
						  confirmButtonText: 'យល់ព្រម'
						})
					}else{
		    		var lastField = $("#service_items div:last");
		        var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
		        var fieldWrapper = $('<div class="input-group mb-1 fieldwrapper" id="field-' + $('#services').val() + '"/>');
		        fieldWrapper.data("idx", intId);
		        var fName = $('<span class="sr-only input-group-addon service_id"><input type="text" name="app_services_id[]" value="'+ $('#services').val() +'" class="form-control" /></span>');
		        var fType = $('<input class="form-control" value="'+ $('#services').find(':selected').text() +'" type="text" disabled/>');
		        var removeButton = $('<span class="input-group-btn"><span class="nbr btn btn-danger"><i class="fa fa-times"></i></span></span>');
		        removeButton.click(function() {
		            // $(this).parent().remove();
	          	var parent = $(this).parent();
							parent.fadeOut(150, function(){
								parent.remove();
							});
		        });
		        fieldWrapper.append(fName);
		        fieldWrapper.append(fType);
		        fieldWrapper.append(removeButton);
		        $("#service_items").append(fieldWrapper);

	        }
        }else{
					swal({
					  title: 'ពុំមានទាន់មានតម្លៃ!',
					  text: 'សូមជ្រើសរើសសេវាកម្មជាមុនសិន',
					  type: 'warning',
					  confirmButtonText: 'យល់ព្រម'
					})
				}
	    });
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>