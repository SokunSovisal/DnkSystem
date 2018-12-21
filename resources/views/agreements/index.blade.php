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
				{{route('agreements.create')}}
			@endslot
		@endcomponent
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>​ក្រុម​ហ៊ុន</th>
					<th>ឯកសារ</th>
					<th width="12%">កែប្រែដោយ</th>
					<th width="12%">ការបរិច្ឆេទកែប្រែ</th>
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($agreements as $i => $agr)
					<tr>
						<td>{{ $i+1 }}</td>
						<td>{{ $agr->company->com_name }}</td>
						<td>{{ $agr->agr_files }}</td>
						<td>{{ $agr->user->name }}</td>
						<td>{{ $agr->updated_at }}</td>
						<td class="action">
							<a href="{{route('agreements.edit',$agr->id)}}" title="Edit" class="edit text-info"><i class="fa fa-pencil-alt"></i></a>
							/
							{{Form::open(['url'=>route('agreements.destroy',$agr->id)])}}
								{{Form::hidden('_method','DELETE')}}
								<button type="button" title="លុបកិច្ចសន្យា" class="delete text-danger" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបកិច្ចសន្យានេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="កិច្ចសន្យាត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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
