@extends('layouts.app')

@section('content')

    <div class="my-3 my-md-5">
      <div class="container">
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">My credentials</h3>
              </div>
              <div class="card-body">

                  @if(session()->has('success'))
                      <div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert"></button>
                          {{ session('success') }}
                      </div><br />
                  @endif

                  <div class="row">
                      <div class="col-lg-9"></div>
                      <div class="col-lg-3 text-right">
                          <button class="btn btn-primary btn-block" id="actualize"><i class="fe fe-refresh-ccw"></i> Reload data from sensor</button>
                      </div>
                  </div>

                  <div id="reloadNotif" class="alert alert-success invisible">
                      <button type="button" class="close" data-dismiss="alert"/></button>
                      Data reloaded
                  </div><br />

                  {!! Form::model($user, [
                      'route' => ['credentials_update', $user],
                      'method' => 'POST',
                      'class' => 'form-horizontal',
                      ]) !!}

                  {!! csrf_field() !!}

                  <div class="form-group @if($errors->first('id_connect')) has-error @endif">
                      {!! Form::label('id_connect', 'ID',['class' => 'col-sm-2 control-label']) !!}
                      <div class="col-sm-10">
                          {!! Form::text('id_connect', null, ['class' => 'form-control']) !!}
                          @if($errors->first('id_connect'))
                              <small class="form-message light">{{ $errors->first('id_connect') }}</small>
                          @endif
                      </div>
                  </div>

                  <div class="hr-line-dashed"></div>
                  <div class="form-group @if($errors->first('mdp_connect')) has-error @endif">
                      {!! Form::label('mdp_connect', 'Password',['class' => 'col-sm-2 control-label']) !!}
                      <div class="col-sm-10">
                          {!! Form::text('mdp_connect', null, ['class' => 'form-control']) !!}
                          @if($errors->first('mdp_connect'))
                              <small class="form-message light">{{ $errors->first('mdp_connect') }}</small>
                          @endif
                      </div>
                  </div>

                  <hr>
                  <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                          {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                      </div>
                  </div>
                  {!! Form::close() !!}
              </div>
            </div>
          </div>

        </div>
    </div>

    <script>

    $('#actualize').click(function() {
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
        $.ajax({
            type: 'GET',
            url: '/capteur',
            data: {},
            success: function(data){
                console.log('Success:', data);
                $('#reloadNotif').removeClass('invisible');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    </script>

@endsection
