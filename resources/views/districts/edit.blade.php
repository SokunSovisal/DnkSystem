@extends('layouts.app')

@section('css')
	<style type="text/css">

	</style>
@endsection

@section('content')
	{!! Form::open(['url' => route('districts.update', $dist->id)]) !!}
		{{ Form::hidden('_method', 'PUT') }}
		<section class="bg-white">
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
								<label for="">ឈ្មោះ <small>*</small></label>
								<input class="form-control nbr" type="text" name="dist_name" placeholder="name" value="{{ $errors->has('dist_name') ? old('dist_name') : $dist->dist_name }}" autocomplete="off" required="" />
							</div>
						</div>
						<br/>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">ស្ថិតក្នុងខេត្ត <small>*</small></label>
								<select name="dist_province_id" class="form-control nbr" required>
									<option value="">-- ជ្រើសរើសខេត្ត --</option>
									@foreach($provinces as $i => $pro)
										<option value="{{$pro->id}}" {{ ($pro->id == $dist->dist_province_id) ? 'selected':'' }}>{{$pro->pro_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<br/>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('dist_code'))?'has-error':'')}}">
								<label class="control-label">កូដតំបន់​​</label>
								<input class="form-control nbr" type="text" name="dist_code" placeholder="price" value="{{ ((count($errors) > 0) ? old('dist_code') : $dist->dist_code) }}" autocomplete="off" required />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control nbr" name="dist_description" rows="3" placeholder="description">{{ $errors->has('dist_description') ? old('dist_description') : $dist->dist_description }}</textarea>
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
