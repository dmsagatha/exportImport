<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Comprobar si el campo único ya existe en la tabla,
 * Si no existe, pasar el método $data en create() para crearlo
 */
class ImportData extends Model
{
  public static function insertDataUsers($data)
  {
    $value = User::where('username', '=', $data['username'])->first();
    
    if ($value === null) {
      $value = User::create($data);
    }

    return $value->id;
  }
}