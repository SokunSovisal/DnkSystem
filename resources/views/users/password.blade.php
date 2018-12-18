@extends('layouts.app')

@section('css')
	<style type="text/css">

	</style>
@endsection

@section('content')
	{!! Form::open(['url' => route('users.password_update', $user->id)]) !!}
		{{ Form::hidden('_method', 'PUT') }}
		<section class="bg-white">
			@component('comps.btnBack')
				@slot('btnBack')
					{{route('users.index')}}
				@endslot
			@endcomponent
			<br/>
			<br/>
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">អ៊ីមែល</label>
								<input class="form-control nbr" type="text" name="email" placeholder="email" value="{{ $user->email }}" autocomplete="off" required="" disabled />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('password'))?'has-error':'')}}">
								<label for="">ពាក្យសម្ងាត់ <small>*</small></label>
								<input class="form-control nbr" type="password" name="password" placeholder="password" autocomplete="off" required/>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('confirm_password'))?'has-error':'')}}">
								<label for="">បញ្ជាក់-ពាក្យសម្ងាត់ <small>*</small></label>
								<input class="form-control nbr" type="password" name="confirm_password" placeholder="re-password" autocomplete="off" required/>
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
