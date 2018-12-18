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
				{{route('services.create')}}
			@endslot
		@endcomponent
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>ឈ្មោះ</th>
					<th>តម្លៃ</th>
					<th>ស្ថិតក្នុងសេវាកម្មធំ</th>
					<!-- <th width="12%">បញ្ចូលដោយ</th> -->
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($services as $i => $s)
				<tr>
					<td>{{ $i+1 }}</td>
					<td>{{ $s->s_name }}</td>
					<td>{{ $s->s_price }}</td>
					<td>{{ $s->mainservice->ms_name }}</td>
					<!-- <td>{{ $s->createdBy->name }}</td> -->
					<td class="action">
						<a href="{{route('services.edit',$s->id)}}" title="Edit" class="edit text-info"><i class="fa fa-pencil-alt"></i></a>
						/
						{{Form::open(['url'=>route('services.destroy',$s->id)])}}
							{{Form::hidden('_method','DELETE')}}
							<button type="button" title="លុបសេវាកម្ម" class="delete text-danger" data-text="តើអ្នកចង់លុបសេវាកម្មនេះមែទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="សេវាកម្មត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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
