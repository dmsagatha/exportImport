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
  public function model(array $row)
  {
    // Obtener el id de la Categoría
    $category = Category::where('name', '=', $row[0])->first();

    /* if ($row[3] == null) {
        $row[3] = '';
    } */

    return new Product([
      'category_id' => $category->id,
      'url'         => $row[1],
      'title'       => $row[2],
      'description' => $row[3],
    ]);
  }

  // There was an error on row 1. 3 es inválido.

  public function rules():array
  {
    return ([
      '0' => 'required|exists:categories,name',
      '1' => 'required|unique:products,url',
      '2' => 'required',
      '3' => 'required',
    ]);
  }

  public function customValidationMessages()
  {
    return [
      '0.exists'    =>  'El Nombre de la Categoría no existe',
      '1.required'  =>  'La Url es requerido.',
      '1.exists'    =>  'La Url ya existe',
      '2.required'  =>  'El Título es requerido.',
      '3.required'  =>  'La Descripción es requerida.',
    ];
  }

  public function customValidationAttributes()
  {
    return [
      '0' => 'Category',
      '1' => 'url',
      '2' => 'title',
      '3' => 'description',
    ];
  }
}