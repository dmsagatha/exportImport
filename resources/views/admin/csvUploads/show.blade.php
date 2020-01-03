@extends('master')

@section('title', 'Mostrar Datos Importados')

@section('content')
  <div class="card mb-4 wow fadeIn">
    <div class="card-body d-sm-flex justify-content-between">
    <h4 class="mb-2 mb-sm-0 pt-1">
      <a href="{{ route('panel') }}">Dashboard</a>
      <span>/</span>
      <span>Mostrar los Logs de Importación</span>
    </h4>
    </div>
  </div>

  <div class="col-md-12 mb-4">
    <div class="card">
      <div class="card-body">
        <h3 class="mb-5">{{ $csvUpload->original_filename }}</h3>

        <div class="table-responsive text-nowrap">
          <table class="table table-bordered table-hover user_table" id="dtBasic">
            <thead class="black white-text">
              <tr class="text-center text-uppercase font-weight-bold">
                <th class="p-2">Estatus</th>
                <th class="p-2">Datos</th>
                <th class="p-2">Logs</th>
              </tr>
            </thead>
            @if($csvUpload->rows->count())
              <tbody>
                @foreach($csvUpload->rows as $row)
                  <tr>
                    <td class="p-2 text-sm">
                      @if($row->status == 'imported')
                        <span class="text-green">Importado</span>
                      @elseif($row->status == 'warned')
                        <span class="text-orange">Importado <span class="text-xs">(w/advertencia)</span></span>
                      @elseif($row->status == 'failed')
                        <span class="text-red">Ha fallado</span>
                      @endif
                    </td>
                    <td class="p-2 text-sm">
                      <pre class="text-xs bg-grey-lightest p-2 rounded"><code>{{ var_export($row->contents) }}</code>
                      </pre>
                    </td>
                    <td class="p-2 text-sm">
                      <ul class="list-reset">
                        @foreach($row->logs as $log)
                          @if($log->level == 'success')
                            <li class="text-success">{{ $log->message }}</li>
                          @elseif($log->level == 'info')
                            <li class="text-info">{{ $log->message }}</li>
                          @elseif($log->level == 'error')
                            <li class="text-danger">{{ $log->message }}</li>
                          @elseif($log->level == 'warn')
                            <li class="text-warning">{{ $log->message }}</li>
                          @else
                            <li>{{ $log->message }}</li>
                          @endif
                        @endforeach
                      </ul>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            @else
              <tbody>
                <tr>
                  <td class="p-2 text-sm">No hay resultados</td>
                </tr>
              </tbody>
            @endif
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection