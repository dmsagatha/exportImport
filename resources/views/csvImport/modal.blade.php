<div class="modal fade" id="csvImportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Importar CSV</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class='row'>
          <div class='col-md-12'>
            <form class="form-horizontal" method="POST" action="{{ route($route, ['model' => $model]) }}" enctype="multipart/form-data">
              @csrf
              
              <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                <label for="csv_file" class="control-label">Archivo CSV a importar</label>

                <div class="col-md-12">
                  <input id="csv_file" type="file" class="form-control-file" name="csv_file" 
                    data-toggle="tooltip" 
                    title="Ejemplo: public/dataImport/ARCHIVO.csv o ARCHIVO-Update.csv" required />

                  @if($errors->has('csv_file'))
                    <span class="help-block">
                      <strong>{{ $errors->first('csv_file') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-12 col-md-6 col-md-offset-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="header" checked>
                      Archivo contiene fila de encabezado?
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">Procesar CSV</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>