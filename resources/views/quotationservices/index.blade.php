@extends('layouts.app')

@section('css')
	<style type="text/css">
		td{ font-family: 'roboto_r'!important;}
	</style>
@endsection

@section('content')


<!-- Modal -->
<div class="modal fade" id="qs" tabindex="-1" role="dialog" aria-labelledby="qsLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="qsLabel">បញ្ចូលសេវាកម្មទៅក្នុងសម្រង់តម្លៃលេខ៖ {{$quotations->quote_number}}</h4>
        <input type="hidden" name="qs_quote_id" id="qs_quote_id" value="{{$quotations->id}}"/>
      </div>
      <div class="modal-body">
      	<input type="hidden" name="qs_id" id="qs_id" />
        <div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">រើសពីការណាត់ជួប</label>
							<select class="form-control nbr dynamic_select" id="appointments">
								<option value="">-- ជ្រើសរើសការណាត់ជួប --</option>
								@foreach($appointments as $i => $appoint)
									<option value="{{$appoint->id}}">{{$appoint->app_datetime}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">សេវាកម្ម <small>*</small></label>
							<select name="qs_service_id" class="form-control nbr" id="qs_service_id" required>
								<option value="">-- ជ្រើសរើសសេវាកម្ម --</option>
								@foreach($services as $i => $service)
									<option value="{{$service->id}}">{{$service->s_name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label">តម្លៃដើម</label>
							<input class="form-control nbr" type="text" id='qs_origin_price' placeholder="origin price" value="0" autocomplete="off" disabled="" />
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label">កែប្រែតម្លៃ <small>*</small></label>
							<input class="form-control nbr" type="text" id='qs_price' placeholder="update price" autocomplete="off"/>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label">ចំនួន <small>*</small></label>
							<input class="form-control nbr" type="text" id='qs_qty' placeholder="quantity" autocomplete="off"/>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">ព័ត៌មានលម្អិត <small>*</small></label>
							<div class="input-group">
								<input class="form-control nbr" type="text" id='qs_description' placeholder="add service detail" autocomplete="off"/>
							  <span class="input-group-btn" id="btn-add">
									<span class="nbr btn btn-success"><i class="fa fa-plus"></i></span>
							  </span>
							</div>
						</div>
						<div id="qs_items">
							<label>ពណ៌នា៖</label>
						</div>
					</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger nbr" data-dismiss="modal"><i class="fa fa-times"></i> បិទចោល</button>
        <button type="button" id="addService" class="btn btn-success nbr"><i class="fa fa-save"></i> រក្សាទុក</button>
        <button type="button" id="updateService" class="btn btn-success nbr sr-only"><i class="fa fa-save"></i> រក្សាទុក</button>
      </div>
    </div>
  </div>
</div>
{{ csrf_field() }}
	
	<section class="bg-white">
		<!-- Add Button & Error Message -->
		@component('comps.btnBack')
			@slot('btnBack')
				{{route('quotations.index')}}
			@endslot
		@endcomponent
		&nbsp;
		<button type="button" class="btn btn-success nbr" data-toggle="modal" data-target="#qs"><i class="fa fa-plus"></i> បន្ថែមថ្មី</button>
		<br/>
		<br/>
		<div class="row">
			<div class="col-sm-6">
				<article class="Hello"></article>
			</div>
		</div>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>សេវាកម្ម</th>
					<th>ពណ៌នា</th>
					<th>បញ្ចូលដោយ</th>
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($quotationservices as $i => $qs)
					<tr>
						<td>{{ $i+1 }}</td>
						<td>{{ $qs->service->s_name }}</td>
						<td>
							@foreach(explode(',',$qs->qs_description) as $i => $item)
								- {{str_replace(':;', ',', $item)}} <br/>
							@endforeach
						</td>
						<td>{{ $qs->user->name }}</td>
						<td class="action">
							<span data-toggle="modal" data-target="#qs" style="cursor: pointer;" title="Edit" class="text-success edit" data-qsid="{{$qs->id}}"><i class="fa fa-pencil-alt"></i></span>
							/
							{{Form::open(['url'=>route('quotationservices.destroy',$qs->id)])}}
								{{Form::hidden('_method','DELETE')}}
								<button type="button" title="លុបសេវាកម្មពីក្នុងសម្រង់តម្លៃ" class="delete text-danger" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបសេវាកម្មពីក្នុងសម្រង់តម្លៃនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="សេវាកម្មពីក្នុងសម្រង់តម្លៃត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
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

		$(document).ready(function() {

			// Reload page After Close Modal
			$('#qs').on('hidden.bs.modal', function () {
			  	location.reload();
			}) 

			// Add Service Detail
    	$("#btn-add").click(function() {
				if ($('#qs_description').val()!='') {
	    		var lastField = $("#qs_items div:last");
	        var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
	        var fieldWrapper = $('<div class="input-group mb-1 fieldwrapper"/>');
	        fieldWrapper.data("idx", intId);
	        var fName = $('<span class="sr-only nbr input-group-addon"><input type="text" name="qs_description[]" value="'+ $('#qs_description').val() +'" class="form-control" /></span>');
	        var fType = $('<input class="form-control nbr" value="'+ $('#qs_description').val() +'" type="text" disabled/>');
	        var removeButton = $('<span class="input-group-btn"><span class="nbr btn btn-danger"><i class="fa fa-times"></i></span></span>');
	        removeButton.click(function() {
	            // $(this).parent().remove();
          	var parent = $(this).parent();
						parent.fadeOut(150, function(){
							parent.remove();
						});
	        });
	        fieldWrapper.append(fName);
	        fieldWrapper.append(fType);
	        fieldWrapper.append(removeButton);
	        $("#qs_items").append(fieldWrapper);
	        $("#qs_description").val('');

        }
	    });
		});

		// Dynamic Select From Appointment
		var all_services = $('#qs_service_id').html();
		$('.dynamic_select').change(function(){
			if ($(this).val()!='') {
			  var app_id = $(this).val();
 				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{route('ajax.appointmentServices')}}",
					type: 'post',
					data: {app_id:app_id, _token:_token},
					success: function(result){
						$('#qs_service_id').html(result);
					}
				});
			}else{
				$('#qs_service_id').html(all_services);
			}
		});

		// Dynamic Select From Service
		$('#qs_service_id').change(function(){
			if ($(this).val()!='') {
			  var id = $(this).val();
 				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{route('ajax.servicePrice')}}",
					type: 'post',
					data: {id:id, _token:_token},
					success: function(result){
						$('#qs_origin_price').val(result);
						$('#qs_price').val(result);
					}
				});
			}
		});

		// Ajax store Service Detail
		$('#addService').click(function(){
			if ($('#qs_service_id').val()!='' && $('#qs_qty').val()!='' && $('#qs_price').val()!='') {
			  var service_id = $('#qs_service_id').val();
			  var qs_quote_id = $('#qs_quote_id').val();
			  var qs_qty = $('#qs_qty').val();
			  var qs_price = $('#qs_price').val();
				var values = [];
			  $("input[name='qs_description[]']").each(function() {
				    values.push($(this).val().replace(/,/g, ':;'));
				});
			  var qs_description = (values).toString();
 				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{route('quotationservices.store')}}",
					type: 'post',
					data: {service_id:service_id, qs_qty:qs_qty, qs_price:qs_price, qs_quote_id:qs_quote_id, qs_description:qs_description, _token:_token},
					success: function(dataReturn){
						swal({
				      title: 'បានជោគជ័យ',
				      text: dataReturn,
				      type: "success",
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
						$('#qs_service_id').val('');
						$('#appointments').val('');
						$('#qs_description').val('');
						$('#qs_qty').val('');
						$('#qs_price').val('');
						$('#qs_origin_price').val('');
						$('#qs_items').html('<label>ពណ៌នា៖</label>');
					}
				});
			}else{
				swal({
		      title: 'ពុំទាន់អាចរក្សាទុក!',
		      text: 'សូមបញ្ចូលទិន្នន័យជាមុនសិន',
		      type: "warning",
		      showConfirmButton: false,
				  timer: 2200,
				  onOpen: () => { timerInterval = setInterval(() => { }, 100)},
				  onClose: () => {clearInterval(timerInterval)}
				})
			}
		});

		// Ajax Edit Service Detail
		$('.edit').click(function(){

				$('#addService').addClass('sr-only');
				$('#updateService').removeClass('sr-only');

			  var id = $(this).data('qsid');
 				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "http://localhost:8000/quotationservices/"+id+"/edit",
					type: 'get',
					data: {id:id, _token:_token},
					success: function(dataReturn){

						var data = dataReturn.split(";:;");
						$('#qs_service_id').val(data[0]);
						$('#qs_id').val(data[2]);
						$('#qs_price').val(data[3]);
						$('#qs_qty').val(data[4]);
						// Add Service Description
						$('#qs_items').html('<label>ពណ៌នា៖</label>');
						var detail_item = data[1].split(",");
						if (detail_item.length > 0 && detail_item[0]!='') {
							for (var i = 0; i < detail_item.length; i++) {
				    		var lastField = $("#qs_items div:last");
				        var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
				        var fieldWrapper = $('<div class="input-group mb-1 fieldwrapper"/>');
				        fieldWrapper.data("idx", intId);
				        var fName = $('<span class="sr-only nbr input-group-addon"><input type="text" name="qs_description[]" value="'+ detail_item[i].replace(/:;/g, ',') +'" class="form-control" /></span>');
				        var fType = $('<input class="form-control nbr" value="'+ detail_item[i].replace(/:;/g, ',') +'" type="text" disabled/>');
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
				        $("#qs_items").append(fieldWrapper);
							}
						}
					}
				});
		});

		// Ajax Update Service Detail
		$('#updateService').click(function(){
			if ($('#qs_service_id').val()!='') {
			  var id = $('#qs_id').val();
			  var qs_qty = $('#qs_qty').val();
			  var qs_price = $('#qs_price').val();
			  var service_id = $('#qs_service_id').val();
				var values = [];
			  $("input[name='qs_description[]']").each(function() {
				    values.push($(this).val().replace(/,/g, ':;'));
				});
			  var qs_description = (values).toString();
 				var _token = $('input[name="_token"]').val();
 				var _method = 'PUT';
      	// <input name="_method" id="input-method" type="hidden" value="PUT">
				$.ajax({
					url: "http://localhost:8000/quotationservices/"+id,
					type: 'PATCH',
					data: {qs_price:qs_price, qs_qty:qs_qty, service_id:service_id, id:id, qs_description:qs_description, _method:_method, _token:_token},
					success: function(dataReturn){
						swal({
				      title: 'បានជោគជ័យ',
				      text: dataReturn,
				      type: "success",
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
			}else{
				swal({
		      title: 'ពុំទាន់មានសេវាកម្ម',
		      text: 'សូមបញ្ចូលសេវាកម្មជាមុនសិន',
		      type: "warning",
		      showConfirmButton: false,
				  timer: 2200,
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

	</script>
@endsection
