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
	</style>
@endsection

@section('content')
	{!! Form::open(['url' => route('process.store')]) !!}
		<section class="bg-white">
			
			<!-- Back Button & Error Message -->
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('process.index')}}
				@endslot
			@endcomponent
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group  {{ (($errors->has('pr_name'))?'has-error':'' ) }}">
								<label class="control-label">ឈ្មោះដំណើរការ <small>*</small></label>
								<input class="form-control nbr" type="text" name="pr_name" placeholder="document name" value="{{ ((count($errors) > 0) ? old('pr_name') : '') }}" autocomplete="off" required />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{ (($errors->has('pr_service_id'))?'has-error':'' ) }}">
								<label class="control-label">សេវាកម្ម <small>*</small></label>
                <select name="pr_service_id" class="form-control nbr select2" id="pr_service_id" required>
                  <option value="">-- ជ្រើសរើសសេវាកម្ម --</option>
                  @foreach($services as $i => $service)
                    <option value="{{$service->id}}">{{$service->s_name}}</option>
                  @endforeach
                </select>
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control" name="pr_description"  style="height: 108px;" placeholder="description">{{ ((count($errors) > 0) ? old('pr_description') : '') }}</textarea>
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
