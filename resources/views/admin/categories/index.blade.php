@extends('master')

@section('title', 'Categories')

@section('content')
  <div class="card mb-4 wow fadeIn">
    <div class="card-body d-sm-flex justify-content-between">
      <h4 class="mb-2 mb-sm-0 pt-1">
        <a href="{{ route('panel') }}">Dashboard</a>
        <span>/</span>
        <span>Importar Categorías - Con Trait</span>
      </h4>
    </div>
  </div>
  
  <div class="col-md-12 mb-4">
    <div class="card">
      <div class="card-body">
        <h2 class="text-center mb-2">
          Importar / Exportar con Validaciones usando Traits
        </h2>
        
        <button class="btn btn-warning" 
          data-toggle="modal" 
          data-target="#csvImportModal" 
          title="Ejemplo: public/dataImport/Trait-categoriesImportCsv-CE.csv o Trait-categoriesImportCsv-CE-Update.csv">
          Importar CSV
        </button>
        @include('csvImport.modal', [
          'model' => 'Category', 
          'route' => 'admin.categories.parseCsvImport']
        )
        
        @if (! $categories->isEmpty())
          <div class="table-responsive-sm text-nowrap">
            @include('admin.categories._table', $categories)
          </div>
        @else
          <h4>No hay registros creados</h4>
        @endif
      </div>
    </div>
  </div>
@endsection