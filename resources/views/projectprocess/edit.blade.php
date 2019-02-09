@extends('layouts.app')

@section('css')
	<style type="text/css">
	
	</style>
@endsection

@section('content')

	{!! Form::open(['url' => route('projectprocess.update', $transaction->id)]) !!}
		{{ Form::hidden('_method', 'PUT') }}
		<section class="bg-white">
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('projectprocess.index')}}
				@endslot
			@endcomponent
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group has-err {{ (($errors->has('tr_start_date'))?'has-error':'' ) }}">
								<label class="control-label">ការបរិច្ឆេទ <small>*</small></label>
								<div class='input-group date'>
									<input class="form-control nbr" type="text" id='tr_start_date' name="tr_start_date" placeholder="date & time" value="{{ ((count($errors) > 0) ? old('tr_start_date') : $transaction->tr_start_date) }}" autocomplete="off" required data-mask="9999-99-99" />
								  <span class="nbr input-group-addon">
									  <span class="glyphicon glyphicon-calendar"></span>
								  </span>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{ (($errors->has('tr_date_count'))?'has-error':'' ) }}">
								<label class="control-label">ការប៉ានប្រម៉ានពេលវេលា <small>*</small></label>
								<div class='input-group date'>
									<input class="form-control" type="number" pattern="[0-9]" min="0" id='tr_date_count' value="{{$transaction->tr_date_count}}" name="tr_date_count" placeholder="estimate time" value="{{ ((count($errors) > 0) ? old('tr_date_count') : '') }}" autocomplete="off" />
								  <span class="input-group-addon">
									  ថ្ងៃ
								  </span>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{ (($errors->has('tr_invoice_id'))?'has-error':'' ) }}">
								<label class="control-label">វិក្កយត្រប័ត្រ {{$transaction->tr_company_id}}</label>
                <select name="tr_invoice_id" class="form-control select2" id="tr_invoice_id">
                  <option value="">-- សូមជ្រើសរើស --</option>
                  @foreach($invoices as $i => $invoice)
                    <option value="{{$invoice->id}}" {{ (($invoice->id == old('tr_invoice_id') || $invoice->id == $transaction->tr_invoice_id )? 'selected':'') }}>{{$invoice->inv_number}}</option>
                  @endforeach
                </select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{ (($errors->has('tr_company_id'))?'has-error':'' ) }}">
								<label class="control-label">ក្រុមហ៊ុន <small>*</small></label>
                <select name="tr_company_id" class="form-control select2" id="tr_company_id" required>
                  <option value="">-- សូមជ្រើសរើស --</option>
                  @foreach($companies as $i => $company)
                    <option value="{{$company->id}}" {{ (($company->id == old('tr_company_id') || $company->id == $transaction->tr_company_id )? 'selected':'') }}>{{$company->com_name}}</option>
                  @endforeach
                </select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{ (($errors->has('tr_service_id'))?'has-error':'' ) }}">
								<label class="control-label">សេវាកម្ម <small>*</small></label>
                <select name="tr_service_id" class="form-control select2" id="tr_service_id" required>
                  <option value="">-- សូមជ្រើសរើស --</option>
                  @foreach($services as $i => $service)
                    <option value="{{$service->id}}" {{ (($service->id == old('tr_service_id') || $service->id == $transaction->tr_service_id )? 'selected':'') }}>{{$service->s_name}}</option>
                  @endforeach
                </select>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group has-err {{ (($errors->has('tr_date_alert'))?'has-error':'' ) }}">
								<label class="control-label">ការបរិច្ឆេទជូនដំណឹង <small>*</small></label>
								<div class='input-group date'>
									<input class="form-control nbr" type="text" id='tr_date_alert' name="tr_date_alert" placeholder="date & time" value="{{ ((count($errors) > 0) ? old('tr_date_alert') : $transaction->tr_date_alert) }}" autocomplete="off" required data-mask="9999-99-99" />
								  <span class="nbr input-group-addon">
									  <span class="glyphicon glyphicon-calendar"></span>
								  </span>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{ (($errors->has('tr_verify_by'))?'has-error':'' ) }}">
								<label class="control-label">អនុញ្ញាត្ដិដោយ <small>*</small></label>
                <select name="tr_verify_by" class="form-control select2" id="tr_verify_by" required>
                  <option value="">-- សូមជ្រើសរើស --</option>
                  @foreach($users as $i => $user)
                    <option value="{{$user->id}}" {{(($user->id == old('tr_verify_by') || $user->id == $transaction->tr_verify_by )? 'selected':'' )}}>{{$user->name}}</option>
                  @endforeach
                </select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control" name="tr_description"  style="height: 184px;" placeholder="description">{{ ((count($errors) > 0) ? old('tr_description') : $transaction->tr_description) }}</textarea>
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


		$(document).ready(function() {

			$('#tr_invoice_id').change(function(){

				var services = $('#tr_service_id').html();
				if ($(this).val()!='') {
				  var inv_id = $(this).val();
	 				var _token = $('input[name="_token"]').val();
					$.ajax({
						url: "{{route('projectprocess.ajaxinvoice')}}",
						type: 'post',
						data: {inv_id:inv_id, _token:_token},
						success: function(result){
							// alert(result);
							var myObj = JSON.parse(result);
							$('#tr_company_id').val(myObj.inv_company_id).trigger('change');
							$('#tr_service_id').html(myObj.services);
						}
					});
				}else{
					$('#tr_service_id').html(services);
				}
			});
		});

		// DatePicker
		$('#tr_date_alert').datetimepicker({
		  format: 'YYYY-MM-DD'
	  });
		$('#tr_start_date').datetimepicker({
		  format: 'YYYY-MM-DD'
	  });
	</script>
@endsection
