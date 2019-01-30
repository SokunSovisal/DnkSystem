@extends('layouts.app')

@section('css')
	<style type="text/css">

	</style>
@endsection

@section('content')
	
	<section class="bg-white">
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>ឡូហ្គោ</th>
					<th>ឈ្មោះក្រុមហ៊ុន</th>
					<th>សកម្មភាពអាជីវកម្ម</th>
					<th>បុគ្គលិកទាក់ទង</th>
					<th width="13%">ផែនទី</th>
				</tr>
			</thead>
			<tbody>
				@foreach($companies as $i => $com)
				<tr>
					<td>{{ $i+1 }}</td>
					<td><span class="img_column" style=" display: block; background: url('/images/companies/{{$com->com_logo}}') center center no-repeat; background-size: cover;" /></span></td>
					<td>{{ $com->com_name }}</td>
					<td>{{ $com->objective->obj_name }}</td>
					<td>{{ $com->com_cp_phone }}</td>
					<td><a href="{{$com->com_addr_map}}" class="btn btn-warning btn-sm btn-block" target="_blank"><i class="fa fa-map-marked-alt"></i> មើលផែនទី</a></td>
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
