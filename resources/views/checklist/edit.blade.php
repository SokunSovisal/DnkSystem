@extends('layouts.app')

@section('css')
	<style type="text/css">
	
	</style>
@endsection

@section('content')

	{!! Form::open(['url' => route('checklist.update', $checklist->id)]) !!}
		{{ Form::hidden('_method', 'PUT') }}
		<section class="bg-white">
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('checklist.index')}}
				@endslot
			@endcomponent
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group has-err {{ (($errors->has('ch_name'))?'has-error':'' ) }}">
								<label class="control-label">ឈ្មោះឯកសារ <small>*</small></label>
								<input class="form-control nbr" type="text" name="ch_name" placeholder="document name" value="{{ ((count($errors) > 0)? old('ch_name') : $checklist->ch_name) }}" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{ (($errors->has('ch_service_id'))?'has-error':'' ) }}">
								<label class="control-label">សេវាកម្ម <small>*</small></label>
                <select name="ch_service_id" class="form-control nbr select2" id="ch_service_id" required>
                  <option value="">-- ជ្រើសរើសសេវាកម្ម --</option>
                  @foreach($services as $i => $service)
                    <option value="{{$service->id}}" {{(($service->id==$checklist->ch_service_id)? 'selected':'')}} >{{$service->s_name}}</option>
                  @endforeach
                </select>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control" name="ch_description"  style="height: 108px;" placeholder="description">{{ ((count($errors) > 0) ? old('ch_description') : $checklist->ch_description) }}</textarea>
							</div>
						</div>
					</div><!-- /.column -->
				</div><!--  /.row -->
		</section>
		<br/>
		{{ csrf_field() }}

		@include('comps.btnsubmit')
	{!! Form::close() !!}

@endsection

@section('js')
	<script type="text/javascript">

	</script>
@endsection
