@extends('layouts.app')

@section('css')
	<style type="text/css">
		#service_items .service_id{
			padding: 0;
			border: none;
		}
		#service_items .input-group-addon input{
			width: 34px;
		}
		#btn-add{
			padding: 24px 0 0 5px;
		}
	</style>
@endsection

@section('content')

	{!! Form::open(['url' => route('accountpayables.update', $accountpayable->id)]) !!}
		{{ Form::hidden('_method', 'PUT') }}
		<section class="bg-white">
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('accountpayables.index')}}
				@endslot
			@endcomponent
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('pt_date'))?'has-error':'')}}">
								<label class="control-label">ថ្ងៃខែ & ម៉ោង <small>*</small></label>
								<div class='input-group date'>
									<input class="form-control" type="text" id='datepicker' name="pt_date" placeholder="date & time" value="{{ ((count($errors) > 0) ? old('pt_date') : $accountpayable->pt_date) }}" autocomplete="off" required data-mask="9999-99-99" />
								  <span class="nbr input-group-addon">
									  <span class="glyphicon glyphicon-calendar"></span>
								  </span>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">បង់ទៅកាន់វិក្កយបត្រ</label>
								<input type="hidden" name="bill_id" value="{{$accountpayable->pt_bill_id}}" />
								<select name="pt_bill_id" id="pt_bill_id" class="form-control select2" disabled>
									<option value="">-- ជ្រើសរើសវិក្កយបត្រ --</option>
									@foreach($bills as $i => $bill)
										<option value="{{$bill->id}}" {{ ($bill->id == $accountpayable->pt_bill_id) ? 'selected':'' }}>{{$bill->br_number}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">បរិយាយ</label>
								<textarea class="form-control" name="pt_description" style="height: 108px;" placeholder="description">{{ ((count($errors) > 0) ? old('inv_description') : $accountpayable->pt_description) }}</textarea>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ក្រុមហ៊ុន</label>
								<select name="company_id" id="company_id" class="form-control select2" disabled>
									<option value="">-- ជ្រើសរើសក្រុមហ៊ុន --</option>
									@foreach($companies as $i => $com)
										<option value="{{$com->id}}" {{ ($com->id == $accountpayable->bill->br_company_id) ? 'selected':'' }}>{{$com->com_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ទឹកប្រាក់សរុប</label>
								<input class="form-control" type="number" id="bill_total" step="0.01" min="0" name="bill_total" placeholder="bill total" value="" autocomplete="off" readonly />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('pt_amount'))?'has-error':'')}}">
								<label class="control-label">ចំនួនទឹកប្រាក់បង់ <small>*</small></label>
								<input class="form-control" type="number" step="0.01" id="pt_amount" min="0" name="pt_amount" placeholder="paid amount" value="{{ ((count($errors) > 0) ? old('pt_amount') : $accountpayable->pt_amount) }}" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ចំនួនទឹកប្រាក់នៅសល់</label>
								<input class="form-control" type="number" step="0.01" id="pt_balance" min="0" name="pt_balance" placeholder="balance" value="{{ ((count($errors) > 0) ? old('pt_balance') : '') }}" autocomplete="off" readonly />
							</div>
						</div>
					</div><!-- /.column -->
				</div><!--  /.row -->
		</section>
		<br/>
		{{ csrf_field() }}

		@include('comps.btnsubmit')
	{!! Form::close() !!}

@endsection

@section('js')
	<script type="text/javascript">

		// DatePicker
		$('#datepicker').datetimepicker({
	      format: 'YYYY-MM-DD'
	  });

		$('#pt_amount').keyup( function(){
			var full_amount = parseFloat($('#bill_total').val());
			var received_amount = parseFloat($(this).val());
			if ($.isNumeric( received_amount ) && $.isNumeric( full_amount )) {
				if ( full_amount >= received_amount && $('#bill_total').val() != '') {
					$('#pt_balance').val(full_amount - received_amount);
				}else if ($('#bill_total').val() == 0) {
					$(this).val($(this).val().slice(0, -1));
				}else{
					$(this).val($(this).val().slice(0, -1));
				}

			}else{
				$(this).val($(this).val().slice(0, -1));
			}
		});

		if ($('#pt_bill_id').val()!='') {
			var id = $('#pt_bill_id').val();
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: "{{route('ajax.accountpayable')}}",
				type: 'post',
				data: {id:id, _token:_token},
				success: function(result){
					var data = result.split(":");
          $('#company_id').val(data[0]).trigger('change.select2');
					$('#bill_total').val(data[1] - data[2] + parseFloat($('#pt_amount').val()));
					$('#pt_balance').val((parseFloat($('#bill_total').val()) - parseFloat($('#pt_amount').val())));
				}
			});
		}
	</script>
@endsection
