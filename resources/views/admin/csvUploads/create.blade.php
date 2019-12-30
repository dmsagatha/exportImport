@extends('master')

@section('content')
  <div class="w-full max-w-sm mx-auto overflow-hidden">
    @if(session()->has('error'))
      <div class="text-center bg-red rounded text-white max-w-sm mx-auto p-4 mb-8">
        {{ session()->get('error') }}
      </div>
    @endif

    <form action="{{ route('admin.csvUploads.store') }}" method="POST"
      class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
      @csrf
      {{ method_field('POST') }}

      <h3 class="pb-4 mt-0 font-bold">Subir CSV</h3>
      <div class="mb-4">
        <input type="file" name="csvFile" id="csvFile">
      </div>
      <div class="mb-4">
        <input id="hasHeaders" name="hasHeaders" type="checkbox">
        <label for="hasHeaders">Archivo contiene fila de encabezado?</label>
      </div>
      <div class="mt-4">
        <button class="btn btn-amber" type="submit">Subir datos</button>
      </div>
    </form>
  </div>
@endsection