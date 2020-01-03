<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'categories';

	protected $fillable = [
    'name',
    'url',
	];

  public function getRouteKeyName()
  {
    return 'url';
  }

  /**
   * Una Categoría puede tener muchos Productos
   */
  public function products()
  {
    return $this->hasMany(Product::class);
  }
}