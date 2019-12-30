<?php

namespace App\Http\Controllers\Admin;

use App\Models\CsvUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CsvUploadController extends Controller
{
  public function index()
  {
    return view('admin.csvUploads.index')->with([
      'csvUploads' => CsvUpload::latest()->get()
    ]);
  }
  
  public function create()
  {
    return view('admin.csvUploads.create');
  }
  
  public function store(Request $request)
  {
    // Extraer las filas del archivo cargado
    $data = collect(array_map('str_getcsv', file($request->file('csvFile')->getRealPath())));

    // Una vez se tiene una matriz de datos, verificar si el usuario ha especificado
    // que el archivo ha proporcionado una fila de encabezado
    // Si es así, usar un método de Colección para aplicar la fila del encabezado
    // a cada una de las claves en las filas
    if ($request->has('hasHeaders')) {
        $headerRow = $data->shift();

        $data->transform(function ($row) use ($headerRow) {
            return collect($row)->mapWithKeys(function ($value, $index) use ($headerRow) {
                return [$headerRow[$index] => $value];
            })->toArray();
        });
    }

    // Verificar si fue capaz de extraer filas válidas del CSV
    // Si es así, crear un nuevo registro CsvUpload con los datos procesados
    // Si no encuentra ninguna fila, devolver una redirección con un estado de error
    if ($data->count() >= 1) {
        $csvUpload = CsvUpload::create([
            'original_filename' => $request->file('csvFile')->getClientOriginalName(),
            'has_headers'       => $request->has('hasHeaders'),
            'file_contents'     => $data
        ]);

        // Redirigir al usuario a una vista que le permita especificar qué columnas
        // deben asignarse a qué valor dentro de la estructura de datos de la aplicación
        return redirect(route('admin.csvUploads.map-columns.show', $csvUpload->getKey()));
    } else {
        return back()->withError('No se pudo localizar ninguna fila elegible. Revise el documento e intente nuevamente.');
    }
  }
  
  public function show(CsvUpload $csvUpload)
  {
    return view('admin.csvUploads.show')->with([
        'csvUpload' => $csvUpload->load('rows.logs')
    ]);
  }
  
  public function edit(CsvUpload $csvUpload)
  {
  }
  
  public function update(Request $request, CsvUpload $csvUpload)
  {
  }
  
  public function destroy(CsvUpload $csvUpload)
  {
  }
}