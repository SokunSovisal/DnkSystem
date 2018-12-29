@extends('layouts.app')

@section('css')
	<style type="text/css">
		.img.btn{
			padding: 17px;
		}
	</style>
@endsection

@section('content')
	
	<section class="bg-white">

		<!-- Add Button & Error Message -->
		@component('comps.btnAdd')
			@slot('btnAdd')
				{{route('files.create')}}
			@endslot
		@endcomponent
		
		<br/>
		<br/>
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
			<li class="nav-item active">
				<a class="nav-link" id="pills-group-by-company-tab" data-toggle="pill" href="#pills-group-by-company" role="tab" aria-controls="pills-group-by-company" aria-selected="true"><i class="fa fa-building"></i> បង្ហាញតាមក្រុមហ៊ុន</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="pills-group-by-category-tab" data-toggle="pill" href="#pills-group-by-category" role="tab" aria-controls="pills-group-by-category" aria-selected="false"><i class="fa fa-file"></i> បង្ហាញតាមផ្នែក</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="pills-file-list-tab" data-toggle="pill" href="#pills-file-list" role="tab" aria-controls="pills-file-list" aria-selected="false"><i class="far fa-file-alt"></i> បង្ហាញឯកសារនិមួយៗ</a>
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
						@foreach($companies as $i => $company)
							@if($company->com_name != "Unknown")
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
									<td>{{ $i+1 }}</td>
									<td>
											{{ $company->com_name }}
											<span class="badge badge-danger">{{$file_where_com->count()}}
									</td>
									<td>
										<ul class="list-unstyled" style="margin: 0;">
											<li>
												<i class="fa fa-file-pdf"></i> Personal Digital File (PDF) <span class="badge badge-danger">{{$pdf_count}}</span>
											</li>
											<li>
												<i class="fa fa-image"></i>	Image (JPEG, PNG) <span class="badge badge-danger">{{$img_count}}</span>
											</li>
										</ul>
									</td>
									<td>
										<a href="{{route('files.show',$company->id)}}" title="Show" class="edit btn btn-info"><i class="fa fa-eye"></i></a>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="tab-pane fade" id="pills-group-by-category" role="tabpanel" aria-labelledby="pills-group-by-category-tab">
				<div class="row">
					@foreach($companies as $i => $company)
						@if($company->com_name != "Unknown")
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
										{{ $company->com_name }}
									</h4>
									<span class="badge">{{$file_where_com->count()}}</span>
								</a>
								@foreach($filecategories as $i => $fc)
									<?php
										$file_where_category = DB::table('files')->where('f_company_id', $company->id)->where('f_fc_id', $fc->id)->get();
									?>
									<li class="list-group-item">{{$fc->fc_name}} <span class="badge">{{$file_where_category->count()}}</span></li>
								@endforeach
							</ul>
						</div>
						@endif
					@endforeach
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
						@foreach($files as $i => $file)
							<tr>
								<td>{{ $i+1 }}</td>
								<td>{{ $file->company->com_name }}</td>
								<td>{{ $file->filecategory->fc_name }}</td>
								<td><a href="{{route('files.show',$file->id)}}" class="btn btn-info"><i class="fa fa-file-alt"></i></a></td>
								<td>{{ $file->user->name }}</td>
								<td>{{ $file->updated_at->format('d-m-Y') }}</td>
								<td class="action">
									<a href="{{route('files.edit',$file->id)}}" title="Edit" class="edit text-info"><i class="fa fa-pencil-alt"></i></a>
									/
									{{Form::open(['url'=>route('files.destroy',$file->id)])}}
										{{Form::hidden('_method','DELETE')}}
										<button type="button" title="លុបកិច្ចសន្យា" class="delete text-danger" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបកិច្ចសន្យានេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="កិច្ចសន្យាត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
										</button>
										<button type="submit" class="sub_delete sr-only"></button>
									{{Form::close()}}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
	</section>
@endsection

@section('js')
	<script type="text/javascript">

		$('#dataTable-2nd').DataTable();

		$("button.delete").click(alertYesNo);
	</script>
@endsection
