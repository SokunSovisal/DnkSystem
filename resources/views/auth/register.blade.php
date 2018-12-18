@extends('layouts.login')

@section('css')
<style type="text/css">
	body{
		background: url('/images/login_bg.jpg') no-repeat;
		background-size: cover;
	}
	.login{
		margin-top: 20vh;
	}
	.login .row > div .img{
		margin-top: 30px;
		padding: 20px 0;
		border-right: 1px solid #fff;
		text-align: center;
	}
	.login .row > div .img img{
		width: 80%;
		margin: auto;
	}
	.login h1{
		font-size: 90px;
		color: #fff;
		text-shadow: 3px 3px 3px rgba(0,0,0,0.5);
	}
</style>
@endsection
@section('content')

<div class="container">
	<section class="login">
		
		<div class="row">
			<div class="col-sm-7">
				<div class="img">
					<img src="/images/login_logo.png" alt="" />
				</div>
			</div>
			<div class="col-sm-5">

				<h1 class="text-center mb-4"><i class="fa fa-user-plus"></i></h1>
				<form method="POST" action="{{ route('register') }}">
					@csrf
					<div class="form-group row">

						<!-- =============== User Name -->
						<div class="col-sm-10 col-sm-offset-1 mb-3">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
								<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="userame"/>
							</div>
							@if ($errors->has('name'))
								<span class="text-danger" role="alert">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
							@endif
						</div>

						<!-- =============== User Email -->
						<div class="col-sm-10 col-sm-offset-1 mb-3">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="fa fa-at"></i></span>
								<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="email"/>
							</div>
							@if ($errors->has('email'))
								<span class="text-danger" role="alert">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif
						</div>

						<!-- =============== User Password -->
						<div class="col-sm-10 col-sm-offset-1 mb-3">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
								<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="password"/>
							</div>
							@if ($errors->has('password'))
								<span class="text-danger" role="alert">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
						</div>

						<!-- =============== User Confirm-Password -->
						<div class="col-sm-10 col-sm-offset-1">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="confirm-password">
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-10 col-sm-offset-1">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

								<label class="form-check-label" for="remember">
									{{ __('Remember Me') }}
								</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-sm-10 col-sm-offset-1">
							<button type="submit" class="btn btn-success btn-block btn-lg">
								<i class="fa fa-unlock-alt"></i> {{ __('Register') }}
							</button>
							<a href="{{route('login')}}" class="btn btn-primary btn-block btn-lg">
								<i class="fa fa-sign-in-alt"></i> {{ __('Login') }}
							</a>
						</div>
					</div>

				</form>
			</div>
		</div>
	</section>
</div>

@endsection
