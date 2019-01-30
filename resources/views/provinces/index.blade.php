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
				{{route('provinces.create')}}
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
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($provinces as $i => $pro)
				<tr>
					<td>{{ $i+1 }}</td>
					<td>{{ $pro->pro_name }}</td>
					<td>{{ $pro->pro_description }}</td>
					<td class="action">
						<a href="{{route('provinces.edit',$pro->id)}}" title="Edit" class="edit btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
						{{Form::open(['url'=>route('provinces.destroy',$pro->id)])}}
							{{Form::hidden('_method','DELETE')}}
							<button type="button" title="លុបទីតាំងខេត្ត" class="delete btn btn-danger btn-sm" data-text="តើអ្នកចង់លុបទីតាំងខេត្តនេះមែទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="ទីតាំងខេត្តត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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
