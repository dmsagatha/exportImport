@extends('master')

@section('title', 'Importar Datos')

@section('content')
  <div class="card mb-4 wow fadeIn">
    <div class="card-body d-sm-flex justify-content-between">
      <h4 class="mb-2 mb-sm-0 pt-1">
        <a href="{{ route('panel') }}">Dashboard</a>
        <span>/</span>
        <span>Importar Usuarios</span>
      </h4>
    </div>
  </div>
  
  <div class="col-md-12 mb-4">
    <div class="card">
      <div class="card-body">
        <h3 class="mb-5">Importar Datos CSV desde el Modelo-Controlador
        </h3>

        <div class="text-center">
          {{ Form::open(['route'=>'admin.importView.dataUser', 'method'=>'POST', 'files'=>'true']) }}
            @csrf

            <div class="form-group">
              <input type="file" name="csvFile">
              {!! $errors->first('csvFile', '<div class="text-danger">:message</div>') !!}

              <button type="submit" value="Importar" class="btn btn-info btn-sm">
                Subir archivo
              </button>
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
@endsection