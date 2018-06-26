@extends('layouts.basic')

@section('content')

    <div class="page-single">
      <div class="container">
        <div class="row">
          <div class="col col-login mx-auto">
            <div class="text-center mb-6">
              <img src="./demo/brand/tabler.svg" class="h-6" alt="">
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" class="card" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                @csrf
              <div class="card-body p-6">
                <div class="card-title">Reset password</div>
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">

                  <label class="form-label" for="email">Email address</label>
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
                  <button type="submit" class="btn btn-primary btn-block">Send me new password</button>
                </div>
              </div>
            </form>
            <div class="text-center text-muted">
              Forget it, <a href="{{route('login')}}">send me back</a> to the sign in screen.
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
