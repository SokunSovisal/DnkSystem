@extends('layouts.app')

@section('css')
	<style type="text/css">

	</style>
@endsection

@section('content')
	{!! Form::open(['url' => route('staffs.store')]) !!}
		<section class="bg-white">
			
			<!-- Back Button & Error Message -->
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('staffs.index')}}
				@endslot
			@endcomponent
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('st_name'))?'has-error':'')}}">
								<label class="control-label">ឈ្មោះ <small>*</small></label>
								<input class="form-control nbr" type="text" name="st_name" placeholder="name" value="{{ ((count($errors) > 0) ? old('st_name') : '') }}" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ភេទ <small>*</small></label>
								<select class="form-control nbr" name="st_gender" id="st_gender">
									<option value="">-- ជ្រើសរើសភេទ --</option>
									<option value="1" {{((old('st_gender')==1)? 'selected':'')}} >ប្រុស</option>
									<option value="2" {{((old('st_gender')==2)? 'selected':'')}} >ស្រី</option>
									<option value="3" {{((old('st_gender')==3)? 'selected':'')}} >ផ្សេងៗ</option>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('st_salary'))?'has-error':'')}}">
								<label class="control-label">ប្រាក់ខែ <small>*</small></label>
								<input class="form-control nbr" type="text" name="st_salary" placeholder="salary" value="{{ ((count($errors) > 0) ? old('st_salary') : '') }}" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('st_position'))?'has-error':'')}}">
								<label class="control-label">តំណែង</label>
								<input class="form-control nbr" type="text" name="st_position" placeholder="position" value="{{ ((count($errors) > 0) ? old('st_position') : '') }}" autocomplete="off" />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('st_phone'))?'has-error':'')}}">
								<label class="control-label">លេខទូរស័ព្ទ</label>
								<input class="form-control nbr" type="text" name="st_phone" placeholder="phone" value="{{ ((count($errors) > 0) ? old('st_phone') : '') }}" autocomplete="off" />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('st_email'))?'has-error':'')}}">
								<label class="control-label">អ៊ីមែល</label>
								<input class="form-control nbr" type="text" name="st_email" placeholder="email" value="{{ ((count($errors) > 0) ? old('st_email') : '') }}" autocomplete="off" />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control nbr" name="st_description" style="height: 108px;" placeholder="description">{{ ((count($errors) > 0) ? old('st_description') : '') }}</textarea>
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
