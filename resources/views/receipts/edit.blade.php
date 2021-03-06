@extends('layouts.app')

@section('css')
	<style type="text/css">
	
	</style>
@endsection

@section('content')

	{!! Form::open(['url' => route('receipts.update', $receipt->id)]) !!}
		{{ Form::hidden('_method', 'PUT') }}
		<section class="bg-white">
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('receipts.index')}}
				@endslot
			@endcomponent
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('rec_number'))?'has-error':'')}}">
								<label class="control-label">លេខប័ណ្ណទទួលប្រាក់ <small>*</small></label>
								<input class="form-control nbr" type="text" name="rec_number" placeholder="quotation number" value="{{ ((count($errors) > 0) ? old('rec_number') : $receipt->rec_number) }}" autocomplete="off" required />
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ថ្ងៃខែ & ម៉ោង <small>*</small></label>
								<div class='input-group date'>
									<input class="form-control nbr" type="text" id='datepicker' name="rec_date" placeholder="date & time" value="{{ ((count($errors) > 0) ? old('rec_date') : $receipt->rec_date) }}" autocomplete="off" required data-mask="9999-99-99" />
									<span class="nbr input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">វិក្កយប័ត្រយោង <small>*</small></label>
								<input type="hidden" name="inv_id" value="{{$receipt->rec_inv_id}}" />
								<select name="rec_inv_id" id="rec_inv_id" class="form-control nbr select2" disabled>
									<option value="">-- ជ្រើសរើសវិក្កយប័ត្រ --</option>
									@foreach($invoice as $i => $inv)
										<option value="{{$inv->id}}" {{ ($receipt->rec_inv_id == $inv->id) ? 'selected':'' }}>{{$inv->inv_number}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">បរិយាយ <small>*</small></label>
								<input class="form-control nbr" type="text" value="{{ ((count($errors) > 0) ? old('rec_description') : $receipt->rec_description) }}" placeholder="description" name="rec_description" autocomplete="off" />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">លក់ជូនក្រុមហ៊ុន <small>*</small></label>
								<select name="rec_company_id" id="rec_company_id" class="form-control nbr select2" disabled>
									<option value="">-- ជ្រើសរើសក្រុមហ៊ុន --</option>
									@foreach($companies as $i => $com)
										<option value="{{$com->id}}" {{ ($receipt->invoice->inv_company_id == $com->id) ? 'selected':'' }}>{{$com->com_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('rec_full_amount'))?'has-error':'')}}">
								<label class="control-label">ទឹកប្រាក់សរុប <small>*</small></label>
								<input class="form-control nbr" type="text" id="rec_full_amount" name="rec_full_amount" value="{{ ((count($errors) > 0) ? old('rec_full_amount') : $receipt->rec_full_amount ) }}" placeholder="total amount" readonly />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('rec_received_amount'))?'has-error':'')}}">
								<label class="control-label">ទឹកប្រាក់ទទួលបាន <small>*</small></label>
								<input class="form-control nbr" type="text" id="rec_received_amount" name="rec_received_amount" value="{{ ((count($errors) > 0) ? old('rec_received_amount') : $receipt->rec_received_amount ) }}" placeholder="received amount" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ទឹកប្រាក់នៅសល់ <small>*</small></label>
								<input class="form-control nbr" type="text" name="rec_balance" id="rec_balance" value="{{ ((count($errors) > 0) ? old('rec_balance') : $receipt->rec_balance ) }}" placeholder="balance" readonly />
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

		$(document).ready(function() {

			$('#rec_received_amount').keyup( function(){
				var full_amount = parseFloat($('#rec_full_amount').val());
				var received_amount = parseFloat($(this).val());
				if ($.isNumeric( received_amount ) && $.isNumeric( full_amount )) {
					if ( full_amount >= received_amount && $('#rec_full_amount').val() != '') {
						$('#rec_balance').val(full_amount - received_amount);
					}else if ($('#rec_full_amount').val() == 0) {
						$(this).val($(this).val().slice(0, -1));
					}else{
						$(this).val($(this).val().slice(0, -1));
					}

				}else{
					$(this).val($(this).val().slice(0, -1));
				}
			});

			if ($('#rec_inv_id').val()!='') {
				var id = $('#rec_inv_id').val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{route('ajax.receiptinvoice')}}",
					type: 'post',
					data: {id:id, _token:_token},
					success: function(result){
						var data = result.split(":");
            $('#company_id').val(data[0]).trigger('change.select2');
						$('#rec_full_amount').val(data[1] - data[2] + parseFloat($('#rec_received_amount').val()));
						$('#rec_balance').val((parseFloat($('#rec_full_amount').val()) - parseFloat($('#rec_received_amount').val())));
					}
				});
			}else{
        $('#rec_company_id').val('').trigger('change.select2');
				$('#rec_full_amount').val(0);
			}
		});

	</script>
@endsection
