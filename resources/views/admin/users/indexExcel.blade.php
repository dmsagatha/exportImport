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
          <p class="text-muted">
            Sin encabezados - (SE) <br>
            Con encabezados - (CE)
          </p>
          <div class="text-sm-left mb-3" align="right">
            <a href="{{ route('admin.usersExcel.export') }}" class="btn btn-info" data-toggle="tooltip" title="Exportar toda la info sin encabezados">
              Exportar Usuarios - (SI)
            </a>
            <a href="{{ route('admin.usersExcel.export_view') }}" class="btn btn-amber" data-toggle="tooltip" title="Exportar la vista de la tabla con encabezados">
              Exportar Usuarios - (CE)
            </a>
            <a href="{{ route('admin.usersExcel.export_styling') }}" class="btn btn-deep-orange"data-toggle="tooltip" title="Exportar Colección con encabezados, estilos y ajuste de columnas">
              Exportar Usuarios con Estilos
            </a>
          </div>
          <hr>

          <div class="text-sm-left mb-3" align="right">
            <form action="{{ route('admin.usersExcel.import') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <input type="file" name="usersImportSE" />
              <button class="btn btn-blue-grey" data-toggle="tooltip" title="Ejemplo: public/dataImport/Excel-usersImport-SE.xlsx">
                Importar Usuarios - (SE)
              </button>
            </form>
          </div>
          
          <div class="text-sm-left mb-3" align="right">
            <form action="{{ route('admin.usersExcel.import_validate') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <input type="file" name="usersImportCE" />
              <button class="btn btn-primary" data-toggle="tooltip" title="Ejemplo: public/dataImport/Excel-usersImport-CE-Update.csv">
                Importar Usuarios con Validaciones - (CE)
              </button>
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