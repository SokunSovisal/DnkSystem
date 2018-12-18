@extends('layouts.app')

@section('css')
	<style type="text/css">
		.fileinput-new{
			width: 100%;

		}
		.thumbnail{
			width: 100%;

		}
		.thumbnail img{
			width: 100%;
		}
	</style>
@endsection

@section('content')
	{!! Form::open(['enctype'=>'multipart/form-data', 'url' => route('companies.image_update', $company->id)]) !!}
		{{ Form::hidden('_method', 'PUT') }}
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('companies.index')}}
				@endslot
			@endcomponent
			<br/>
			<br/>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<section class="bg-white">
						<div class="fileinput fileinput-new" data-provides="fileinput">
						  <div class="fileinput-new thumbnail">
						    <img data-src="/images/companies/{{$company->com_logo}}" src="/images/companies/{{$company->com_logo}}" alt="...">
						  </div>
						  <div class="fileinput-preview fileinput-exists thumbnail" style="width: 100%;"></div>
						  <div>
						    <span class="btn btn-primary btn-file mt-2">
						    	<span class="fileinput-new">Select image</span>
						    	<span class="fileinput-exists">Change</span><input type="file" name="com_logo">
						    </span>
						    <a href="#" class="btn btn-warning fileinput-exists mt-2" data-dismiss="fileinput">Remove</a>
						  </div>
						</div>
					</section>
				</div>
			</div>
		<br/>
		<br/>

		@include('comps.btnsubmit')
	{!! Form::close() !!}
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>

@endsection

@section('js')
	<script type="text/javascript">

	</script>
@endsection
