<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo Form::open(['url' => route('companies.update', $company->id)]); ?>

		<?php echo e(Form::hidden('_method', 'PUT')); ?>

		<section class="bg-white">
			<?php $__env->startComponent('comps.btnBack'); ?>
				<?php $__env->slot('btnBack'); ?>
					<?php echo e(route('companies.index')); ?>

				<?php $__env->endSlot(); ?>
			<?php echo $__env->renderComponent(); ?>
			<br/>
			<br/>
			<!-- Company Information -->
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-building"></i> ព័ត៌មានក្រុមហ៊ុន</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="col-sm-12">
								<div class="form-group <?php echo e((($errors->has('com_name'))?'has-error':'')); ?>">
									<label class="control-label">ឈ្មោះក្រុមហ៊ុនជាភាសាខ្មែរ <small>*</small></label>
									<input class="form-control" type="text" name="com_name" placeholder="khmer name" value="<?php echo e((count($errors) > 0) ? old('com_name') : $company->com_name); ?>" autocomplete="off" required />
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group <?php echo e((($errors->has('com_name_en'))?'has-error':'')); ?>">
									<label class="control-label">ឈ្មោះក្រុមហ៊ុនជាភាសាអង់គ្លេស <small>*</small></label>
									<input class="form-control" type="text" name="com_name_en" placeholder="english name" value="<?php echo e((count($errors) > 0) ? old('com_name_en') : $company->com_name_en); ?>" autocomplete="off" required />
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">សកម្មភាពអាជីវកម្ម <small>*</small></label>
									<select name="com_objective_id" class="form-control select2" required>
										<option value="">-- ជ្រើសរើសសកម្មភាពអាជីវកម្ម --</option>
										<?php $__currentLoopData = $objectives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $obj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($obj->id); ?>" <?php echo e(($obj->id == $company->com_objective_id) ? 'selected':''); ?>><?php echo e($obj->obj_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">ប្រភេទពន្ធ <small>*</small></label>
									<select name="com_tax_size" class="form-control" required>
										<option value="">-- ជ្រើសរើសខប្រេភទ --</option>
										<option value="1" <?php echo e(($company->com_tax_size==1) ? 'selected':''); ?>>ពន្ធតូច</option>
										<option value="2" <?php echo e(($company->com_tax_size==2) ? 'selected':''); ?>>ពន្ធមធ្យម</option>
										<option value="3" <?php echo e(($company->com_tax_size==3) ? 'selected':''); ?>>ពន្ធធំ</option>
									</select>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">អ្នកផ្គត់ផ្គង / អតិថិជន <small>*</small></label>
									<select name="com_type" class="form-control" required>
										<option value="">-- ជ្រើសរើស --</option>
										<option value="1" <?php echo e(($company->com_type==1 || old('com_type')==1) ? 'selected':''); ?>>អតិថិជន</option>
										<option value="2" <?php echo e(($company->com_type==2 || old('com_type')==2) ? 'selected':''); ?>>អ្នកផ្គត់ផ្គង</option>
										<option value="3" <?php echo e(($company->com_type==3 || old('com_type')==3) ? 'selected':''); ?>>ទាំងពីរ</option>
									</select>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group <?php echo e((($errors->has('com_vat_id'))?'has-error':'')); ?>">
									<label class="control-label">លេខVAT</label>
									<input class="form-control" type="text" name="com_vat_id" placeholder="vat number" value="<?php echo e((count($errors) > 0) ? old('com_vat_id') : $company->com_vat_id); ?>" autocomplete="off" />
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">លេខទូរស័ព្ទ</label>
									<input class="form-control" type="text" name="com_phone" placeholder="phone" value="<?php echo e((count($errors) > 0) ? old('com_phone') : $company->com_phone); ?>" autocomplete="off" />
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">អ៊ីម៉ែល</label>
									<input class="form-control" type="email" name="com_email" placeholder="phone" value="<?php echo e((count($errors) > 0) ? old('com_email') : $company->com_email); ?>" autocomplete="off" />
								</div>
							</div>
						</div><!-- /.column -->

						<div class="col-sm-6">

							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">អាសយដ្ឋានផែនទី</label>
									<input class="form-control" type="text" name="com_addr_map" placeholder="map link" value="<?php echo e((count($errors) > 0) ? old('com_addr_map') : $company->com_addr_map); ?>" autocomplete="off" />
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">លេខផ្ទះ</label>
									<input class="form-control" type="text" name="com_addr_house" placeholder="#" value="<?php echo e((count($errors) > 0) ? old('com_addr_house') : $company->com_addr_house); ?>" autocomplete="off" />
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">លេខផ្លូវ</label>
									<input class="form-control" type="text" name="com_addr_street" placeholder="street" value="<?php echo e((count($errors) > 0) ? old('com_addr_street') : $company->com_addr_street); ?>" autocomplete="off" />
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">ក្រុម</label>
									<input class="form-control" type="text" name="com_addr_group" placeholder="group" value="<?php echo e((count($errors) > 0) ? old('com_addr_group') : $company->com_addr_group); ?>" autocomplete="off" />
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">ភូមិ</label>
									<input class="form-control" type="text" name="com_addr_village" placeholder="village" value="<?php echo e((count($errors) > 0) ? old('com_addr_village') : $company->com_addr_village); ?>" autocomplete="off" />
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">ឃុំ/សង្កាត់</label>
									<input class="form-control" type="text" name="com_addr_commune" placeholder="commune" value="<?php echo e((count($errors) > 0) ? old('com_addr_commune') : $company->com_addr_commune); ?>" autocomplete="off" />
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">ទីតាំងខេត្ត/រាជធានី</label>
									<select name="com_province_id" class="form-control dynamic_select select2" data-name="dist_name" data-chtable="districts" data-field="dist_province_id">
										<option value="">-- ជ្រើសរើសខេត្ត/រាជធានី --</option>
										<?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($pro->id); ?>" <?php echo e(($pro->id == $company->com_province_id) ? 'selected':''); ?>><?php echo e($pro->pro_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">ទីតាំស្រុក/ខណ្ឌ</label>
									<select name="com_district_id" class="form-control select2" id="districts">
										<option value="">-- ជ្រើសរើសស្រុក/ខណ្ឌ --</option>
										<?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $dist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($dist->id); ?>" <?php echo e(($dist->id == $company->com_district_id) ? 'selected':''); ?>><?php echo e($dist->dist_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label for="">ពណ៌នា</label>
									<textarea class="form-control" name="com_description"  style="height: 108px;" placeholder="description"><?php echo e((count($errors) > 0) ? old('com_description') : $company->com_description); ?></textarea>
								</div>
							</div>							
						</div><!-- /.column -->
					</div><!--  /.row -->
				</div>
			</div>

			<!-- Contact Person -->
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-user"></i> បុគ្គលិកទំនាក់ទំនង</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="col-sm-12">
								<div class="form-group <?php echo e((($errors->has('com_cp_name'))?'has-error':'')); ?>">
									<label class="control-label">ឈ្មោះបុគ្គលិក</label>
									<input class="form-control" type="text" name="com_cp_name" placeholder="contact person name" value="<?php echo e((count($errors) > 0) ? old('com_cp_name') : $company->com_cp_name); ?>" autocomplete="off" />
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">ភេទ</label>
									<select name="com_cp_gender" class="form-control">
										<option value="">-- ជ្រើសរើសភេទ --</option>
										<option value="1" <?php echo e(($company->com_cp_gender==1) ? 'selected':''); ?>>ប្រុស</option>
										<option value="2" <?php echo e(($company->com_cp_gender==2) ? 'selected':''); ?>>ស្រី</option>
										<option value="3" <?php echo e(($company->com_cp_gender==3) ? 'selected':''); ?>>ផ្សេងៗ</option>
									</select>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group <?php echo e((($errors->has('com_cp_phone'))?'has-error':'')); ?>">
									<label class="control-label">លេខទូរស័ព្ទ</label>
									<input class="form-control" type="text" name="com_cp_phone" placeholder="contact person phone" value="<?php echo e((count($errors) > 0) ? old('com_cp_phone') : $company->com_cp_phone); ?>" autocomplete="off" />
								</div>
							</div>
						</div><!-- /.column -->

						<div class="col-sm-6">

							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">អ៊ីម៉ែល</label>
									<input class="form-control" type="email" name="com_cp_email" placeholder="contact person email" value="<?php echo e((count($errors) > 0) ? old('com_cp_email') : $company->com_cp_email); ?>" autocomplete="off" />
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label for="">ពណ៌នា</label>
									<textarea class="form-control" name="com_cp_description" style="height: 108px;" placeholder="contact person description"><?php echo e((count($errors) > 0) ? old('com_cp_description') : $company->com_cp_description); ?></textarea>
								</div>
							</div>
						</div><!-- /.column -->
					</div><!--  /.row -->
				</div>
			</div>
			<?php echo e(csrf_field()); ?>

		</section>
		<br/>

		<?php echo $__env->make('comps.btnsubmit', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">
		$('.dynamic_select').change(function(){
			if ($(this).val()!='') {
				var name = $(this).data('name');
				var field = $(this).data('field');
			  var value = $(this).val();
			  var chtable = $(this).data('chtable');
			  var text = "ក្រុមហ៊ុន";
 				var _token = $('input[name="_token"]').val();
 				// alert(name);
				$.ajax({
					url: "<?php echo e(route('ajax.lselect')); ?>",
					type: 'post',
					data: {field:field, value:value, chtable:chtable, name:name, text:text, _token:_token},
					success: function(result){
						$('#'+chtable).html(result);
					}
				});
			}
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>