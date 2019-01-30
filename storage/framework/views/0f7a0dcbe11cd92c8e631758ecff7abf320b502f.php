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
	<?php echo Form::open(['url' => route('invoices.store')]); ?>

		<section class="bg-white">
			
			<!-- Back Button & Error Message -->
			<?php $__env->startComponent('comps.btnBack'); ?>
				<?php $__env->slot('btnBack'); ?>
					<?php echo e(route('invoices.index')); ?>

				<?php $__env->endSlot(); ?>
			<?php echo $__env->renderComponent(); ?>
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('inv_number'))?'has-error':'')); ?>">
								<label class="control-label">លេខរៀងវិក្ដយបត្រ <small>*</small></label>
								<input class="form-control nbr" type="text" name="inv_number" placeholder="invoice number" value="<?php echo e(((count($errors) > 0) ? old('inv_number') : (isset($invoice->inv_number)? str_pad($invoice->inv_number+1, 6, '0', STR_PAD_LEFT): '000001'))); ?>" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">លក់ជូនក្រុមហ៊ុន <small>*</small></label>
								<select name="inv_company_id" id="inv_company_id" class="form-control nbr select2" required>
									<option value="">-- ជ្រើសរើសក្រុមហ៊ុន --</option>
									<?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $com): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($com->id); ?>" <?php echo e(($com->id == old('inv_company_id')) ? 'selected':''); ?>><?php echo e($com->com_name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('inv_com_phone'))?'has-error':'')); ?>">
								<label class="control-label">លេខទូរស័ព្ទ</label>
								<input class="form-control nbr" type="text" name="inv_com_phone" id="inv_com_phone" placeholder="attend's phone" value="<?php echo e(((count($errors) > 0) ? old('inv_com_phone') : '')); ?>" autocomplete="off" />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('inv_date'))?'has-error':'')); ?>">
								<label class="control-label">ថ្ងៃខែ & ម៉ោង <small>*</small></label>
								<div class='input-group date'>
									<input class="form-control nbr" type="text" id='datepicker' name="inv_date" placeholder="date & time" value="<?php echo e(((count($errors) > 0) ? old('inv_date') : '')); ?>" autocomplete="off" required data-mask="9999-99-99" />
								  <span class="nbr input-group-addon">
									  <span class="glyphicon glyphicon-calendar"></span>
								  </span>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('inv_vat_status'))?'has-error':'')); ?>">
								<label class="control-label">ប្រភេទវិក្កយបត្រ <small>*</small></label>
								<select name="inv_vat_status" id="inv_vat_status" class="form-control nbr" required>
									<option value="">-- ជ្រើសរើសប្រភេទវិក្កយបត្រ --</option>
										<option value="1" <?php echo e((old('inv_vat_status')=="1") ? 'selected':''); ?>>វិក្កយបត្រធម្មតា</option>
										<option value="2" <?php echo e((old('inv_vat_status')=="2") ? 'selected':''); ?>>វិក្កយបត្រអាករ</option>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('inv_quote_refer'))?'has-error':'')); ?>">
								<label class="control-label">យោងតាមសម្រង់តម្លៃ</label>
								<select name="inv_quote_refer" id="inv_quote_refer" class="form-control nbr select2">
									<option value="">-- ជ្រើសរើសសម្រង់តម្លៃ --</option>
									<?php $__currentLoopData = $quotations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($quote->id); ?>" <?php echo e(($quote->id == old('inv_quote_refer')) ? 'selected':''); ?>><?php echo e($quote->quote_number); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-12">
						<div class="col-sm-12">
							<div class="form-group <?php echo e((($errors->has('inv_com_address'))?'has-error':'')); ?>">
								<label class="control-label">អាសយដ្ឋាន</label>
								<input class="form-control nbr" type="text" name="inv_com_address" id="inv_com_address" placeholder="company address" value="<?php echo e(((count($errors) > 0) ? old('inv_com_address') : '')); ?>" autocomplete="off"/>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">រយៈពេលនិងលក្ខខណ្ឌ</label>
								<textarea class="form-control" name="inv_description" id="myEditor"><?php echo e(((count($errors) > 0) ? old('inv_description') : '')); ?></textarea>
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

			$('#inv_company_id').change(function(){
				if ($(this).val()!='') {
				  var id = $(this).val();
	 				var _token = $('input[name="_token"]').val();
					$.ajax({
						url: "<?php echo e(route('ajax.invoiceCompany')); ?>",
						type: 'post',
						data: {id:id, _token:_token},
						success: function(result){
							var data = result.split(":");;
							$('#inv_com_phone').val(data[0]);
							$('#inv_com_address').val(data[1]);
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