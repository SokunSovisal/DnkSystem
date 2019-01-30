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
				{{route('billsreceived.create')}}
			@endslot
		@endcomponent
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th width="12%">លេខរៀង</th>
					<th width="12%">ការបរិច្ឆេទ</th>
					<th>ក្រុមហ៊ុន</th>
					<th>តម្លៃសរុប</th>
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($billsreceived as $i => $bill)
					<tr>
						<td>{{ $i+1 }}</td>
						<td>{{ $bill->br_number }}</td>
						<td>{{ $bill->br_date }}</td>
						<td>{{ $bill->company->com_name }}</td>
						<td><i class="fa fa-dollar-sign"></i> {{ number_format($bill->br_total, 2) }}</td>
						<td class="action">
							<a href="{{route('billsreceived.edit', $bill->id)}}" title="Edit" class="edit btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
							{{Form::open(['url'=>route('billsreceived.destroy', $bill->id)])}}
								{{Form::hidden('_method','DELETE')}}
								<button type="button" title="លុបវិក្កយបត្រ" class="delete btn btn-sm btn-danger" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបវិក្កយបត្រនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="វិក្កយបត្រត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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
