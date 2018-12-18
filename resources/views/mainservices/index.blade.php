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
				{{route('mainservices.create')}}
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
				@foreach($m_services as $i => $ms)
				<tr>
					<td>{{ $i+1 }}</td>
					<td>{{ $ms->ms_name }}</td>
					<td>{{ $ms->ms_description }}</td>
					<td class="action">
						<a href="{{route('mainservices.edit',$ms->id)}}" title="Edit" class="edit text-info"><i class="fa fa-pencil-alt"></i></a>
						/
						{{Form::open(['url'=>route('mainservices.destroy',$ms->id)])}}
							{{Form::hidden('_method','DELETE')}}
							<button type="button" title="លុបសេវាកម្មធំ" class="delete text-danger" data-text="បើអ្នកលុបសេវាកម្មធំនេះ នោះសេវាកម្មទាំងឡាយណាដែលស្ថិតនៅក្នុងសេវាកម្មធំនេះនឹងត្រូវលុបទាំងអស់។ &nbsp;តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបសេវាកម្មធំនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="សេវាកម្មធំត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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
