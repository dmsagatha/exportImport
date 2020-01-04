<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use lluminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsCategoriesImport implements ToModel, WithValidation
{
  /**
  * @param array $row
  *
  * @return \Illuminate\Database\Eloquent\Model|null
  */
  public function model(array $row)
  {
    // Si los registros existen actualzarlos, de lo contrario crearlos
    $product  = Product::where('url', '=', $row[0])->first();
    $category = Category::where('name', '=', $row[3])->first();

    if ($product) {
      $product->title       = $row[1];
      $product->description = $row[2];
      $product->category_id = $category->id;

      $product->save();

      return $product;
    }
    else {
      return new Product([
        'url'         => $row[0],
        'title'       => $row[1],
        'description' => $row[2],
        'category_id' => $category->id,
      ]);
    }
  }
  
  public function rules():array
  {
    return ([
      '0' => 'required',//|unique:products,url',
      '1' => 'required',
      '2' => 'required',
      '3' => 'required|exists:categories,name',
    ]);
  }

  public function customValidationMessages()
  {
    return [
      '0.required'  =>  'La Url es requerido.',
      //'0.exists'    =>  'La Url ya existe',
      '1.required'  =>  'El Título es requerido.',
      '2.required'  =>  'La Descripción es requerida.',
      '3.exists'    =>  'El Nombre de la Categoría no existe',
    ];
  }

  public function customValidationAttributes()
  {
    return [
      '0' => 'url',
      '1' => 'title',
      '2' => 'description',
      '3' => 'Category',
    ];
  }
}