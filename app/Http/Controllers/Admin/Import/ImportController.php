<?php

namespace App\Http\Controllers\Admin\Import;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ImportData;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreCsvUploadRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImportController extends Controller
{
  public function viewUsers()
  {
    $users = User::all();

    return view('admin.importsCsv.users', compact('users'));
  }
  
  public function importUsers(StoreCsvUploadRequest $request)
  {
    // Convertir un string con formato CSV a un array y llamar los elementos
    // de la colección
    $arrays = collect(array_map('str_getcsv', file($request->file('csvFile')->getRealPath())));
    
    // Obtener los encabezados
    $headerRow = $arrays->shift();

    foreach ($arrays as $array)
    {
      $array = array_combine($headerRow, $array);

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

  public function viewCategories()
  {
    $categories = Category::all();

    return view('admin.importsCsv.categories', compact('categories'));
  }

  public function importCategories()
  {
    // Validación del archivo
    request()->validate([
      'csvFile' => 'required|mimes:csv,txt'
    ]);

    // Ruta al archivo
    $path = request()->file('csvFile')->getRealPath();

    // file() - Devuelve un arreglo con cada una de las filas
    $file = file($path);

    // array_slice — Extraer una parte de un array o eliminar la primera línea (Encabezados)
    //$headerRow = array_slice($file, 1);

    // Leer los datos Csv de una matriz
    $data = array_map('str_getcsv', $file);

    // Quitar un elemento del inicio del array (Encabezados de las columnas)
    array_shift($data);
    
    // Imprmir el listado Clave-Valores
    // array_walk - Aplicar una función proporcionada por el usuario a cada fila del array
    // array_combine — Crea un nuevo array, usando una matriz 
    // para las claves y otra para sus valores
    /* array_walk($data, function(&$headerRow) use($data) {
      $headerRow = array_combine($data[0], $headerRow);
    });
    array_shift($data);
    return $data; */

    // Recorrer los datos
    foreach($data as $row) {
      // array_shift — Quitar la fila de los encabezados

      // Si el campo único no existe, crear el registro, de lo contrario actualizarlo
      Category::updateOrCreate([
          'name' => $row[0],
        ],
        [
          'name' => $row[0],
          'url'  => $row[1],
        ]
      );
    }

    return redirect()->route('import.categories')
                    ->with('success', 'Importado satisfactoriamente!.');
  }

  public function getCategoryId($categoryName, $categoryUrl)
  {
    // Buscar la primera coincidencia
    $category = Category::where('name', $categoryName)->first();

    // Si existe la Categoría, obtener el id, de lo contrario crear el registro
    if ($category) {
      return $category->id;
    }
    
    // Crear las Categorías
    $category = new Category();
    $category->name = $categoryName;
    $category->url  = $categoryUrl;
    $category->save();

    return $category->id;
  }
  
  // Importar archivos grandes
  // https://daveismyname.blog/laravel-import-large-csv-file
  public function importViewCategories()
  {
    $categories = Category::all();

    // Establecer una matriz vacía
    $records = [];

    // Ruta donde se almacenan los archivos Csv
    $path = base_path('public/dataImport/pendingCategories');

    // Recorrer cada archivo
    foreach (glob($path.'/*.csv') as $file) {
      // Abrir el archivo y agregar el número total de líneas a la matriz de registros
      $file = new \SplFileObject($file, 'r');
      $file->seek(PHP_INT_MAX);
      $records[] = $file->key();
    }

    // Suma todas las teclas de matriz para obtener el total
    $toImport = array_sum($records);

    return view('admin.importsData.importCategories', compact('toImport', 'categories'));
  }

  public function importLarge()
  {
    request()->validate([
      'file' => 'required|mimes:csv,txt'
    ]);

    // Ruta al archivo
    $path = request()->file('file')->getRealPath();

    // file() - Devuelve un arreglo con cada una de las filas
    $file = file($path);

    // array_slice — Extraer una parte de un array
    // Eliminar la primera línea (Encabezados)
    $data = array_slice($file, 1);

    // array_chunk — Divide un array en fragmentos
    // Recorrer el archivo y dividir cada uno en 1000 líneas
    $parts = (array_chunk($data, 1000));

    $i = 1;

    foreach($parts as $line) {
      $filename = base_path('public/dataImport/pendingCategories/'.date('y-m-d-H-i-s').$i.'.csv');

      // file_put_contents — Escribir datos en un fichero
      file_put_contents($filename, $line);

      $i++;
    }

    session()->flash('status', 'En cola para importar.');

    return redirect('admin/importView/categories');
  }
}