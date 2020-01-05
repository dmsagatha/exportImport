<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsCategoriesImport implements ToModel, WithHeadingRow, WithValidation
{
  /**
  * @param array $row
  *
  * @return \Illuminate\Database\Eloquent\Model|null
  */
  public function model(array $row)
  {
    // Si los registros existen actualzarlos, de lo contrario crearlos
    $product  = Product::where('url', '=', $row['url'])->first();
    $category = Category::where('name', '=', $row['name'])->first();

    if ($product) {
      $product->title       = $row['title'];
      $product->description = $row['description'];
      $product->category_id = $category->id;

      $product->save();

      return $product;
    }
    else {
      return new Product([
        'url'         => $row['url'],
        'title'       => $row['title'],
        'description' => $row['description'],
        'category_id' => $category->id,
      ]);
    }
  }
  
  public function rules():array
  {
    return ([
      'url'   => 'required',
      'title' => 'required',
      'description' => 'required',
      'name'  => 'required|exists:categories,name',
    ]);
  }

  public function customValidationMessages()
  {
    return [
      'url.required'    =>  'El campo :attribute es requerido.',
      //'url.exists'    =>  'El campo :attribute ya existe',
      'title.required'  =>  'El campo :attribute es requerido.',
      'description.required'  =>  'El campo :attribute es requerida.',
      'name.exists'     =>  'El campo :attribute de la Categoría no existe',
    ];
  }

  public function customValidationAttributes()
  {
    return [
      'url'         => 'url',
      'title'       => 'title',
      'description' => 'description',
      'Category'    => 'Category',
    ];
  }
}