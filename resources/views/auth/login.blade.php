@extends('layouts.basic')

@section('content')
        <div class="page-single">
          <div class="container">
            <div class="row">
              <div class="col col-login mx-auto">
                <div class="text-center mb-6">
                  <img src="./demo/brand/tabler.svg" class="h-6" alt="">
                </div>
                <form class="card" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                  <div class="card-body p-6">
                    <div class="card-title">Login to your account</div>
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Email address</label>
                        <input id="email" type="email" aria-describedby="emailHelp" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <label class="form-label">
                        Password
                        <a href="{{ route('password.request') }}" class="float-right small">I forgot password</a>
                      </label>
                      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                      @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                    </div>


                    <div class="form-group">
                      <label class="custom-control custom-checkbox">
                          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input" >
                        <span class="custom-control-label">Remember me</span>
                      </label>
                    </div>
                    <div class="form-footer">
                      <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </div>
                  </div>
                </form>
                <div class="text-center text-muted">
                  Don't have account yet? <a href="{{ route('register') }}">Sign up</a>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
