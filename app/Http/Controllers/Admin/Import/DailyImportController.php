<?php

namespace App\Http\Controllers\Admin\Import;

use App\Models\User;
use App\Models\CsvData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CsvImportRequest;

class DailyImportController extends Controller
{
  public function getImport()
  {
    return view('admin.dailyCsv.import');
  }

  public function parseImport(CsvImportRequest $request)
  {
    // Obtener el archivo CSV
    $path = $request->file('csv_file')->getRealPath();

    // Analizar el archivo sin encabezados
    // Devolver un array de datos Csv
    $data = array_map('str_getcsv', file($path));

    // Almacenar temporalmente los datos completos en la tabla csv_data
    $csv_data_file = CsvData::create([
      'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
      'csv_header'   => $request->has('header'),
      'csv_data'     => json_encode($data)
    ]);

    // Representar los datos como una tabla (2 primeras líneas)
    // y el usuario selecciona los campos
    $csv_data = array_slice($data, 0, 2);   // Sin encabezado
    
    return view('admin.dailyCsv.import_fields', compact('csv_data_file', 'csv_data'));
  }

  /**
   * Almacenar los datos en la DB
   * Hacer coincidir los valores desplegables en la vista
   * con los valores de columna reales
   */
  public function processImport(Request $request)
  {
    $data = CsvData::find($request->csv_data_file_id);

    // Decodificar un string de JSON - Obtener los datos de la BD
    $csv_data = json_decode($data->csv_data, true);

    // Recorrer los datos
    foreach ($csv_data as $row) {
        $user = new User();

        foreach (config('app.db_fields') as $index => $field) {
          // Asignar un valor a la propiedad, de acuerdo con el valor
          // desplegado de los campos de la tabla
          $user->$field = $row[$request->fields[$index]];
        }

        $user->save();
    }

    return redirect()->route('import.import')
                     ->with('success', 'Importado satisfactoriamente!.');
  }
}