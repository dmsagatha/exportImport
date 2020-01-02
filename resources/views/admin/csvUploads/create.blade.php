@extends('master')

@section('title', 'Importar CSV')

@section('content')
  <div class="card mb-4 wow fadeIn">
    <div class="card-body d-sm-flex justify-content-between">
      <h4 class="mb-2 mb-sm-0 pt-1">
        <a href="{{ route('panel') }}">Dashboard</a>
        <span>/</span>
        <span>Importar Datos CSV</span>
      </h4>
    </div>
  </div>
  
  <div class="col-md-12 mb-4">
    <div class="card">
      <div class="card-body">
        <h3 class="mb-5">Subir CSV</h3>

        <form action="{{ route('admin.csvUploads.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          {{ method_field('POST') }}
          
          <div class="mb-4">
            <input type="file" name="csvFile" id="csvFile">
          </div>
          <div class="mb-4">
            <input id="hasHeaders" name="hasHeaders" type="checkbox">
            <label for="hasHeaders">El archivo contiene fila de encabezados?</label>
          </div>
          <div class="mt-4">
            <button class="btn btn-amber" type="submit">Subir datos</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection