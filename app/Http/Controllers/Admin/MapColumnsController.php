<?php

namespace App\Http\Controllers\Admin;

use App\Models\CsvUpload;
use App\Http\Requests\StoreCsvUploadColumnMappingRequest;
use App\Jobs\DistributeCsvUploadContentIntoCsvRows;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapColumnsController extends Controller
{
  // Muestra algunas filas de muestra para seleccionar a cual columna representa
  // dentro de la estructura de datos de la aplicación
  public function show(CsvUpload $csvUpload)
  {
    return view('admin.csvUploads.map-columns', compact('csvUpload'));
  }

  /**
   * Una vez definidas las columnas CSV deben correlacionarse con los valores
   * de la aplicación, enviar las publicaciones del formulario
   */
  public function store(CsvUpload $csvUpload, StoreCsvUploadColumnMappingRequest $request)
  {
    // La asignación de columnas se actualiza en CSVUpload, 
    // se envía un nuevo trabajo 
    // y el usuario se redirige al índice de importación CSV
    $csvUpload->update([
        'column_mapping' => $request->fields,
    ]);

    // Distribución de datos CSV en filas individuales (CsvRow)
    $this->dispatch(new DistributeCsvUploadContentIntoCsvRows($csvUpload));

    return redirect(route('admin.csvUploads.index'));
  }
}