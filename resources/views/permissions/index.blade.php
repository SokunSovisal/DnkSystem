@extends('layouts.app')

@section('css')
	<style type="text/css">

	</style>
@endsection

@section('content')
<!-- Large modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog" role="document" style="min-width: 88%;">
    <div class="modal-content nbr">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title khmerOsmoul">សិទ្ធអ្នកប្រើប្រាស់ <span class="show_monthly roboto_r"></span></h4>
      </div>
      <div class="modal-body">
				<div class="row">
					<div class="col-sm-3">
						<input type="hidden" id="ur_id"/>
						<select name="module" id="module" class="form-control nbr">
							<option value="all">-- មេនុយទាំងអស់ --</option>
							@foreach($modules as $i => $module)
								<option value="{{ $module->id }}">{{ $module->m_name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<br/>
      	<div class="permission-model-body">
      		
      	</div>
      </div>
      <div class="modal-footer pb-1 pt-1">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &nbsp;បិទ</button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>
	
	<section class="bg-white vs-datatable">
		<br/>
		<table class="datatable table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>ឈ្មោះ</th>
					<th>បរិយាយ</th>
					<th class="text-center">អ្នកប្រើប្រាស់</th>
					<th class="disabled-sorting text-right">កំណត់សិទ្ធិ </th>
				</tr>
			</thead>
			<tbody>
				@foreach($roles as $i => $role)
				<tr>
					<td>{{ $i+1 }}</td>
					<td>{{ $role->ur_name }}</td>
					<td>{{ $role->ur_description }}</td>
					<td class="text-center"><span class="badge badge-danger">{{ $role->users->count() }}</span></td>
					<td class="text-right"><button type="button" onclick="permission('{{ $role->id }}', 'btn-permission')" data-toggle="modal" data-target=".bs-example-modal-lg" title="Permission" id="permission" class="btn btn-info btn-sm"><i class="fa fa-user-graduate"></i> &nbsp;សិទ្ធិ</button></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</section>
@endsection

@section('js')
	<script type="text/javascript">

		$('body').append('<div id="notify-permission" class="alert alert-success nbr animated sr-only text-center" style="width: 300px; left: calc(50vw - 150px); top: 33px; position: absolute; z-index: 9999999;" role="alert"></button><i class="fa fa-check"></i> &nbsp;<strong>កែប្រែបានជោគជ័យ</strong></div>');

		function permission(ur_id,type) {
			// Get User Role
			$('#ur_id').val(ur_id);

			// Get Module and _token
			if (type=='btn-permission') {
				$('#module').val('all');
				var m_id = 'all';
			}else{
				var m_id = $('#module').val();
			}
			var _token = $('input[name="_token"]').val();
			// alert(ur_id+"::"+m_id);

			// Request using Ajax
			$.ajax({
				url: "{{route('permissions.set_permission')}}",
				type: 'post',
				data: {ur_id:ur_id, m_id:m_id, _token:_token},
				success: function(result){
					// alert(result);
					$('.permission-model-body').html(result);
			    $('#per_dataTable').DataTable( {
				    "fnDrawCallback": function( oSettings ) {
			    		update_permission();
				    }
				  });
				}
			});
		}

		$('#module').change(function () {
			var ur_id = $('#ur_id').val();
			permission(ur_id, 'select-module');
		});

		function update_permission() {
			$('input[type="checkbox"]').change(function () {
				var ur_id = $('#ur_id').val();
				var m_id = $(this).data('mid');
				var p_type = $(this).data('ptype');
				var _token = $('input[name="_token"]').val();
				// alert(ur_id +"::"+ m_id+"::"+ p_type);

				// Request using Ajax
				$.ajax({
					url: "{{route('permissions.update_permission')}}",
					type: 'post',
					data: {ur_id:ur_id, m_id:m_id, p_type:p_type, _token:_token},
					success: function(result){
						// alert(result);
						if(result=='success'){
							$('#notify-permission').addClass('bounceInDown').removeClass('sr-only bounceOutUp').delay(2000).queue(function(next){
							    $(this).addClass('bounceOutUp').removeClass('bounceInDown');
							    next();
							});
							$('#notify-permission').delay( 3000 ).addClass('sr-only').removeClass('bounceInDown');
						}
					}
				});
			});
		}
	</script>
@endsection
