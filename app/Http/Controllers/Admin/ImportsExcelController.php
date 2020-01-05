<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Imports\ProductsCategoriesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImportsExcelController extends Controller
{
  public function index()
  {
    $products = Product::with('category')->orderBy('title')->get();

    return view('admin.importsExcel.indexExcel', compact('products'));
  }

  public function importProductsCategories()
  {
    // Validar el archivo
    request()->validate([
      'productsCategories' => 'required'
    ]);
    
    Excel::import(new ProductsCategoriesImport, request()->file('productsCategories'));

    return redirect()->route('admin.importsExcel.index')
                     ->with('success', 'Importado satisfactoriamente!.');
  }
}