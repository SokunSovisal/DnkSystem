@extends('layouts.app')

@section('css')
	<style type="text/css">
	
	</style>
@endsection

@section('content')
	{!! Form::open(['enctype'=>'multipart/form-data', 'url' => route('files.store')]) !!}
		<section class="bg-white">
			
			<!-- Back Button & Error Message -->
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('files.index')}}
				@endslot
			@endcomponent
			
			<br/>
			<br/>
				<table class="table table-striped table-hover" id="dataTable">
					<thead>
						<tr>
							<th width="5%">N&deg;</th>
							<th>ឯកសារ</th>
							<th>ផ្នែកឯកសារ</th>
							<th width="12%">កែប្រែដោយ</th>
							<th width="12%">ការបរិច្ឆេទកែប្រែ</th>
							<th width="10%">សកម្មភាព</th>
						</tr>
					</thead>
					<tbody>
						@foreach($files as $i => $file)
							<tr>
								<td>{{ $i+1 }}</td>
								<!-- <td>{{ $file->f_name }}</td> -->
								<td><a href="{{(substr(strrchr($file->f_name,'.'),1) == 'pdf') ? route('files.pdf',$file->id) : '/documents/'.$file->f_company_id.'/'.$file->f_name}}">{{ $file->f_name }}</a></td>
								<td>{{ $file->filecategory->fc_name }}</td>
								<td>{{ $file->user->name }}</td>
								<td>{{ $file->updated_at->format('d-m-Y') }}</td>
								<td class="action">
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
		</section>
		<br/>

		@include('comps.btnsubmit')
	{!! Form::close() !!}

@endsection

@section('js')
	<script type="text/javascript">
	
	</script>
@endsection
