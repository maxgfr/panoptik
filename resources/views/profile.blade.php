@extends('layouts.app')

@section('content')

    <div class="my-3 my-md-5">
      <div class="container">
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">My personnal information</h3>
              </div>
              <div class="card-body">
                  @if(session()->has('success'))
                      <div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          {{ session('success') }}
                      </div><br />
                  @endif

                  {!! Form::model($user, [
                      'route' => ['user_update', $user],
                      'method' => 'POST',
                      'class' => 'form-horizontal',
                      ]) !!}

                  {!! csrf_field() !!}


                  <div class="hr-line-dashed"></div>
                  <div class="form-group @if($errors->first('name')) has-error @endif">
                      {!! Form::label('name', 'Name',['class' => 'col-sm-2 control-label']) !!}
                      <div class="col-sm-10">
                          {!! Form::text('name', null, ['class' => 'form-control']) !!}
                          @if($errors->first('name'))
                              <small class="form-message light">{{ $errors->first('name') }}</small>
                          @endif
                      </div>
                  </div>

                  <div class="form-group @if($errors->first('email')) has-error @endif">
                      {!! Form::label('email', 'E-mail',['class' => 'col-sm-2 control-label']) !!}
                      <div class="col-sm-10">
                          {!! Form::text('email', null, ['class' => 'form-control']) !!}
                          @if($errors->first('email'))
                              <small class="form-message light">{{ $errors->first('email') }}</small>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password" class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                          <input id="password" type="password" class="form-control" name="password" >
                          @if ($errors->has('password'))
                              <small class="form-message light">{{ $errors->first('password') }}</small>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }}">
                      <label for="password-confirm" class="col-sm-2 control-label">Confirm it</label>
                      <div class="col-sm-10">
                          <input id="password-confirm" type="password" class="form-control" name="password-confirm" >
                          @if ($errors->has('password-confirm'))
                              <small class="form-message light">{{ $errors->first('password-confirm') }}</small>
                          @endif
                      </div>
                  </div>

                  <hr>
                  <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                          {!! Form::submit('Save change', ['class' => 'btn btn-primary']) !!}
                      </div>
                  </div>
                  {!! Form::close() !!}
              </div>
            </div>
          </div>

        </div>
    </div>

@endsection
