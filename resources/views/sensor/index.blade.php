@extends('layouts.app')

@section('content')

    <div class="my-3 my-md-5">
      <div class="container">
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add a sensor</h3>
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-lg-9"></div>
                      <div class="col-lg-3 text-right">
                          <a class="btn btn-primary btn-block" href="{{route('sensor.create')}}"><i class="fa fa-plus"></i> Add a sensor</a>
                      </div>
                  </div>
                  @if(session()->has('success'))
                      <div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert"></button>
                          {{ session('success') }}
                      </div><br />
                  @endif
                  @if(session()->has('error'))
                      <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert"></button>
                          {{ session('error') }}
                      </div><br />
                  @endif

                  <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                      <thead>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th class="text-right">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($sensor as $ss)
                          <tr>
                              <td>
                                  {{ $ss->id }}
                              </td>
                              <td>
                                  {{ $ss->name }}
                              </td>
                              <td class="text-right">
                                  <div class="btn-group">
                                      <div class="row">
                                          <div class="col-xs-12">
                                              {!! Form::model($ss, ['method' => 'DELETE', 'route' => ['sensor.destroy', $ss], 'style' => 'display:inline;']) !!}
                                              {!! csrf_field() !!}
                                              {!! Form::submit('Supprimer', ['class' => 'btn btn-outline btn-danger btn-xs']) !!}
                                              {!! Form::close() !!}
                                          </div>
                                      </div>
                                  </div>
                              </td>
                          </tr>
                      @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                          <td colspan="5">
                              <ul class="pagination pull-right"></ul>
                          </td>
                      </tr>
                      </tfoot>
                  </table>

              </div>
            </div>
          </div>

        </div>
    </div>

@endsection
