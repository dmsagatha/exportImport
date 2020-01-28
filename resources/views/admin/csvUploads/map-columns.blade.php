@extends('master')

@section('title', 'Mapeo de los Campos')

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
        <h3 class="mb-5">Mapeo de los Campos</h3>

        <form class="form-horizontal" method="POST" 
          action="{{ route('admin.csvUploads.map-columns.store', $csvUpload->getKey() )}}">
          @csrf

          <div class="table-responsive">
            <table id="dtBasic" class="table table-striped table-bordered" cellspacing="0" width="100%">
              @if ($csvUpload->has_headers)
                <tr>
                  @foreach ($csvUpload->headerRow as $headerField)
                    <th class="text-left p-2">{{ $headerField }}</th>
                  @endforeach
                </tr>
              @endif
              @foreach ($csvUpload->previewRows as $row)
                <tr>
                  @foreach ($row as $key => $value)
                    <td class="p-2 text-sm">{{ $value }}</td>
                  @endforeach
                </tr>
              @endforeach
              
              @if($csvUpload->additionalRowCount)
                <tr>
                  <td colspan="100" class="p-2">
                    <div class="rounded border border-grey-lighter bg-grey-lightest py-2 text-xs text-center ">
                      +{{ $csvUpload->additionalRowCount }} mas...
                    </div>
                  </td>
                </tr>
              @endif
              <tr>
                @foreach ($csvUpload->previewRows[0] as $key => $value)
                  <td class="p-2">
                    <div class="inline-block relative w-full">
                      <select name="fields[{{ $key }}]" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-4 py-2 pr-8 rounded shadow leading-tight">
                        @foreach ($csvUpload->availableFields as $availableField)
                          <option value="{{ $availableField }}" @if ($key === $availableField) selected @endif>{{ $availableField }}</option>
                        @endforeach
                      </select>
                      {{-- <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                      </div> --}}
                    </div>
                  </td>
                @endforeach
              </tr>
            </table>
          </div>

          <button type="submit" class="btn btn-dark-green">Importar los datos</button>
        </form>
      </div>
    </div>
  </div>
@endsection