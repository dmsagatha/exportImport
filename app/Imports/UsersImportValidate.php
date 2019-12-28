<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImportValidate implements ToModel, WithHeadingRow, WithValidation
{
  /**
  * @param array $row
  *
  * @return \Illuminate\Database\Eloquent\Model|null
  */
  public function model(array $row)
  {
    $user = new User;

    $user->username = $row['username'];
    $user->name     = $row['name'];
    $user->email    = $row['email'];
    $user->password = Hash::make($row['password']);
    $user->save();

    /* return new User([
        //
    ]); */
  }

  public function rules(): array
  {
    return [
      'username' => 'required|unique:users',
      'name'     => 'required|string|max:255',
      'email'    => 'required|string|email|max:255|unique:users',
      'password' => 'required|min:3',
    ];
  }
}