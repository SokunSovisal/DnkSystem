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
				{{route('roles.create')}}
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
				@foreach($roles as $i => $role)
				<tr>
					<td>{{ $i+1 }}</td>
					<td>{{ $role->ur_name }}</td>
					<td>{{ $role->ur_description }}</td>
					<td class="action">
						<a href="{{route('roles.edit',$role->id)}}" title="Edit" class="edit btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
						{{Form::open(['url'=>route('roles.destroy',$role->id)])}}
							{{Form::hidden('_method','DELETE')}}
							<button type="button" title="លុបឋានៈអ្នកគ្រប់គ្រង" class="delete btn btn-danger btn-sm" data-text="បើអ្នកលុបឋានៈអ្នកគ្រប់គ្រងនេះ នោះសេវាកម្មទាំងឡាយណាដែលស្ថិតនៅក្នុងឋានៈអ្នកគ្រប់គ្រងនេះនឹងត្រូវលុបទាំងអស់។ &nbsp;តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបឋានៈអ្នកគ្រប់គ្រងនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="ឋានៈអ្នកគ្រប់គ្រងត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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
