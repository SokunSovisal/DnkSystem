@extends('layouts.app')

@section('css')
	<style type="text/css">
	
	</style>
@endsection

@section('content')
	{!! Form::open(['enctype'=>'multipart/form-data', 'url' => route('agreements.store')]) !!}
		{{ Form::hidden('_method', 'PUT') }}
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
										<option value="{{$com->id}}" {{ ($com->id == $agreement->agr_company_id || $com->id == old('agr_company_id')) ? 'selected':'' }}>{{$com->com_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label>ពណ៌នា</label>
								<textarea class="form-control nbr" name="agr_description" style="height: 34px;" placeholder="description">{{ ((count($errors) > 0) ? old('agr_description') : $agreement->agr_company_id) }}</textarea>
							</div>
						</div>
						
						@foreach(unserialize($agreement->agr_files) as $i => $file)
						
								<input id="test" name="test[]" type="text" value="{{$file}}" data-path="/files/agreements/{{$agreement->agr_company_id}}/{{$file}}" />
								
						@endforeach

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

	</script>
@endsection
