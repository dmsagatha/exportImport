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
      <div class="card-body">
        <h3 class="mb-5">
          Guía de importaciones: <br>
          <a href="https://zaengle.com/blog/building-a-csv-importer-part-1" alt="Building a CSV Importer">
            Building a CSV Importer - 
          </a>
          <a href="https://github.com/zaengle/demo-csv-importer" alt="GitHub">
            Aplicación GitHub
          </a>
        </h3>

        <div class="container">
          <div class="row">
            <div class="col-md">
              <p class="font-weight-bold">Resumen</p>
              <ul>
                <li>Cargar, almacenar y mapear los datos CSV</li>
                <li>Procesar y distribuir las filas individuales según la aplicación</li>
                <li>Manejo de errores</li>
              </ul>
            </div>
            <div class="col-md">
              <p class="font-weight-bold">Procedimiento</p>
              <ul>
                <li>Subir un archivo CSV</li>
                <li>Crear un registro CsvUpload para contener todos los datos</li>
                <li>Definir el mapeo de columnas del Csv a la aplicación</li>
                <li>Dividir las filas en registros CsvRow individuales</li>
                <li>Revisar los detalles o logs de la importaciones</li>
                <li class="font-weight-bolder">Ejemplo: public/dataImport/Csv-Products-CategoriesImport.csv</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="text-center">
          <a class="btn btn-deep-orange" href="{{ route('admin.csvUploads.create') }}"
            data-toogle="tooltip" 
            title="Ejemplo: public/dataImport/Csv-Products-CategoriesImport.csv">
            Importar Datos CSV
          </a>
        </div>

        @if($csvUploads->count())
          <div class="table-responsive-sm text-nowrap">
            <table id="dtBasic" class="table table-bordered table-hover" cellspacing="0" width="100%">
              <thead class="black white-text">
                <tr class="align-middle text-center text-uppercase font-weight-bold">
                  <th class="p-2">Nombre del Archivo</th>
                  <th class="p-2">Total</th>
                  <th class="p-2">Todas las cargas</th>
                  <th class="p-2">Prevenido</th>
                  <th class="p-2">Ha fallado</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($csvUploads as $csvUpload)
                  <tr>
                    <td class="p-2 text-sm">{{ $csvUpload->original_filename }}</td>
                    <td class="p-2 text-sm text-center">{{ count($csvUpload->file_contents) }}</td>
                    <td class="p-2 text-sm text-center">{{ $csvUpload->importedRows->count() }}</td>
                    <td class="p-2 text-sm text-center">{{ $csvUpload->warnedRows->count() }}</td>
                    <td class="p-2 text-sm text-center">{{ $csvUpload->failedRows->count() }}</td>
                    <td class="p-2 text-sm text-center">
                      <a href="{{ route('admin.csvUploads.show', $csvUpload->getKey()) }}" class="text-blue">Detalles</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
          <h4>No hay registros importados</h4>
        @endif

        <div class="text-center">
          <a class="btn btn-deep-orange" href="{{ route('admin.csvUploads.create') }}">
            Importar Datos CSV
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection