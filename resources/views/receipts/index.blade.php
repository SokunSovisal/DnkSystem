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
					<th width="10%">លេខរៀង</th>
					<th width="110px">យោងវិក្កយបត្រ</th>
					<th>ក្រុមហ៊ុន</th>
					<th>តម្លៃសរុប</th>
					<th>តម្លៃបានបង់</th>
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($receipts as $i => $receipt)
					<tr>
						<td>{{ $i+1 }}</td>
						<td>{{ $receipt->rec_date }}</td>
						<td>{{ $receipt->rec_number }}</td>
						<td>{{ $receipt->invoice->inv_number }}</td>
						<td>{{ $receipt->company->com_name }}</td>
						<td><i class="fa fa-dollar-sign"> {{$receipt->rec_full_ammount}}</i></td>
						<td><i class="fa fa-dollar-sign"></i> {{ $receipt->rec_received_ammount }}</td>
						<td class="action">
							<a href="{{route('receipts.show',$receipt->id)}}" title="Show" class="edit text-info"><i class="fa fa-print"></i></a>
							/
							<a href="{{route('receipts.edit',$receipt->id)}}" title="Edit" class="edit text-success"><i class="fa fa-pencil-alt"></i></a>
							/
							{{Form::open(['url'=>route('receipts.destroy',$receipt->id)])}}
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
