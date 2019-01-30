@extends('layouts.app')

@section('css')
	<style type="text/css">

	</style>
@endsection

@section('content')
	{!! Form::open(['url' => route('users.update', $user->id)]) !!}
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
								<input class="form-control nbr" type="text" name="name" placeholder="name" value="{{ $errors->has('name') ? old('name') : $user->name }}" autocomplete="off" required="" />
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('name'))?'has-error':'')}}">
								<label for="">ភេទ <small>*</small></label>
								<select name="gender" class="form-control nbr" required>
									<option value="">-- ជ្រើសរើសភេទ --</option>
										<option value="1" {{ (($user->gender == 1) || ((count($errors) > 0) && (old('gender') == 1))) ? 'selected':'' }}>ប្រុស</option>
										<option value="2" {{ (($user->gender == 2) || ((count($errors) > 0) && (old('gender') == 1))) ? 'selected':'' }}>ស្រី</option>
										<option value="3" {{ (($user->gender == 3) || ((count($errors) > 0) && (old('gender') == 1))) ? 'selected':'' }}>ផ្សេងៗ</option>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('email'))?'has-error':'')}}">
								<label for="">អ៊ីមែល <small>*</small></label>
								<input class="form-control nbr" type="email" name="email" placeholder="email" value="{{ $errors->has('email') ? old('email') : $user->email }}" autocomplete="off" required="" />
							</div>
						</div>
					</div><!-- /.column -->

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('phone'))?'has-error':'')}}">
								<label for="">លេខទូរស័ព្ទ <small>*</small></label>
								<input class="form-control nbr" type="text" name="phone" placeholder="phone" value="{{ $errors->has('phone') ? old('phone') : $user->phone }}" autocomplete="off" required="" />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control nbr" name="description" style="height: 108px;" placeholder="description">{{ ((count($errors) > 0) ? old('description') : $user->description) }}</textarea>
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
