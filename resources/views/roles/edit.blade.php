@extends('layouts.app')

@section('css')
	<style type="text/css">

	</style>
@endsection

@section('content')
	{!! Form::open(['url' => route('roles.update', $user->id)]) !!}
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
							<div class="form-group {{(($errors->has('name'))?'has-error':'')}}">
								<label for="">ឈ្មោះ</label>
								<input class="form-control nbr" type="text" name="name" placeholder="name" value="{{ $errors->has('name') ? old('name') : $user->name }}" autocomplete="off" required="" disabled />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('user_role_id'))?'has-error':'')}}">
								<label for="">ឋានៈ <small>*</small></label>
								<select name="user_role_id" class="form-control nbr" required>
									<option value="">-- ជ្រើសរើសឋានៈ --</option>
									@foreach($roles as $i => $role)
										<option value="{{$role->id}}" {{ ($role->id == $user->user_role_id) ? 'selected':'' }}>{{$role->ur_name}}</option>
									@endforeach
								</select>
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
