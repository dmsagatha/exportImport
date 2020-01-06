<?php

namespace App\Http\Controllers\Admin\Import;

use App\Models\ImportData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreCsvUploadRequest;

class ImportController extends Controller
{
  public function importView()
  {
    return view('admin.importsData.view');
  }
  
  public function importDataUser(StoreCsvUploadRequest $request)
  {
    // Convertir un string con formato CSV a un array y llamar los elementos
    // de la colección
    $arrays = collect(array_map('str_getcsv', file($request->file('csvFile')->getRealPath())));
    
    // Obtener los encabezados
    $header = $arrays->shift();

    foreach ($arrays as $array)
    {
      $array = array_combine($header, $array);

      $insertData = [
        'username'  => $array['username'],
        'name' 	    => $array['name'],
        'email'     => $array['email'],
        'password'  => Hash::make($array['password']),
      ];

      ImportData::insertDataUsers($insertData);
    }

    alert()->success('La información se importó exitosamente.');

    return redirect()->back();
  }
}