<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImportsExcelController extends Controller
{
  public function index()
  {
    $products = Product::with('category')->orderBy('title')->get();

    return view('admin.importsExcel.indexExcel', compact('products'));
  }
}