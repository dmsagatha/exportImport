@extends('master')

@section('title', 'Importar Datos')

@section('content')
  <div class="card mb-4 wow fadeIn">
    <div class="card-body d-sm-flex justify-content-between">
      <h4 class="mb-2 mb-sm-0 pt-1">
        <a href="{{ route('panel') }}">Dashboard</a>
        <span>/</span>
        <span>Importar Datos</span>
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

        @if($csvUploads->count())
          <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-hover user_table" id="dtBasic">
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