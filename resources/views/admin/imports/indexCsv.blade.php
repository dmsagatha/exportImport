@extends('master')

@section('title', 'Usuarios')

@section('content')
  <div class="card mb-4 wow fadeIn">
    <div class="card-body d-sm-flex justify-content-between">
      <h4 class="mb-2 mb-sm-0 pt-1">
        <a href="{{ route('panel') }}">Dashboard</a>
        <span>/</span>
        <span>Importar Usuarios - CSV</span>
      </h4>
    </div>
  </div>

  <div class="row wow fadeIn">
    <div class="col-md-12 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="text-sm-left mb-3" align="right">
            <form action="{{ route('admin.importCsv.parseImport') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
              @csrf

              <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                <label for="csv_file" class="col-md-4 control-label">
                  Importar Arhivo CSV
                </label>

                <div class="col-md-6">
                  <input id="csv_file" type="file" class="form-control" name="csv_file" required>

                  @if ($errors->has('csv_file'))
                    <span class="help-block">
                    <strong>{{ $errors->first('csv_file') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="header" checked>
                      El archivo contiene una fila de encabezado?
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    Analizar CSV
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection