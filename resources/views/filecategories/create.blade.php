@extends('layouts.app')

@section('css')
	<style type="text/css">
	</style>
@endsection

@section('content')
	{!! Form::open(['enctype'=>'multipart/form-data', 'url' => route('filecategories.store')]) !!}
		<section class="bg-white">
			
			<!-- Back Button & Error Message -->
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('filecategories.index')}}
				@endslot
			@endcomponent
			
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('fc_name'))?'has-error':'')}}">
								<label class="control-label">ឈ្មោះ <small>*</small></label>
								<input class="form-control nbr" type="text" name="fc_name" placeholder="name" value="{{ ((count($errors) > 0) ? old('fc_name') : '') }}" autocomplete="off" required />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label>ពណ៌នា</label>
								<textarea class="form-control nbr" name="fc_description" rows="3" placeholder="description">{{ ((count($errors) > 0) ? old('fc_description') : '') }}</textarea>
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
