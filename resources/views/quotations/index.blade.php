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
				{{route('quotations.create')}}
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
					<th>លេខទំនាក់ទំនង</th>
					<th width="110px">ចម្លើយ</th>
					<th width="16%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($quotations as $i => $quote)
					<tr>
						<td>{{ $i+1 }}</td>
						<td>{{ $quote->quote_number }}</td>
						<td>{{ $quote->quote_date }}</td>
						<td>{{ $quote->company->com_name }}</td>
						<td>{{ $quote->quote_cp_phone }}</td>
						<td><span class="label label-{{($quote->quote_status==1)?'warning':(($quote->quote_status==2)?'success':'danger')}} btn-xs">{{ ($quote->quote_status==1)?'មិនទាន់មានចម្លើយ':(($quote->quote_status==2)?'ជោគជ័យ':'មិនជោគជ័យ') }}</span></td>
						<td class="action">
							<a href="{{ route('quotationservices.index','qid='.$quote->id) }}" class="btn btn-primary btn-sm" /><i class="fa fa-heart"></i></a>
							<a href="{{route('quotations.show',$quote->id)}}" title="Show" class="edit btn btn-success btn-sm"><i class="fa fa-print"></i></a>
							<a href="{{route('quotations.edit',$quote->id)}}" title="Edit" class="edit btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
							{{Form::open(['url'=>route('quotations.destroy',$quote->id)])}}
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
