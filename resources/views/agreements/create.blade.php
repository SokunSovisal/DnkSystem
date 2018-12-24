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
		.file-preview{
			border-radius: 0;
		}
	</style>
@endsection

@section('content')
	{!! Form::open(['enctype'=>'multipart/form-data', 'url' => route('agreements.store')]) !!}
		<section class="bg-white">
			
			<!-- Back Button & Error Message -->
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('agreements.index')}}
				@endslot
			@endcomponent
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ក្រុមហ៊ុន <small>*</small></label>
								<select name="agr_company_id" class="form-control nbr select2" required>
									<option value="">-- ជ្រើសរើសក្រុមហ៊ុន --</option>
									@foreach($companies as $i => $com)
										<option value="{{$com->id}}" {{ ($com->id == old('agr_company_id')) ? 'selected':'' }}>{{$com->com_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label>ពណ៌នា</label>
								<textarea class="form-control nbr" name="agr_description" style="height: 34px;" placeholder="description">{{ ((count($errors) > 0) ? old('agr_description') : '') }}</textarea>
							</div>
						</div>
					</div><!-- /.column -->
					
					<div class="col-sm-12">
						<div class="col-sm-12">
							<label>ឯកសារ</label>
							<div class="file-loading">
								<input id="agr_file" name="agr_file[]" multiple type="file" class="file" data-allowed-file-extensions='["pdf","txt", "jpg", "jpeg", "png"]' accept="image/png, image/jpeg, image/jpg, application/pdf, text/plain" required />
							</div>
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

		// $.fn.fileinput.defaults = {
		// 	language: 'en',
		// 	showCaption: true,
		// 	showPreview: true,
		// 	showRemove: true,
		// 	showUpload: false, // <------ just set this from true to false
		// 	showCancel: true,
		// 	showUploadedThumbs: true,
		// 	// many more below
		// };

		$("#agr_file").fileinput({
				showRemove: true,
				showUpload: false
		});
	</script>
@endsection
