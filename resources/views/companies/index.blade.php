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
				{{route('companies.create')}}
			@endslot
		@endcomponent
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>ឈ្មោះក្រុមហ៊ុន</th>
					<th>សកម្មភាពអាជីវកម្ម</th>
					<th>ឡូហ្គោ</th>
					<th width="7%">ផែនទី</th>
					<th>បុគ្គលិកទាក់ទង</th>
					<th>លេខទូរស័ព្ទទាក់ទង</th>
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($companies as $i => $com)
				<tr>
					<td>{{ $i+1 }}</td>
					<td>{{ $com->com_name }}</td>
					<td>{{ $com->objective->obj_name }}</td>
					<td><a href="{{ route('companies.image',$com->id) }}" class="img_column"><span class="img_icon fa fa-pencil-alt"></span><span class="img" style="background: url('/images/companies/{{$com->com_logo}}') center center no-repeat; background-size: cover;" /></span></a></td>
					<td><a href="{{$com->com_addr_map}}" class="btn btn-warning btn-sm"><i class="fa fa-map-marked-alt"></i></a></td>
					<td>{{ $com->com_cp_name }}</td>
					<td>{{ $com->com_cp_phone }}</td>
					<td class="action">
						<a href="{{route('companies.edit',$com->id)}}" title="Edit" class="edit btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
						{{Form::open(['url'=>route('companies.destroy',$com->id)])}}
							{{Form::hidden('_method','DELETE')}}
							<button type="button" title="លុបក្រុមហ៊ុន" class="delete btn btn-sm btn-danger" data-text="តើអ្នកចង់លុបក្រុមហ៊ុននេះមែទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="ក្រុមហ៊ុនត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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
