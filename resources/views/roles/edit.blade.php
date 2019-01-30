@extends('layouts.app')

@section('css')
	<style type="text/css">

	</style>
@endsection

@section('content')
	{!! Form::open(['url' => route('roles.update', $ms->id)]) !!}
		{{ Form::hidden('_method', 'PUT') }}
		<section class="bg-white">
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('roles.index')}}
				@endslot
			@endcomponent
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('ur_name'))?'has-error':'')}}">
								<label for="">ឈ្មោះ <small>*</small></label>
								<input class="form-control nbr" type="text" name="ur_name" placeholder="name" value="{{ $errors->has('ur_name') ? old('ur_name') : $ms->ur_name }}" autocomplete="off" required="" />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control nbr" name="ur_description" rows="3" placeholder="description">{{ $errors->has('ur_description') ? old('ur_description') : $ms->ur_description }}</textarea>
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
