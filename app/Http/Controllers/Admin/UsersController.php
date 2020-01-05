<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Traits\CsvImportTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
  use CsvImportTrait;
  
  public static function index()
  {
    $users = User::all();

    return view('admin.users.index', compact('users'));
  }
  
  public function show(User $user)
	{
  }
  
  public function create()
	{
  }
  
  public function store(Request $request)
	{
  }

  public function edit(User $user)
  {
  }

  private function rules(){
      return [
        'username' => 'required',
        'name'     => 'required',
        'email'    => 'required',
      ];
  }

  public function update(Request $request, User $user)
  {
  }
  
  public function destroy(User $user)
	{
  }
}