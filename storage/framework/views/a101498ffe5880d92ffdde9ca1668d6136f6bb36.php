<?php $__env->startSection('css'); ?>
	<style type="text/css">
		.img.btn{
			padding: 17px;
		}
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<section class="bg-white">

		<!-- Add Button & Error Message -->
		<?php $__env->startComponent('comps.btnAdd'); ?>
			<?php $__env->slot('btnAdd'); ?>
				<?php echo e(route('files.create')); ?>

			<?php $__env->endSlot(); ?>
		<?php echo $__env->renderComponent(); ?>
		
		<br/>
		<br/>
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
			<li class="nav-item active">
				<a class="nav-link waves-effect" id="pills-group-by-company-tab" data-toggle="pill" href="#pills-group-by-company" role="tab" aria-controls="pills-group-by-company" aria-selected="true"><i class="fa fa-building"></i> បង្ហាញតាមក្រុមហ៊ុន</a>
			</li>
			<li class="nav-item">
				<a class="nav-link waves-effect" id="pills-group-by-category-tab" data-toggle="pill" href="#pills-group-by-category" role="tab" aria-controls="pills-group-by-category" aria-selected="false"><i class="fa fa-file"></i> បង្ហាញតាមផ្នែក</a>
			</li>
			<li class="nav-item">
				<a class="nav-link waves-effect" id="pills-file-list-tab" data-toggle="pill" href="#pills-file-list" role="tab" aria-controls="pills-file-list" aria-selected="false"><i class="far fa-file-alt"></i> បង្ហាញឯកសារនិមួយៗ</a>
			</li>
		</ul>
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane active in" id="pills-group-by-company" role="tabpanel" aria-labelledby="pills-group-by-company-tab">
				<table class="table table-striped table-hover" id="dataTable">
					<thead>
						<tr>
							<th width="5%">N&deg;</th>
							<th>​ក្រុម​ហ៊ុន</th>
							<th>ប្រភេទឯកសារ</th>
							<th>ពិនិត្យ</th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($company->com_name != "Unknown"): ?>
								<?php
									$file_where_com = DB::table('files')->where('f_company_id', $company->id)->get();
									$pdf_count = 0;
									$img_count = 0;
									foreach ($file_where_com as $key => $fwc) {
										if (substr(strrchr($fwc->f_name,'.'),1) == 'pdf'){
											$pdf_count++;
										}else{
											$img_count++;
										}
									}
								?>
								<tr>
									<td><?php echo e($i+1); ?></td>
									<td>
											<?php echo e($company->com_name); ?>

											<span class="badge badge-danger"><?php echo e($file_where_com->count()); ?>

									</td>
									<td>
										<ul class="list-unstyled" style="margin: 0;">
											<li>
												<i class="fa fa-file-pdf"></i> Personal Digital File (PDF) <span class="badge badge-danger"><?php echo e($pdf_count); ?></span>
											</li>
											<li>
												<i class="fa fa-image"></i>	Image (JPEG, PNG) <span class="badge badge-danger"><?php echo e($img_count); ?></span>
											</li>
										</ul>
									</td>
									<td>
										<a href="<?php echo e(route('files.show',$company->id)); ?>" title="Show" class="edit btn btn-info btn-sm waves-effect waves-light"><i class="fa fa-eye"></i></a>
									</td>
								</tr>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>

			<div class="tab-pane fade" id="pills-group-by-category" role="tabpanel" aria-labelledby="pills-group-by-category-tab">
				<div class="row">
					<?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($company->com_name != "Unknown"): ?>
							<?php
								$file_where_com = DB::table('files')->where('f_company_id', $company->id)->get();
								
								$pdf_count = 0;
								$img_count = 0;
								foreach ($file_where_com as $key => $fwc) {
									if (substr(strrchr($fwc->f_name,'.'),1) == 'pdf'){
										$pdf_count++;
									}else{
										$img_count++;
									}
								}
							?>
						<div class="col-sm-6 mt-4">
							<ul class="list-group">
								<a href="#" class="list-group-item active">
									<h4 style="display: inline;">
										<?php echo e($company->com_name); ?>

									</h4>
									<span class="badge"><?php echo e($file_where_com->count()); ?></span>
								</a>
								<?php $__currentLoopData = $filecategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $fc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php
										$file_where_category = DB::table('files')->where('f_company_id', $company->id)->where('f_fc_id', $fc->id)->get();
									?>
									<li class="list-group-item"><?php echo e($fc->fc_name); ?> <span class="badge"><?php echo e($file_where_category->count()); ?></span></li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>

			<div class="tab-pane" id="pills-file-list" role="tabpanel" aria-labelledby="pills-file-list-tab">
				<table class="table table-striped table-hover" id="dataTable-2nd">
					<thead>
						<tr>
							<th width="5%">N&deg;</th>
							<th>​ក្រុម​ហ៊ុន</th>
							<th>ផ្នែកឯកសារ</th>
							<th>ឯកសារ</th>
							<th width="12%">កែប្រែដោយ</th>
							<th width="12%">ការបរិច្ឆេទកែប្រែ</th>
							<th width="10%">សកម្មភាព</th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($i+1); ?></td>
								<td><?php echo e($file->company->com_name); ?></td>
								<td><?php echo e($file->filecategory->fc_name); ?></td>
								<td>
									<a class="btn btn-success btn-sm" href="<?php echo e((substr(strrchr($file->f_name,'.'),1) == 'pdf') ? route('files.pdf',$file->id) : '/documents/'.$file->f_company_id.'/'.$file->f_name); ?>"><?php echo (substr(strrchr($file->f_name,'.'),1) == 'pdf') ? '<i class="fa fa-file-pdf"></i>' : '<i class="fa fa-image"></i>'; ?> <?php echo e(substr($file->f_name, strpos($file->f_name, "_") + 1)); ?></a>
								</td>
								<td><?php echo e($file->user->name); ?></td>
								<td><?php echo e($file->updated_at->format('d-m-Y')); ?></td>
								<td class="action">
									<?php echo e(Form::open(['url'=>route('files.destroy',$file->id)])); ?>

										<?php echo e(Form::hidden('_method','DELETE')); ?>

										&nbsp;&nbsp;<button type="button" title="លុបកិច្ចសន្យា" class="btn btn-sm btn-danger btn-delete waves-effect waves-light" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបកិច្ចសន្យានេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="កិច្ចសន្យាត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
										</button>
										<button type="submit" class="sub_delete sr-only"></button>
									<?php echo e(Form::close()); ?>

								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>
		
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">

		$('#dataTable-2nd').DataTable();

		// Alert Delete
		$("button.btn-delete").click(alertYesNo);
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>