<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Excel;
use App\Exports\UsersExport;
use App\Exports\UsersExportView;
use App\Exports\UsersExportStyling;
use App\Imports\UsersImport;
use App\Imports\UsersImportValidate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersExcelController extends Controller
{
  public function index()
  {
    $users = User::orderBy('name')->get();

    return view('admin.users.indexExcel', compact('users'));
  }

  public function export()
  {
    return Excel::download(new UsersExport(), 'usersExport.xlsx');
  }

  public function export_view()
  {
    return Excel::download(new UsersExportView(), 'usersExportView.xlsx');
  }

  public function export_styling()
  {
    return Excel::download(new UsersExportStyling(), 'usersExportStyling.xlsx');
  }

  public function import_validate(Request $request)
  {
    // Validar el archivo
    request()->validate([
      'usersImportCE' => 'required'
    ]);

    $validator = Validator::make([
        'extension' => strtolower($request->usersImportCE->getClientOriginalExtension()),
      ],
      [
        'extension' => 'required|in:csv,xlsx,xls,odt,ods,odp',
      ]
    );

    if($validator->fails()) {
      return back()->with('failed', $validator->errors()->first());
    } else {
      Excel::import(new UsersImportValidate, $request->file('usersImportCE'));

      return back()->with('success', 'Importado satisfactoriamente!.');
    }
  }
}