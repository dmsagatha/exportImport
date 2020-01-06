<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	protected $guarded = [];

	/**
	 * Las reglas de validación para los modelos
	 *
	 * @var array
	 */
	public static $rules = [];

	/**
	 * Validación de campos únicos en la actualización de información del modelo
	 *
	 * @return array
	 */
	public function updateRules()
	{
		$rules = static::$rules;

		foreach ($rules as $field => $rule) {
			$rules[$field] = str_replace(':id', $this->getKey(), $rule);
		}
		return $rules;
	}
}