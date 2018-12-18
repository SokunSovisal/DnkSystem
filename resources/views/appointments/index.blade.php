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
				{{route('appointments.create')}}
			@endslot
		@endcomponent
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>ថ្ងៃនិងម៉ោង</th>
					<th>បុគ្គលិក</th>
					<th>បុគ្គលត្រូវជួប</th>
					<th>ចម្លើយ</th>
					<th width="12%">បញ្ចូលដោយ</th>
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($appointments as $i => $app)
					<tr>
						<td>{{ $i+1 }}</td>
						<td>{{ $app->app_datetime }}</td>
						<td>{{ $app->user->name }}</td>
						<td>{{ $app->company->com_cp_name }}</td>
						<td><span class="label label-{{($app->app_status==1)?'warning':(($app->app_status==2)?'success':'danger')}} btn-xs">{{ ($app->app_status==1)?'មិនទាន់មានចម្លើយ':(($app->app_status==2)?'ជោគជ័យ':'មិនជោគជ័យ') }}</span></td>
						<td>{{ $app->user->name }}</td>
						<td class="action">
							<a href="{{route('appointments.edit',$app->id)}}" title="Edit" class="edit text-info"><i class="fa fa-pencil-alt"></i></a>
							/
							{{Form::open(['url'=>route('appointments.destroy',$app->id)])}}
								{{Form::hidden('_method','DELETE')}}
								<button type="button" title="លុបការណាត់ជួប" class="delete text-danger" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបការណាត់ជួបនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="ការណាត់ជួបត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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
