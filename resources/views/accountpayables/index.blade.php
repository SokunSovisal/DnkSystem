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
				{{route('accountpayables.create')}}
			@endslot
		@endcomponent
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th width="12%">ការបរិច្ឆេទ</th>
					<th>លេខវិក្កយបត្រ</th>
					<th>ប្រាក់បានបង់</th>
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($accountpayables as $i => $ap)
					<tr>
						<td>{{ $i+1 }}</td>
						<td>{{ $ap->pt_date }}</td>
						<td>{{ $ap->bill->br_number }}</td>
						<td><i class="fa fa-dollar-sign"></i> {{ number_format($ap->pt_amount, 2) }}</td>
						<td class="action">
							<a href="{{route('accountpayables.edit', $ap->id)}}" title="Edit" class="edit btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
							{{Form::open(['url'=>route('accountpayables.destroy', $ap->id)])}}
								{{Form::hidden('_method','DELETE')}}
								<button type="button" title="លុបកាទូរទាត់ប្រាក់" class="delete btn btn-sm btn-danger" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបកាទូរទាត់ប្រាក់នេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="កាទូរទាត់ប្រាក់ត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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
