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

	<?php echo Form::open(['url' => route('quotations.update', $quote->id)]); ?>

		<?php echo e(Form::hidden('_method', 'PUT')); ?>

		<section class="bg-white">
			<?php $__env->startComponent('comps.btnBack'); ?>
				<?php $__env->slot('btnBack'); ?>
					<?php echo e(route('quotations.index')); ?>

				<?php $__env->endSlot(); ?>
			<?php echo $__env->renderComponent(); ?>
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">លក់ជូនក្រុមហ៊ុន <small>*</small></label>
								<select name="quote_company_id" id="quote_company_id" class="form-control nbr select2" required>
									<option value="">-- ជ្រើសរើសក្រុមហ៊ុន --</option>
									<?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $com): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($com->id); ?>" <?php echo e(($com->id == $quote->quote_company_id) || ($com->id == old('quote_company_id')) ? 'selected':''); ?>><?php echo e($com->com_name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('quote_cp_name'))?'has-error':'')); ?>">
								<label class="control-label">ជួនចំពោះ <small>*</small></label>
								<input class="form-control nbr" type="text" name="quote_cp_name" id="quote_cp_name" placeholder="contact person" value="<?php echo e(((count($errors) > 0) ? old('quote_cp_name') : $quote->quote_cp_name)); ?>" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('quote_cp_phone'))?'has-error':'')); ?>">
								<label class="control-label">លេខទូរស័ព្ទ <small>*</small></label>
								<input class="form-control nbr" type="text" name="quote_cp_phone" id="quote_cp_phone" placeholder="attend's phone" value="<?php echo e(((count($errors) > 0) ? old('quote_cp_phone') : $quote->quote_cp_phone)); ?>" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('quote_cp_email'))?'has-error':'')); ?>">
								<label class="control-label">អ៊ីមែល</label>
								<input class="form-control nbr" type="email" name="quote_cp_email" id="quote_cp_email" placeholder="attend's email" value="<?php echo e(((count($errors) > 0) ? old('quote_cp_email') : $quote->quote_cp_email)); ?>" autocomplete="off"/>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('quote_number'))?'has-error':'')); ?>">
								<label class="control-label">លេខរៀងសម្រង់តម្លៃ <small>*</small></label>
								<input class="form-control nbr" type="text" name="quote_number" placeholder="quotation number" value="<?php echo e(((count($errors) > 0) ? old('quote_date') : $quote->quote_number)); ?>" autocomplete="off" disabled />
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('quote_date'))?'has-error':'')); ?>">
								<label class="control-label">ថ្ងៃខែ & ម៉ោង <small>*</small></label>
								<div class='input-group date'>
									<input class="form-control nbr" type="text" id='datepicker' name="quote_date" placeholder="date & time" value="<?php echo e(((count($errors) > 0) ? old('quote_date') : $quote->quote_date)); ?>" autocomplete="off" required data-mask="9999-99-99" />
								  <span class="nbr input-group-addon">
									  <span class="glyphicon glyphicon-calendar"></span>
								  </span>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ដំណើរការចម្លើយ <small>*</small></label>
								<select name="quote_status" class="form-control nbr" required>
									<option value="">-- ជ្រើសរើសដំណើរការចម្លើយ --</option>
									<option value="1" <?php echo e(($quote->quote_status ==1 || old('quote_status')==1) ? 'selected':''); ?>>មិនទាន់មានចម្លើយ</option>
									<option value="2" <?php echo e(($quote->quote_status ==2 || old('quote_status')==2) ? 'selected':''); ?>>ជោគជ័យ</option>
									<option value="3" <?php echo e(($quote->quote_status ==3 || old('quote_status')==3) ? 'selected':''); ?>>មិនជោគជ័យ</option>
								</select>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-12">
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('quote_purpose'))?'has-error':'')); ?>">
								<label class="control-label">គោលបំណង <small>*</small></label>
								<input class="form-control nbr" type="text" name="quote_purpose" placeholder="purpose" value="<?php echo e(((count($errors) > 0) ? old('quote_purpose') : $quote->quote_purpose)); ?>" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">រយៈពេលនិងលក្ខខណ្ឌ</label>
								<textarea class="form-control" name="quote_term" id="myEditor"><?php echo e($quote->quote_term); ?></textarea>
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

			$('#quote_company_id').change(function(){
				if ($(this).val()!='') {
				  var id = $(this).val();
	 				var _token = $('input[name="_token"]').val();
					$.ajax({
						url: "<?php echo e(route('ajax.quoteCompany')); ?>",
						type: 'post',
						data: {id:id, _token:_token},
						success: function(result){
							var data = result.split(":");;
							$('#quote_cp_name').val(data[0]);
							$('#quote_cp_phone').val(data[1]);
							$('#quote_cp_email').val(data[2]);
						}
					});
				}
			});
		});
		
		// CKEDITOR myEditor
		CKEDITOR.replace( 'myEditor', {
			toolbar: [
				{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
				{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Undo', 'Redo' ] },
				{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
				{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
				{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
				'/',
				{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
				{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
				{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] }
			],
	    height: '300'
		});
		
		// DatePicker
		$('#datepicker').datetimepicker({
	      format: 'YYYY-MM-DD'
	  });
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>