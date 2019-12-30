@extends('master')

@section('title', 'Usuarios')

@section('content')
  <div class="card mb-4 wow fadeIn">
    <div class="card-body d-sm-flex justify-content-between">
      <h4 class="mb-2 mb-sm-0 pt-1">
        <a href="{{ route('panel') }}">Dashboard</a>
        <span>/</span>
        <span>Exportar-Importar Usuarios</span>
      </h4>
    </div>
  </div>

  <div class="row wow fadeIn">
    <div class="col-md-12 mb-4">
      <div class="card">
        <div class="card-body">
          <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
            Importar CSV
          </button>
          @include('csvImport.modal', [
            'model' => 'User', 
            'route' => 'admin.users.parseCsvImport']
          )
          

          <div class="text-sm-left mb-3" align="right">
            <form action="{{ route('admin.usersExcel.import_validate') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <input type="file" name="usersImportCE" />
              <button class="btn btn-primary">Importar Usuarios con Validaciones - (CE)</button>
            </form>
          </div>
          
          @if (! $users->isEmpty())
            <div class="table-responsive text-nowrap">
              @include('admin.users._table', $users)
            </div>
          @else
            <h4>No hay registros creados</h4>
          @endif
          
        </div>
      </div>
    </div>
  </div>
@endsection