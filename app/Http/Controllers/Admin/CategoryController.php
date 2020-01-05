<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Traits\CsvImportTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
  use CsvImportTrait;
  
  public static function index()
  {
    $categories = Category::all();

    return view('admin.categories.index', compact('categories'));
  }
  
  public function show(Category $category)
	{
  }
  
  public function create()
	{
  }
  
  public function store(Request $request)
	{
  }

  public function edit(Category $category)
  {
  }

  private function rules(){
      return [
        'name' => 'required|unique:categories,name',
        'url'  => 'requiredunique:categories,url',
      ];
  }

  public function update(Request $request, Category $category)
  {
  }
  
  public function destroy(Category $category)
	{
  }
}