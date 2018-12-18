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
				{{route('users.create')}}
			@endslot
		@endcomponent
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>ឈ្មោះ</th>
					<th>ឋានៈ</th>
					<th>តួនាទី</th>
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $i => $user)
				<tr>
					<td>{{ $i+1 }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->userrole->ur_name }}</td>
					<td>{{ $user->position }}</td>
					<td class="action">
						<a href="{{route('roles.edit',$user->id)}}" title="Edit" class="edit text-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil-alt"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</section>
@endsection

@section('js')
	<script type="text/javascript">
		
	</script>
@endsection
