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
								<select name="rec_inv_id" id="rec_inv_id" class="form-control nbr select2" required>
									<option value="">-- ជ្រើសរើសវិក្កយប័ត្រ --</option>
									@foreach($invoice as $i => $inv)
										<option value="{{$inv->id}}" {{ ($inv->id == old('rec_inv_id') || $receipt->rec_inv_id == $inv->id) ? 'selected':'' }}>{{$inv->inv_number}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">លក់ជូនក្រុមហ៊ុន <small>*</small></label>
								<select name="rec_company_id" id="rec_company_id" class="form-control nbr select2" required>
									<option value="">-- ជ្រើសរើសក្រុមហ៊ុន --</option>
									@foreach($companies as $i => $com)
										<option value="{{$com->id}}" {{ ($com->id == old('rec_company_id') || $receipt->rec_company_id == $com->id) ? 'selected':'' }}>{{$com->com_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('rec_full_ammount'))?'has-error':'')}}">
								<label class="control-label">ទឹកប្រាក់សរុប <small>*</small></label>
								<input class="form-control nbr" type="text" id="rec_full_ammount" name="rec_full_ammount" value="{{ ((count($errors) > 0) ? old('rec_full_ammount') : $receipt->rec_full_ammount ) }}" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('rec_received_ammount'))?'has-error':'')}}">
								<label class="control-label">ទឹកប្រាក់ទទួលបាន <small>*</small></label>
								<input class="form-control nbr" type="text" id="rec_received_ammount" name="rec_received_ammount" value="{{ ((count($errors) > 0) ? old('rec_received_ammount') : $receipt->rec_received_ammount ) }}" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ទឹកប្រាក់នៅសល់ <small>*</small></label>
								<input class="form-control nbr" type="text" name="rec_balance" id="rec_balance" value="{{ ((count($errors) > 0) ? old('rec_balance') : $receipt->rec_balance ) }}" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">បរិយាយ <small>*</small></label>
								<input class="form-control nbr" type="text" value="{{ ((count($errors) > 0) ? old('rec_description') : $receipt->rec_description) }}" placeholder="description" name="rec_description" autocomplete="off" />
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
			$('#rec_received_ammount').keyup( function(){
				var full_ammount = parseFloat($('#rec_full_ammount').val());
				var received_ammount = parseFloat($(this).val());
				if ($.isNumeric( received_ammount ) && $.isNumeric( full_ammount ) && $('#rec_full_ammount').val() != '') {
					if (full_ammount >= received_ammount) {
						$('#rec_balance').val(full_ammount - received_ammount);
					}else{
						swal({
							title: 'ទិន្នន័យបញ្ចូលមិនត្រឹមត្រូវ',
							text: 'ទឹកប្រាក់សរុបមានចំនួនត្រូវមានចំនួនច្រើនជាងទឹកប្រាក់ទទួល',
							type: "warning",
							showConfirmButton: false,
							timer: 1200,
							onOpen: () => {
								timerInterval = setInterval(() => {
								}, 100)
							},
							onClose: () => {
								clearInterval(timerInterval)
							}
						})
					}
				}else if ($('#rec_full_ammount').val() == 0) {
					swal({
						title: 'ទិន្នន័យបញ្ចូលមិនត្រឹមត្រូវ',
						text: 'សូមមេត្តាបញ្ចូលទឹកប្រាក់សរុបជាមុនសិន',
						type: "warning",
						showConfirmButton: false,
						timer: 1200,
						onOpen: () => {
							timerInterval = setInterval(() => {
							}, 100)
						},
						onClose: () => {
							clearInterval(timerInterval)
						}
					})
				}else{
					swal({
						title: 'ទិន្នន័យបញ្ចូលមិនត្រឹមត្រូវ',
						text: 'សូមមេត្តាបញ្ចូលតម្លៃលេខ',
						type: "warning",
						showConfirmButton: false,
						timer: 1200,
						onOpen: () => {
							timerInterval = setInterval(() => {
							}, 100)
						},
						onClose: () => {
							clearInterval(timerInterval)
						}
					})
				}
			});
		});

	</script>
@endsection
