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
					<th>តម្លៃមុនVAT</th>
					<th>តម្លៃសរុបចុងក្រោយ</th>
					<th width="18%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($invoices as $i => $invoice)
					<tr>
						<td>{{ $i+1 }}</td>
						<td>{{ $invoice->inv_number }}</td>
						<td>{{ $invoice->inv_date }}</td>
						<td>{{ $invoice->company->com_name }}</td>
						<td><i class="fa fa-dollar-sign"></i> {{ number_format($invoice->inv_total, 2) }}</td>
						<td><i class="fa fa-dollar-sign"></i> {{ (($invoice->inv_vat_status==1)? number_format($invoice->inv_total, 2) : number_format($invoice->inv_total*1.1, 2) ) }}</td>
						<td class="action">
							<a href="{{ route('invoices.detail',$invoice->id) }}" class="btn btn-primary btn-sm" /><i class="fa fa-info"></i></a>
							<a href="{{route('invoices.show', $invoice->id)}}" title="Show" class="edit btn btn-success btn-sm"><i class="fa fa-print"></i></a>
							<a href="{{route('invoices.edit', $invoice->id)}}" title="Edit" class="edit btn btn-sm btn-info"><i class="fa fa-pencil-alt"></i></a>
							{{Form::open(['url'=>route('invoices.destroy', $invoice->id)])}}
								{{Form::hidden('_method','DELETE')}}
								<button type="button" title="លុបវិក្កយបត្រ" class="delete btn btn-danger btn-sm" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបវិក្កយបត្រនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="វិក្កយបត្រត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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
