@extends('master')

@section('title', 'Importar Datos')

@section('content')
  <div class="card mb-4 wow fadeIn">
    <div class="card-body d-sm-flex justify-content-between">
      <h4 class="mb-2 mb-sm-0 pt-1">
        <a href="{{ route('panel') }}">Dashboard</a>
        <span>/</span>
        <span>Importar Productos y Categorías</span>
      </h4>
    </div>
  </div>
  
  <div class="col-md-12 mb-4">
    <div class="card">
      <div class="card-body text-center">
        <h3>Importar Archivos CSV de Tablas Relacionadas</h3>
        <h5 class="mb-5">
          Guía: <a href="https://www.youtube.com/watch?v=xEpNTPJ2dOc&list=PLzSFZWTjelbIi1UJ3WZZK8vVzgmhjAq25&index=19">
            Importar desde Excel a varias tablas de una BD - Practicando PHP y Laravel - Programación y más
          </a>
        </h5>

        <div>
          <form method="POST" action="{{ route('import.relatedTables.productsCsv') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <input type="file" name="csvFile" data-toggle="tooltip" 
                title="Ejemplo: public/dataImport/.csv" />
              {!! $errors->first('csvFile', '<div class="text-danger">:message</div>') !!}
            
            <button type="submit" class="btn btn-success" name="submit">
              <i class="fa fa-check"></i>  Importar Productos y Categorías
            </button>
          </form>
        </div>
        
        @if (! $products->isEmpty())
          <div class="table-responsive-sm">
            @include('admin.products._table', $products)
          </div>
        @else
          <h4 class="mt-3">No hay registros creados</h4>
        @endif
      </div>
    </div>
  </div>
@endsection