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
	<?php
		// $service_items = unserialize($appointment->app_services_id);
	?>

	{!! Form::open(['url' => route('appointments.update', $appointment->id)]) !!}
		{{ Form::hidden('_method', 'PUT') }}
		<section class="bg-white">
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('appointments.index')}}
				@endslot
			@endcomponent
			<br/>
			<br/>
			<div class="row">
				<div class="col-sm-6">
					<div class="col-sm-12">
						<div class="form-group {{(($errors->has('app_datetime'))?'has-error':'')}}">
							<label class="control-label">ថ្ងៃខែ & ម៉ោង <small>*</small></label>
							<div class='input-group date'>
								<input class="form-control nbr" type="text" id='datetimepicker' name="app_datetime" placeholder="date & time" value="{{ (count($errors) > 0) ? old('app_datetime') : $appointment->app_datetime }}" autocomplete="off" required data-mask="9999-99-99 99:99:99" />
								<span class="nbr input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">បុគ្គលិក <small>*</small></label>
							<select name="app_user_id" class="form-control nbr" required>
								<option value="">-- ជ្រើសរើសបុគ្គលិក --</option>
								@foreach($users as $i => $user)
									<option value="{{$user->id}}" {{ ($appointment->app_user_id==$user->id) || ($user->id == old('app_user_id')) ? 'selected':'' }}>{{$user->name}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">ក្រុមហ៊ុន <small>*</small></label>
							<select name="app_company_id" class="form-control nbr" required>
								<option value="">-- ជ្រើសរើសក្រុមហ៊ុន --</option>
								@foreach($companies as $i => $com)
									<option value="{{$com->id}}" {{ ($appointment->app_company_id==$com->id) || ($com->id == old('app_company_id')) ? 'selected':'' }}>{{$com->com_name}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">ដំណើរការចម្លើយ <small>*</small></label>
							<select name="app_status" class="form-control nbr" required>
								<option value="">-- ជ្រើសរើសដំណើរការចម្លើយ --</option>
								<option value="1" {{ ($appointment->app_status==1) || (old('app_status')==1) ? 'selected':'' }}>មិនទាន់មានចម្លើយ</option>
								<option value="2" {{ ($appointment->app_status==2) || (old('app_status')==2) ? 'selected':'' }}>ជោគជ័យ</option>
								<option value="3" {{ ($appointment->app_status==3) || (old('app_status')==3) ? 'selected':'' }}>មិនជោគជ័យ</option>
							</select>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label for="">ពណ៌នា</label>
							<textarea class="form-control nbr" name="app_description" style="height: 108px;" placeholder="description">{{ (count($errors) > 0) ? old('app_description') : $appointment->app_description }}</textarea>
						</div>
					</div>
				</div><!-- /.column -->

				<div class="col-sm-6">
					<div class="col-sm-12">
						<div class="form-group">
							<div class='input-group my-group'>
								<label class="control-label">ប្រធានបទសេវាកម្ម</label>
								<select name="services" id="services" class="form-control nbr">
									<option value="">-- ជ្រើសរើសប្រធានបទសេវាកម្ម --</option>
									@foreach($services as $i => $s)
										<option value="{{$s->id}}">{{$s->s_name}}</option>
									@endforeach
								</select>
							<span class="input-group-btn" id="btn-add">
							<span class="nbr btn btn-success"><i class="fa fa-plus"></i></span>
							</span>
							</div>
						</div>
					</div>

					<div class="col-sm-12" id="service_items">
						<label for="">សេវាកម្ម៖</label>
						@foreach(unserialize($appointment->app_services_id) as $serv)
							@foreach($services as $i => $s)
								@if($s->id==$serv)
									<div class="input-group mb-1 fieldwrapper" id="field-{{$serv}}"/>
										<span class="sr-only nbr input-group-addon service_id"><input type="text" name="app_services_id[]" value="{{$serv}}" class="form-control" /></span>
										<input class="form-control nbr" value="{{$s->s_name}}" type="text" disabled/>
										<span class="input-group-btn btn-remove"><span class="nbr btn btn-danger"><i class="fa fa-times"></i></span></span>
									</div>
								@endif
							@endforeach
						@endforeach
					</div>
				</div><!-- /.column -->
			</div><!--  /.row -->
		</section>
		<br/>

		@include('comps.btnsubmit')
	{!! Form::close() !!}

@endsection

@section('js')
	<script type="text/javascript">

		$('#datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
    });

		$(document).ready(function() {

			$('.btn-remove').click(function() {
				var parent = $(this).parent();
				parent.fadeOut(150, function(){
					parent.remove();
				});
			});
						
			$("#btn-add").click(function() {
				if ($('#services').val()!='') {

					if ($("#field-"+$('#services').val()).length > 0) {
						swal({
							title: 'តម្លៃជាន់គ្នា!',
							text: 'តម្លៃដែលបានជ្រើសរើសមានរួចហើយ',
							type: 'warning',
							confirmButtonText: 'យល់ព្រម'
						})
					}else{
						var lastField = $("#service_items div:last");
						var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
						var fieldWrapper = $('<div class="input-group mb-1 fieldwrapper" id="field-' + $('#services').val() + '"/>');
						fieldWrapper.data("idx", intId);
						var fName = $('<span class="sr-only nbr input-group-addon service_id"><input type="text" name="app_services_id[]" value="'+ $('#services').val() +'" class="form-control" /></span>');
						var fType = $('<input class="form-control nbr" value="'+ $('#services').find(':selected').text() +'" type="text" disabled/>');
						var removeButton = $('<span class="input-group-btn"><span class="nbr btn btn-danger"><i class="fa fa-times"></i></span></span>');
						removeButton.click(function() {
							var parent = $(this).parent();
							parent.fadeOut(150, function(){
								parent.remove();
							});
						});
						fieldWrapper.append(fName);
						fieldWrapper.append(fType);
						fieldWrapper.append(removeButton);
						$("#service_items").append(fieldWrapper);

					}
				}else{
					swal({
						title: 'ពុំមានទាន់មានតម្លៃ!',
						text: 'សូមជ្រើសរើសសេវាកម្មជាមុនសិន',
						type: 'warning',
						confirmButtonText: 'យល់ព្រម'
					})
				}
			});
		});
	</script>
@endsection
