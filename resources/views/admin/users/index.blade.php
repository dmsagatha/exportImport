@extends('master')

@section('title', 'Usuarios')

@section('content')
  <div class="card mb-4 wow fadeIn">
    <div class="card-body d-sm-flex justify-content-between">
      <h4 class="mb-2 mb-sm-0 pt-1">
        <a href="{{ route('panel') }}">Dashboard</a>
        <span>/</span>
        <span>Exportar-Importar - Con Trait</span>
      </h4>
    </div>
  </div>
  
  <div class="col-md-12 mb-4">
    <div class="card">
      <div class="card-body">
        <button class="btn btn-warning" 
          data-toggle="modal" 
          data-target="#csvImportModal" 
          title="Ejemplo: public/dataImport/Traits-usersImportCsv-CE.csv o Traits-usersImportCsv-CE-Update.csv">
          Importar CSV
        </button>
        @include('csvImport.modal', [
          'model' => 'User', 
          'route' => 'admin.users.parseCsvImport']
        )
        
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
@endsection