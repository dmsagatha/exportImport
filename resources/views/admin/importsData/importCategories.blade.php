@extends('master')

@section('title', 'Importar Datos')

@section('content')
  <div class="card mb-4 wow fadeIn">
    <div class="card-body d-sm-flex justify-content-between">
      <h4 class="mb-2 mb-sm-0 pt-1">
        <a href="{{ route('panel') }}">Dashboard</a>
        <span>/</span>
        <span>Importar Categorías</span>
      </h4>
    </div>
  </div>
  
  <div class="col-md-12 mb-4">
    <div class="card">
      <div class="card-body text-center">
        <h3>
          Importar Archivos CSV Grandes
        </h3>
        <h5 class="mb-5">
          Guía: <a href="https://daveismyname.blog/laravel-import-large-csv-file">
            Laravel import large CSV file
          </a>
        </h5>

        <div>
          <p>{{ session('status') }}</p>

          <form method="POST" action="{{ route('admin.importView.importLarge') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
              <input id="file" type="file" name="file" required>
              {!! $errors->first('file', '<div class="text-danger">:message</div>') !!}
            
            <button type="submit" class="btn btn-success" name="submit">
              <i class="fa fa-check"></i>  Importar Categorías
            </button>
          </form>
        </div>

        @if ($toImport > 0)
          <p>Categorías pendientes por importar: {{ $toImport }}</p>
        @endif
        
        @if (! $categories->isEmpty())
          <div class="table-responsive-sm text-nowrap">
            @include('admin.categories._table', $categories)
          </div>
        @else
          <h4 class="mt-3">No hay registros creados</h4>
        @endif
      </div>
    </div>
  </div>
@endsection