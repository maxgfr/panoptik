@extends('layouts.basic')

@section('content')
    <div class="page-single">
      <div class="container">
        <div class="row">
          <div class="col col-login mx-auto">
            <div class="text-center mb-6">
              <img src="./demo/brand/tabler.svg" class="h-6" alt="">
            </div>
            <form class="card" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                @csrf
              <div class="card-body p-6">
                <div class="card-title">Create new account</div>
                <div class="form-group">
                  <label class="form-label">Name</label>
                  <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                  @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label class="form-label">Email address</label>
                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                  @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label class="form-label">Password</label>
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                  @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label class="form-label">Password Confirmation</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
                <div class="form-footer">
                  <button type="submit" class="btn btn-primary btn-block">Create new account</button>
                </div>
              </div>
            </form>
            <div class="text-center text-muted">
              Already have account? <a href="{{route('login')}}">Sign in</a>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
