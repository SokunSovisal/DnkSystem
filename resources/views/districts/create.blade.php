@extends('layouts.app')

@section('css')
	<style type="text/css">

	</style>
@endsection

@section('content')
	{!! Form::open(['url' => route('districts.store')]) !!}
		<section class="bg-white">
			
			<!-- Back Button & Error Message -->
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('districts.index')}}
				@endslot
			@endcomponent
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('dist_name'))?'has-error':'')}}">
								<label class="control-label">ឈ្មោះ <small>*</small></label>
								<input class="form-control nbr" type="text" name="dist_name" placeholder="name" value="{{ ((count($errors) > 0) ? old('dist_name') : '') }}" autocomplete="off" required />
							</div>
						</div>
						<br/>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ស្ថិតក្នុងខេត្ត <small>*</small></label>
								<select name="dist_province_id" class="form-control nbr select2" required>
									<option value="">-- ជ្រើសរើសខេត្ត --</option>
									@foreach($provinces as $i => $pro)
										<option value="{{$pro->id}}" {{ ($pro->id == old('dist_province_id')) ? 'selected':'' }}>{{$pro->pro_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<br/>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('dist_code'))?'has-error':'')}}">
								<label class="control-label">កូដតំបន់</label>
								<input class="form-control nbr" type="text" name="dist_code" placeholder="code" value="{{ ((count($errors) > 0) ? old('dist_code') : '') }}" autocomplete="off" required />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control nbr" name="dist_description" style="height: 182px;" placeholder="description">{{ ((count($errors) > 0) ? old('dist_description') : '') }}</textarea>
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
