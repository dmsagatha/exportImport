@extends('master')

@section('title', 'Productos|Categorias')

@section('content')
  <div class="card mb-4 wow fadeIn">
    <div class="card-body d-sm-flex justify-content-between">
      <h4 class="mb-2 mb-sm-0 pt-1">
        <a href="{{ route('panel') }}">Dashboard</a>
        <span>/</span>
        <span>Importar Productos y Categorias</span>
      </h4>
    </div>
  </div>

  <div class="row wow fadeIn">
    <div class="col-md-12 mb-4">
      <div class="card">
        <div class="card-body">
          <h2 class="text-center mb-2">
            Importar Tablas Relacionadas con Laravel Excel
          </h2>
          <h4 class="text-center mb-2">Crear / Actualizar Productos</h4>

          <p class="text-muted">
            Con encabezados - (CE)
          </p>

          <div class="text-sm-left mb-3" align="right">
            <form action="{{ route('admin.importsExcel.importProductsCategories') }}"
              method="POST" enctype="multipart/form-data">
              @csrf

              <input type="file" name="productsCategories" />
              <button class="btn btn-primary" data-toggle="tooltip" 
                title="Ejemplo: public/dataImport/Excel-Products-CategoriesImport.csv">
                Importar Productos con Validaciones - (CE)
              </button>
            </form>
          </div>
          
          @if (! $products->isEmpty())
            <div class="table-responsive-sm">
              @include('admin.importsExcel._table', $products)
            </div>
          @else
            <h4>No hay registros creados</h4>
          @endif
          
        </div>
      </div>
    </div>
  </div>
@endsection