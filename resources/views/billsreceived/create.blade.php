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
	{!! Form::open(['url' => route('billsreceived.store')]) !!}
		<section class="bg-white">
			
			<!-- Back Button & Error Message -->
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('billsreceived.index')}}
				@endslot
			@endcomponent
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('br_number'))?'has-error':'')}}">
								<label class="control-label">លេខរៀងវិក្ដយបត្រ <small>*</small></label>
								<input class="form-control" type="text" name="br_number" placeholder="bill number" value="{{ ((count($errors) > 0) ? old('br_number') : '') }}" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ពីក្រុមហ៊ុនជូនក្រុមហ៊ុន <small>*</small></label>
								<select name="br_company_id" id="br_company_id" class="form-control select2" required>
									<option value="">-- ជ្រើសរើសក្រុមហ៊ុន --</option>
									@foreach($companies as $i => $com)
										<option value="{{$com->id}}" {{ ($com->id == old('br_company_id')) ? 'selected':'' }}>{{$com->com_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('br_date'))?'has-error':'')}}">
								<label class="control-label">ថ្ងៃខែ & ម៉ោង <small>*</small></label>
								<div class='input-group date'>
									<input class="form-control" type="text" id='datepicker' name="br_date" placeholder="date & time" value="{{ ((count($errors) > 0) ? old('br_date') : '') }}" autocomplete="off" required data-mask="9999-99-99" />
								  <span class="nbr input-group-addon">
									  <span class="glyphicon glyphicon-calendar"></span>
								  </span>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('br_total'))?'has-error':'')}}">
								<label class="control-label">ចំនួនទឹកប្រាក់ <small>*</small></label>
								<input class="form-control" type="number" step="0.01" min="0" name="br_total" placeholder="bill amount" value="{{ ((count($errors) > 0) ? old('br_total') : '') }}" autocomplete="off" required />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-12">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">បរិយាយ</label>
								<textarea class="form-control" name="br_description" id="myEditor">{{ ((count($errors) > 0) ? old('inv_description') : '') }}</textarea>
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
