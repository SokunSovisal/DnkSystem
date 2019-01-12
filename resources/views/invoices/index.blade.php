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
				{{route('invoices.create')}}
			@endslot
		@endcomponent
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th width="10%">លេខរៀង</th>
					<th width="10%">ការបរិច្ឆេទ</th>
					<th>ក្រុមហ៊ុន</th>
					<th width="110px">វិក្កយបត្រលម្អិត</th>
					<th>តម្លៃមុនVAT</th>
					<th>តម្លៃសរុបចុងក្រោយ</th>
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($invoices as $i => $invoice)
					<tr>
						<td>{{ $i+1 }}</td>
						<td>{{ $invoice->inv_number }}</td>
						<td>{{ $invoice->inv_date }}</td>
						<td>{{ $invoice->company->com_name }}</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('invoices.detail',$invoice->id) }}" class="btn btn-primary btn-sm" /><i class="fa fa-pencil-alt"></i> <i class="fa fa-info"></i></a></td>
						<td><i class="fa fa-dollar-sign"></i>{{ number_format($invoice->inv_total, 2) }}</td>
						<td><i class="fa fa-dollar-sign"></i> {{ number_format($invoice->inv_total*1.1, 2) }}</td>
						<td class="action">
							<a href="{{route('invoices.show', $invoice->id)}}" title="Show" class="edit text-info"><i class="fa fa-print"></i></a>
							/
							<a href="{{route('invoices.edit', $invoice->id)}}" title="Edit" class="edit text-success"><i class="fa fa-pencil-alt"></i></a>
							/
							{{Form::open(['url'=>route('invoices.destroy', $invoice->id)])}}
								{{Form::hidden('_method','DELETE')}}
								<button type="button" title="លុបសម្រង់តម្លៃ" class="delete text-danger" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបសម្រង់តម្លៃនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="សម្រង់តម្លៃត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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
