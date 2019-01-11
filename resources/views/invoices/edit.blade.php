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

	{!! Form::open(['url' => route('invoices.update', $invoice->id)]) !!}
		{{ Form::hidden('_method', 'PUT') }}
		<section class="bg-white">
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('invoices.index')}}
				@endslot
			@endcomponent
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('inv_number'))?'has-error':'')}}">
								<label class="control-label">លេខរៀងវិក្ដយបត្រ <small>*</small></label>
								<input class="form-control nbr" type="text" name="inv_number" placeholder="quotation number" value="{{ ((count($errors) > 0) ? old('inv_number') : $invoice->inv_number) }}" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">លក់ជូនក្រុមហ៊ុន <small>*</small></label>
								<select name="inv_company_id" id="inv_company_id" class="form-control nbr select2" required>
									<option value="">-- ជ្រើសរើសក្រុមហ៊ុន --</option>
									@foreach($companies as $i => $com)
										<option value="{{$com->id}}" {{ ($com->id == old('inv_company_id') || $invoice->inv_company_id == $com->id ) ? 'selected':'' }}>{{$com->com_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('inv_com_phone'))?'has-error':'')}}">
								<label class="control-label">លេខទូរស័ព្ទ</label>
								<input class="form-control nbr" type="text" name="inv_com_phone" id="inv_com_phone" placeholder="attend's phone" value="{{ ((count($errors) > 0) ? old('inv_com_phone') : $invoice->inv_com_phone) }}" autocomplete="off" />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('inv_date'))?'has-error':'')}}">
								<label class="control-label">ថ្ងៃខែ & ម៉ោង <small>*</small></label>
								<div class='input-group date'>
									<input class="form-control nbr" type="text" id='datepicker' name="inv_date" placeholder="date & time" value="{{ ((count($errors) > 0) ? old('inv_date') : $invoice->inv_date) }}" autocomplete="off" required data-mask="9999-99-99" />
								  <span class="nbr input-group-addon">
									  <span class="glyphicon glyphicon-calendar"></span>
								  </span>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('inv_vat_status'))?'has-error':'')}}">
								<label class="control-label">ប្រភេទវិក្កយបត្រ <small>*</small></label>
								<select name="inv_vat_status" id="inv_vat_status" class="form-control nbr" required>
									<option value="">-- ជ្រើសរើសប្រភេទវិក្កយបត្រ --</option>
										<option value="1" {{ (old('inv_vat_status')=="1" || $invoice->inv_vat_status == "1") ? 'selected':'' }}>វិក្កយបត្រធម្មតា</option>
										<option value="2" {{ (old('inv_vat_status')=="2" || $invoice->inv_vat_status == "2") ? 'selected':'' }}>វិក្កយបត្រអាករ</option>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('inv_quote_refer'))?'has-error':'')}}">
								<label class="control-label">យោងតាមសម្រង់តម្លៃ</label>
								<select name="inv_quote_refer" id="inv_quote_refer" class="form-control nbr select2">
									<option value="">-- ជ្រើសរើសសម្រង់តម្លៃ --</option>
									@foreach($quotations as $i => $quote)
										<option value="{{$quote->id}}" {{ ($quote->id == old('inv_quote_refer') || $invoice->inv_quote_refer == $quote->id) ? 'selected':'' }}>{{$quote->quote_number}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-12">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('inv_com_address'))?'has-error':'')}}">
								<label class="control-label">អាសយដ្ឋាន</label>
								<input class="form-control nbr" type="text" name="inv_com_address" id="inv_com_address" placeholder="company address" value="{{ ((count($errors) > 0) ? old('inv_com_address') : $invoice->inv_com_address) }}" autocomplete="off"/>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">រយៈពេលនិងលក្ខខណ្ឌ</label>
								<textarea class="form-control" name="inv_description" id="myEditor">{{ ((count($errors) > 0) ? old('inv_description') : $invoice->inv_description) }}</textarea>
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

		$('#inv_company_id').change(function(){
			if ($(this).val()!='') {
				var id = $(this).val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{route('ajax.invoiceCompany')}}",
					type: 'post',
					data: {id:id, _token:_token},
					success: function(result){
						var data = result.split(":");;
						$('#inv_com_phone').val(data[0]);
						$('#inv_com_address').val(data[1]);
					}
				});
			}
		});
		});
		
		// CKEDITOR myEditor
		CKEDITOR.replace( 'myEditor', {
			toolbar: [
				{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
				{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Undo', 'Redo' ] },
				{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
				{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
				{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
				'/',
				{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
				{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
				{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] }
			],
	    height: '300'
		});
		
		// DatePicker
		$('#datepicker').datetimepicker({
	      format: 'YYYY-MM-DD'
	  });
	</script>
@endsection
