@extends('layouts.app')

@section('css')
	<style type="text/css">

	</style>
@endsection

@section('content')
	{!! Form::open(['url' => route('users.store')]) !!}
		<section class="bg-white">
			
			<!-- Back Button & Error Message -->
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
								<label class="control-label">ឈ្មោះ <small>*</small></label>
								<input class="form-control nbr" type="text" name="name" placeholder="name" value="{{ ((count($errors) > 0) ? old('name') : '') }}" autocomplete="off" required />
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('gender'))?'has-error':'')}}">
								<label for="">ភេទ <small>*</small></label>
								<select name="gender" class="form-control nbr" required>
									<option value="">-- ជ្រើសរើសភេទ --</option>
										<option value="1" {{ ((count($errors) > 0) && (old('gender') == 1)) ? 'selected':'' }}>ប្រុស</option>
										<option value="2" {{ ((count($errors) > 0) && (old('gender') == 2)) ? 'selected':'' }}>ស្រី</option>
										<option value="3" {{ ((count($errors) > 0) && (old('gender') == 3)) ? 'selected':'' }}>ផ្សេងៗ</option>
								</select>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('phone'))?'has-error':'')}}">
								<label for="">លេខទូរស័ព្ទ <small>*</small></label>
								<input class="form-control nbr" type="text" name="phone" placeholder="phone" value="{{ ((count($errors) > 0) ? old('phone') : '') }}" autocomplete="off" required="" />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">ពណ៌នា</label>
								<textarea class="form-control nbr" name="description" style="height: 108px;" placeholder="description">{{ ((count($errors) > 0) ? old('description') : '') }}</textarea>
							</div>
						</div>

					</div>

					<div class="col-sm-6">
						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('email'))?'has-error':'')}}">
								<label for="">អ៊ីមែល <small>*</small></label>
								<input class="form-control nbr" type="email" name="email" placeholder="email" value="{{ ((count($errors) > 0) ? old('email') : '') }}" autocomplete="off" required="" />
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('password'))?'has-error':'')}}">
								<label for="">ពាក្យសម្ងាត់ <small>*</small></label>
								<input class="form-control nbr" type="password" name="password" placeholder="password" autocomplete="off" required="" />
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group {{(($errors->has('confirm_password'))?'has-error':'')}}">
								<label for="">បញ្ជាក់-ពាក្យសម្ងាត់ <small>*</small></label>
								<input class="form-control nbr" type="password" name="confirm_password" placeholder="re-password" autocomplete="off" required="" />
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
