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
				{{route('receipts.create')}}
			@endslot
		@endcomponent
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th width="10%">ការបរិច្ឆេទ</th>
					<th>លេខរៀង</th>
					<th>យោងវិក្កយបត្រ</th>
					<th>ប្រាក់បានទទួល</th>
					<th width="18%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($receipts as $i => $receipt)
					<tr>
						<td>{{ $i+1 }}</td>
						<td>{{ $receipt->rec_date }}</td>
						<td>{{ $receipt->rec_number }}</td>
						<td>{{ $receipt->invoice->inv_number }}</td>
						<td><i class="fa fa-dollar-sign"></i> {{ number_format($receipt->rec_received_amount, 2) }}</td>
						<td class="action">
							<a href="{{route('receipts.show',$receipt->id)}}" title="Show" class="edit btn btn-success btn-sm"><i class="fa fa-print"></i></a>
							<a href="{{route('receipts.edit',$receipt->id)}}" title="Edit" class="edit btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
							{{Form::open(['url'=>route('receipts.destroy',$receipt->id)])}}
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
	</section>
@endsection

@section('js')
	<script type="text/javascript">
		// Alert Delete
		$("button.delete").click(alertYesNo);
	</script>
@endsection
