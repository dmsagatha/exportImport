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
          <div class="text-sm-left mb-3" align="right">
            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" 
              action="{{ route('admin.importsExcel.importProductsCategories') }}" 
              class="form-horizontal" method="POST" enctype="multipart/form-data">
              @csrf

              <input type="file" name="productsCategories" style="width:25%;" />
              <button class="btn btn-primary" data-toggle="tooltip" title="Ejemplo: public/dataImport/Excel-Products-CategoriesImport.csv">
                Importar Productos - (CE)
              </button>
            </form>
          </div>
          
          @if (! $products->isEmpty())
            <div class="table-responsive-sm text-nowrap">
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