<?php

namespace App\Http\Controllers\Admin;

use App\Models\CsvUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CsvUploadController extends Controller
{
  public function index()
  {
    return view('admin.csvUploads.index')->with([
      'csvUploads' => CsvUpload::latest()->get()
    ]);
  }
  
  public function create()
  {}
  
  public function store(Request $request)
  {}
  
  public function show(CsvUpload $csvUpload)
  {}
  
  public function edit(CsvUpload $csvUpload)
  {}
  
  public function update(Request $request, CsvUpload $csvUpload)
  {}
  
  public function destroy(CsvUpload $csvUpload)
  {}
}