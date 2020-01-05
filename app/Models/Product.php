<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'products';

	protected $fillable = [
    'title',
    'url',
    'description',
    'category_id',
	];

  public function getRouteKeyName()
  {
    return 'url';
  }

  /**
   * Cada Producto va a pertenecer a 1 Categoría
   */
  public function category()
  {
    return $this->belongsTo(Category::class);
  }
}