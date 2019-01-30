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
				{{route('staffs.create')}}
			@endslot
		@endcomponent
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>ឈ្មោះ</th>
					<th>តួនាទី</th>
					<th>លេខទូរស័ព្ទ</th>
					<th>អ៊ីមែល</th>
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($staffs as $i => $st)
				<tr>
					<td>{{ $i+1 }}</td>
					<td>{{ $st->st_name }}</td>
					<td>{{ $st->st_position }}</td>
					<td>{{ $st->st_phone }}</td>
					<td>{{ $st->st_email }}</td>
					<td class="action">
						<a href="{{route('staffs.edit',$st->id)}}" title="Edit" class="edit btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
						{{Form::open(['url'=>route('staffs.destroy',$st->id)])}}
							{{Form::hidden('_method','DELETE')}}
							<button type="button" title="លុបសេវាកម្ម" class="delete btn btn-danger btn-sm" data-text="តើអ្នកចង់លុបសេវាកម្មនេះមែទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="សេវាកម្មត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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
