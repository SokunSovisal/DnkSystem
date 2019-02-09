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
				{{route('checklist.create')}}
			@endslot
		@endcomponent
		
		<br/>
		<br/>
		<div class="vs-datatable">
			<table class="table table-striped table-hover" id="dataTable">
				<thead>
					<tr>
						<th width="5%">N&deg;</th>
						<th>ឈ្មោះឯកសារ</th>
						<th width="30%">សេវាកម្ម</th>
						<th width="20%">បរិយាយ</th>
						<th width="10%" class="disabled-sorting text-right">សកម្មភាព</th>
					</tr>
				</thead>
				<tbody>
					@foreach($checklists as $i => $checklist)
						<tr>
							<td>{{ $i+1 }}</td>
							<td>{{ $checklist->ch_name }}</td>
							<td>{{ $checklist->service->s_name }}</td>
							<td>{{ $checklist->ch_description }}</td>
							<td class="action text-right">
								<a href="{{route('checklist.edit',$checklist->id)}}" title="Edit" class="edit btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
								{{Form::open(['url'=>route('checklist.destroy',$checklist->id)])}}
									{{Form::hidden('_method','DELETE')}}
									<button type="button" title="លុបសម្រង់តម្លៃ" class="delete btn btn-danger btn-sm" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបសម្រង់តម្លៃនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="សម្រង់តម្លៃត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
									</button>
									<button type="submit" class="sub_delete sr-only"></button>
								{{Form::close()}}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</section>
@endsection

@section('js')
	<script type="text/javascript">
		// Alert Delete
		$("button.delete").click(alertYesNo);
	</script>
@endsection
