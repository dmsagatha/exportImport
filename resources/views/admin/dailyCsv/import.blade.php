@extends('master')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Importar CSV</div>

          <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('import.import_parse') }}" enctype="multipart/form-data">
              @csrf

              <div class="form-group">
                <label for="csv_file" class="col-md-4 control-label">Importar Archivo CSV</label>

                <div class="col-md-10">
                  <input id="csv_file" type="file" class="form-control" name="csv_file" />
                  {!! $errors->first('csv_file', '<div class="text-danger">:message</div>') !!}
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-12 col-md-offset-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="header" checked> El archivo contiene una fila de encabezado?
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    Parse CSV
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