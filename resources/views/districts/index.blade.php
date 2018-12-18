@extends('layouts.app')

@section('css')
	<style type="text/css">

	</style>
@endsection

@section('content')
	
	<section class="bg-white">

		<!-- Add Button & Error Message -->
		@component('comps.btnAdd')
			@slot('btnAdd')
				{{route('districts.create')}}
			@endslot
		@endcomponent
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>ឈ្មោះ</th>
					<th>ពណ៌នា</th>
					<th>ស្ថិតក្នុងខេត្ត</th>
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($districts as $i => $dist)
				<tr>
					<td>{{ $i+1 }}</td>
					<td>{{ $dist->dist_name }}</td>
					<td>{{ $dist->dist_description }}</td>
					<td>{{ $dist->province->pro_name }}</td>
					<td class="action">
						<a href="{{route('districts.edit',$dist->id)}}" title="Edit" class="edit text-info"><i class="fa fa-pencil-alt"></i></a>
						/
						{{Form::open(['url'=>route('districts.destroy',$dist->id)])}}
							{{Form::hidden('_method','DELETE')}}
							<button type="button" title="លុបទីតាំងស្រុក" class="delete text-danger" data-text="តើអ្នកចង់លុបទីតាំងស្រុកនេះមែទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="ទីតាំងស្រុកត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
							</button>
							<button type="submit" class="sub_delete sr-only"></button>
						{{Form::close()}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</section>
@endsection

@section('js')
	<script type="text/javascript">
		// Alert Delete
		$("button.delete").click(alertYesNo);
	</script>
@endsection
