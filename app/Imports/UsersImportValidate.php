<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\Importable;

class UsersImportValidate implements ToModel, WithHeadingRow  //, WithValidation, SkipsOnError
{
  use Importable;
  
  /**
  * @param array $row
  * @return \Illuminate\Database\Eloquent\Model|null
  */
  public function model(array $row)
  {
    // Si el campo único username existe, se actualizará el registro,
    // de lo contrario lo crea
    if (!empty($row)) {
      User::updateOrCreate(
        ['username' => $row['username']],
        [
          'username' => $row['username'],
          'name' => $row['name'],
          'email' => $row['email'],
          'password' => Hash::make($row['password']),
      ]);
    }
  }

  /**
￼   * Validación de cada dato
￼   */
  public function rules(): array
  {
    return [
      'username' => 'required|unique:users',
      'name'     => 'required|string|max:255',
      'email'    => 'required|string|email|max:255|unique:users',
      'password' => 'required|min:3',
    ];
  }

  /**
   * @param \Throwable $e
   */
  public function onError(\Throwable $e)
  {
    // Manejo de excepciones
    \Log::error($e->getMessage());
    
    return back();
  }
}