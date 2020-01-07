<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class ImportCategories extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'import:categories';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Importar el archivo Csv de las categorias almacenadas.';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    // Establecer la ruta para los archivos Csv
    $path = base_path('public/dataImport/pendingCategories/*.csv');

    // Ejecutar 2 bucles a la vez
    foreach (array_slice(glob($path),0,2) as $file) {
      // Leer los datos Csv de una matriz
      $data = array_map('str_getcsv', file($file));

      // Recorrer los datos
      foreach($data as $row) {
        // Inserte el registro o actualizar si la Url ya existe
        Category::updateOrCreate([
            'name' => $row[0],
          ],
          [
            'name' => $row[0],
            'url'  => $row[1],
          ]
        );
      }

      // Eliminar el archivo
      unlink($file);
    }
  }
}