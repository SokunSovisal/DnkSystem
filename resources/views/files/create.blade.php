@extends('layouts.app')

@section('css')
	<style type="text/css">
	
	</style>
@endsection

@section('content')
	{!! Form::open(['enctype'=>'multipart/form-data', 'url' => route('files.store')]) !!}
		<section class="bg-white">
			
			<!-- Back Button & Error Message -->
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('files.index')}}
				@endslot
			@endcomponent
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ក្រុមហ៊ុន <small>*</small></label>
								<select name="f_company_id" class="form-control nbr select2" required>
									<option value="">-- ជ្រើសរើសក្រុមហ៊ុន --</option>
									@foreach($companies as $i => $com)
										@if($com->com_name!='Unknown')
											<option value="{{$com->id}}" {{ ($com->id == old('f_company_id')) ? 'selected':'' }}>{{$com->com_name}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ប្រភេទឯកសារ <small>*</small></label>
								<select name="f_fc_id" class="form-control nbr select2" required>
									<option value="">-- ជ្រើសរើសប្រភេទឯកសារ --</option>
									@foreach($filecategories as $i => $fc)
										<option value="{{$fc->id}}" {{ ($fc->id == old('f_fc_id')) ? 'selected':'' }}>{{$fc->fc_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>ឈ្មោះឯកសារ</label>
								<input class="form-control nbr" type="text" name="f_name" placeholder="name" value="{{ ((count($errors) > 0) ? old('f_name') : '') }}" autocomplete="off" required />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label>ពណ៌នា</label>
								<textarea class="form-control nbr" name="f_description" style="height: 108px;" placeholder="description">{{ ((count($errors) > 0) ? old('f_description') : '') }}</textarea>
							</div>
						</div>
					</div><!-- /.column -->
					<div class="col-sm-12">
						<div class="col-sm-12">
							<div class="form-group">
								<label>ឯកសារ</label>
								<div class="fileinput fileinput-new input-group" data-provides="fileinput">
									<div class="form-control nbr" data-trigger="fileinput">
										<i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span>
									</div>
									<span class="input-group-addon btn btn-primary btn-file" style="border-radius: 0;">
										<span class="fileinput-new">Select file</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="f_document" accept="image/jpeg,image/png,application/pdf" />
									</span>
									<a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
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
