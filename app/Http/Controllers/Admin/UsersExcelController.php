<?php

namespace App\Http\Controllers\Admin;

use Excel;
use App\Models\User;
use App\Exports\UsersExport;
use App\Exports\UsersExportView;
use App\Exports\UsersExportStyling;
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
}