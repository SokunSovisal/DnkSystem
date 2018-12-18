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
				{{route('objectives.create')}}
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
					<!-- <th width="12%">បញ្ចូលដោយ</th> -->
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($objectives as $i => $obj)
				<tr>
					<td>{{ $i+1 }}</td>
					<td>{{ $obj->obj_name }}</td>
					<td>{{ $obj->obj_description }}</td>
					<!-- <td>{{ $obj->createBy->name }}</td> -->
					<td class="action">
						<a href="{{route('objectives.edit',$obj->id)}}" title="Edit" class="edit text-info"><i class="fa fa-pencil-alt"></i></a>
						/
						{{Form::open(['url'=>route('objectives.destroy',$obj->id)])}}
							{{Form::hidden('_method','DELETE')}}
							<button type="button" title="លុបសកម្មភាពអាជីវកម្ម" class="delete text-danger" data-text="បើអ្នកលុបសកម្មភាពអាជីវកម្មនេះ នោះក្រុមហ៊ុនទាំងឡាយណាដែលមានសកម្មភាពអាជីវកម្មនេះនឹងត្រូវលុបទាំងអស់។ &nbsp;តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបសកម្មភាពអាជីវកម្មនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="សកម្មភាពអាជីវកម្មត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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
