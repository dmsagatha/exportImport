@extends('master')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Importar CSV</div>

          <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('import.import_process') }}">
              @csrf
              {{-- Archivo a procesar --}}
              <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />
            
              <table class="table">
                @foreach ($csv_data as $row)
                  <tr>
                    @foreach ($row as $key => $value)
                      <td>{{ $value }}</td>
                    @endforeach
                  </tr>
                @endforeach
                <tr>
                  @foreach ($csv_data[0] as $key => $value)
                    <td>
                      <select name="fields[{{ $key }}]">
                        @foreach (config('app.db_fields') as $db_field)
                          <option value="{{ $loop->index }}">{{ $db_field }}</option>
                        @endforeach
                      </select>
                    </td>
                  @endforeach
                </tr>
              </table>
            
              <button type="submit" class="btn btn-primary">Datos de importacion</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection