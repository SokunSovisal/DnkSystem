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
		font-size: 120px;
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

				<h1 class="text-center mb-4"><i class="fa fa-users"></i></h1>
				<form method="POST" action="{{ route('login') }}">
					@csrf
					<div class="form-group row">
						<div class="col-sm-10 col-sm-offset-1 mb-5">
							<div class="input-group">
							  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
							  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} input-lg" name="email" value="{{ old('email') }}" placeholder="e-mail" required autofocus/>
							</div>

							@if ($errors->has('email'))
								<span class="text-danger" role="alert">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif
						</div>

						<div class="col-sm-10 col-sm-offset-1">
							<div class="input-group">
							  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
							  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} input-lg" name="password" placeholder="password" required/>
							</div>
							@if ($errors->has('password'))
								<span class="text-danger" role="alert">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
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
								<i class="fa fa-sign-in-alt"></i> <span class="roboto_r">{{ __('Login') }}</span>
							</button>
							<a href="{{route('register')}}" class="btn btn-primary btn-block btn-lg">
								<i class="fa fa-user-plus"></i> <span class="roboto_r">{{ __('Register') }}</span>
							</a>
						</div>
					</div>

				</form>
			</div>
		</div>
	</section>
</div>
@endsection
