@extends('layouts.app')

@section('css')
	<style type="text/css">

	</style>
@endsection

@section('content')
	{!! Form::open(['url' => route('services.update', $service->id)]) !!}
		{{ Form::hidden('_method', 'PUT') }}
		<section class="bg-white">
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('services.index')}}
				@endslot
			@endcomponent
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('s_name'))?'has-error':'')}}">
								<label for="">ឈ្មោះ <small>*</small></label>
								<input class="form-control nbr" type="text" name="s_name" placeholder="name" value="{{ $errors->has('s_name') ? old('s_name') : $service->s_name }}" autocomplete="off" required="" />
							</div>
						</div>
						<br/>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">សេវាកម្មធំ <small>*</small></label>
								<select name="s_ms_id" class="form-control nbr" required>
									<option value="">-- ជ្រើសរើសសេវាកម្មធំ --</option>
									@foreach($m_services as $i => $ms)
										<option value="{{$ms->id}}" {{ ($ms->id == $service->s_ms_id) ? 'selected':'' }}>{{$ms->ms_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<br/>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('s_price'))?'has-error':'')}}">
								<label class="control-label">តម្លៃ <small>*</small></label>
								<input class="form-control nbr" type="text" name="s_price" placeholder="price" value="{{ ((count($errors) > 0) ? old('s_price') : $service->s_price) }}" autocomplete="off" required />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control nbr" name="s_description" rows="3" placeholder="description">{{ $errors->has('s_description') ? old('s_description') : $service->s_description }}</textarea>
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
