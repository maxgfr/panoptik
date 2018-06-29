@extends('layouts.app')

@section('content')

    <div class="my-3 my-md-5">
      <div class="container">
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Place</h3>
              </div>
              <div class="card-body">
                  @if(session()->has('success'))
                      <div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          {{ session('success') }}
                      </div><br />
                  @endif

                  {!! Form::model($place, [
                      'route' => ['place.store', $place],
                      'method' => 'POST',
                      'class' => 'form-horizontal',
                      ]) !!}

                  {!! csrf_field() !!}


                  <div class="hr-line-dashed"></div>
                  <div class="form-group @if($errors->first('lat')) has-error @endif">
                      {!! Form::label('lat', 'Latitude',['class' => 'col-sm-2 control-label']) !!}
                      <div class="col-sm-10">
                          {!! Form::text('lat', null, ['class' => 'form-control']) !!}
                          @if($errors->first('lat'))
                              <small class="form-message light">{{ $errors->first('lat') }}</small>
                          @endif
                      </div>
                  </div>

                  <div class="form-group @if($errors->first('lng')) has-error @endif">
                      {!! Form::label('lng', 'Longitude',['class' => 'col-sm-2 control-label']) !!}
                      <div class="col-sm-10">
                          {!! Form::text('lng', null, ['class' => 'form-control']) !!}
                          @if($errors->first('lng'))
                              <small class="form-message light">{{ $errors->first('lng') }}</small>
                          @endif
                      </div>
                  </div>

                  {!! Form::hidden('users_id', Auth::user()->id) !!}

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

@endsection
