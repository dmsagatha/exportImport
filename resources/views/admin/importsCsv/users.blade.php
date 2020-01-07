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
      <div class="card-body text-center">
        <h3>
          Importar Datos CSV con validación <br> desde el Modelo/Controlador
        </h3>
        <h5 class="mb-5">
          Guía: <a href="https://makitweb.com/import-csv-data-to-mysql-database-with-laravel/">
            Import CSV Data to MySQL Database with Laravel
          </a>
        </h5>

        <div>
          {{ Form::open(['route'=>'import.usersCsv', 'method'=>'POST', 'files'=>'true']) }}
            @csrf

            <div class="form-group">
              <input type="file" name="csvFile" data-toggle="tooltip" title="Ejemplo: public/dataImport/usersImport.csv o usersImport-Update.csv">
              {!! $errors->first('csvFile', '<div class="text-danger">:message</div>') !!}

              <button type="submit" value="Importar" class="btn btn-info btn-sm">
                Subir archivo
              </button>
            </div>
          {{ Form::close() }}
        </div>
        
        @if (! $users->isEmpty())
          <div class="table-responsive-sm text-nowrap">
            @include('admin.users._table', $users)
          </div>
        @else
          <h4 class="mt-3">No hay registros creados</h4>
        @endif
      </div>
    </div>
  </div>
@endsection