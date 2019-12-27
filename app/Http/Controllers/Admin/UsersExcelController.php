<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
//use Maatwebsite\Excel\Facades\Excel;
use Excel;
use App\Exports\UsersExport;
use App\Exports\UsersExportView;
use App\Exports\UsersExportStyling;
use App\Imports\UsersImport;
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

  public function import(Request $request)
  {
    // Validar el archivo
    request()->validate([
      'usersImportSE' => 'required'
    ]);
    
    Excel::import(new UsersImport(), request()->file('usersImportSE'));

    return redirect()->route('admin.users.excel.index')->with('success', 'Importado satisfactoriamente!.');
  }
}