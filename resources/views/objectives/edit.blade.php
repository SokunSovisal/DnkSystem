@extends('layouts.app')

@section('css')
	<style type="text/css">

	</style>
@endsection

@section('content')
	{!! Form::open(['url' => route('objectives.update', $obj->id)]) !!}
		{{ Form::hidden('_method', 'PUT') }}
		<section class="bg-white">
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('objectives.index')}}
				@endslot
			@endcomponent
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('obj_name'))?'has-error':'')}}">
								<label for="">ឈ្មោះ <small>*</small></label>
								<input class="form-control nbr" type="text" name="obj_name" placeholder="name" value="{{ $errors->has('obj_name') ? old('obj_name') : $obj->obj_name }}" autocomplete="off" required="" />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control nbr" name="obj_description" rows="3" placeholder="description">{{ $errors->has('obj_description') ? old('obj_description') : $obj->obj_description }}</textarea>
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
