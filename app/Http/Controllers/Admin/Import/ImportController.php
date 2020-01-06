<?php

namespace App\Http\Controllers\Admin\Import;

use App\Models\User;
use App\Models\ImportData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreCsvUploadRequest;
use App\Models\Category;
use App\Models\Product;

class ImportController extends Controller
{
  public function importView()
  {
    $users = User::all();

    return view('admin.importsData.view', compact('users'));
  }
  
  public function importDataUser(StoreCsvUploadRequest $request)
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

  public function importProducts()
  {
    // Leer el archivo
    $path = public_path('dataImport/Csv-Products-CategoriesImport.csv');

    // file_get_contents - Convierte un fichero completo a una cadena
    //return file_get_contents($path);    // Ver el resultado
    // utf8_decode - Convierte una cadena con los caracteres codificados ISO-8859-1 con 
    // UTF-8 a un sencillo byte ISO-8859-1 (Acentos)
    //$content = utf8_decode(file_get_contents($path));

    // Convertir el string con formato CSV a un array
    //return str_getcsv($content);

    // file() - Devuelve un arreglo con cada una de las filas
    // array_map - Aplica la retrollamada a los elementos de los arrays dados
    $lines = file($path);
    $utf8_lines = array_map('utf8_decode', $lines);
    $array = array_map('str_getcsv', $utf8_lines);  // return

    // Imprmir el listado Clave-Valores
    // array_walk - Aplicar una función proporcionada por el usuario a cada fila del array
    // array_combine — Crea un nuevo array, usando una matriz 
    // para las claves y otra para sus valores
    // array_shift — Quita un elemento del inicio del array (Encabezados de las columnas)
    /* array_walk($array, function(&$headerRow) use($array) {
      $headerRow = array_combine($array[0], $headerRow);
    });

    array_shift($array);
    return $array; */

    // Recorrer el archivo hasta su tamaño, ignorando la primera fila, los encabezados
    for ($i=1; $i<sizeof($array); $i++) {
      // Crear los Productos
      $product = new Product();
      $product->title = $array[$i][2];
      $product->url   = $array[$i][3];
      $product->description = $array[$i][4];
      $product->category_id = $this->getCategoryId($array[$i][0], $array[$i][1]);
      $product->save();

      /* Product::updateOrCreate(
        ['url'   => $array[$i][3]],
        [
        'title' => $array[$i][2],
        'url'   => $array[$i][3],
        'description' => $array[$i][4],
        'category_id' => $this->getCategoryId($array[$i][0], $array[$i][1]),
      ]);

      dd('Registros creados satisfactoriamente.!'); */

      /* return new Product([
        'title' => $array[$i][2],
        'url'   => $array[$i][3],
        'description' => $array[$i][4],
        'category_id' => $this->getCategoryId($array[$i][0], $array[$i][1]),
      ]); */
    };
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
}