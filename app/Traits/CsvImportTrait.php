<?php

namespace App\Traits;

//use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SpreadsheetReader;
use Illuminate\Http\Request;

trait CsvImportTrait
{
  public function processCsvImport(Request $request)
  {
    try {
      $filename = $request->input('filename', false);
      $path     = storage_path('app/csv_import/' . $filename);

      $hasHeader = $request->input('hasHeader', false);

      $fields = $request->input('fields', false);
      $fields = array_flip(array_filter($fields));

      $modelName = $request->input('modelName', false);
      $model     = "App\Models\\" . $modelName;

      $reader = new SpreadsheetReader($path);
      $insert = [];

      foreach ($reader as $key => $row) {
        if ($hasHeader && $key == 0) {
          continue;
        }

        $tmp = [];

        foreach ($fields as $header => $k) {
          $tmp[$header] = $row[$k];
        }

        $insert[] = $tmp;
      }

      $routeName = 'admin.' . strtolower(Str::plural(Str::kebab($modelName))) . '.index';

      // Validaciones - Opción 1
      /* $messages = ['email.unique' => 'El correo electrónico :input ya esta en uso'];
      foreach ($insert as $insertItem) {
        $validator = Validator::make($insertItem, (new StoreUserRequest())->rules(), $messages);

        if ($validator->fails()) {
          dd($validator->errors());
        }
      } */

      // Validaciones - Opción 2
      /* $rules = [
        '*.username' => [
            'required',
            'unique:users',
        ],
        '*.name'     => [
            'required',
        ],
        '*.email'    => [
            'required',
            'unique:users',
        ],
        '*.password' => [
            'required',
        ],
      ];
      $messages = ['*.email.unique' => 'El correo electrónico :input ya esta en uso'];
      $validator = Validator::make($insert, $rules, $messages);
      
      if ($validator->fails()) {
        return redirect()->route($routeName)->withErrors($validator);
      } */
      
      // Validaciones - Opción 3
      $modelRules = "App\Http\Requests\\" . "Store".$modelName."Request";
      $messages = ['*.unique' => 'El campo :input ya esta en uso'];
      
      foreach ($insert as $insertItem) {
        $validator = Validator::make($insertItem, (new $modelRules())->rules(), $messages);

        if ($validator->fails()) {
          return redirect()->route($routeName)->withErrors($validator);
        }
      }

      $for_insert = array_chunk($insert, 100);

      foreach ($for_insert as $insert_item) {
        $model::insert($insert_item);
      }

      $rows  = count($insert);
      $table = Str::plural($modelName);

      File::delete($path);

      session()->flash('message', trans('validation.app_imported_rows_to_table', ['rows' => $rows, 'table' => $table]));

      return redirect($request->input("redirect"));
    } catch (\Exception $ex) {
      throw $ex;
    }
  }

  public function parseCsvImport(Request $request)
  {
    $file = $request->file('csv_file');
    $request->validate([
      'csv_file' => 'mimes:csv,txt',
    ]);

    $path      = $file->path();
    $hasHeader = $request->input('header', false) ? true : false;

    $reader  = new SpreadsheetReader($path);
    $headers = $reader->current();
    $lines   = [];
    $lines[] = $reader->next();
    $lines[] = $reader->next();

    $filename = Str::random(10) . '.csv';
    $file->storeAs('csv_import', $filename);

    $modelName     = $request->input('model', false);
    $fullModelName = "App\Models\\" . $modelName;

    $model     = new $fullModelName();
    $fillables = $model->getFillable();

    $redirect = url()->previous();

    $routeName = 'admin.' . strtolower(Str::plural(Str::kebab($modelName))) . '.processCsvImport';

    return view('csvImport.parseInput', compact('headers', 'filename', 'fillables', 'hasHeader', 'modelName', 'lines', 'redirect', 'routeName'));
  }
}