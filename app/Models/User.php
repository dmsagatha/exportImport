<?php

namespace App\Models;

use Flash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'username', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function peripherals()
	{
		return $this->hasMany(Peripheral::class, 'usersabs_id');
	}

	public function hasPeripherals()
	{
		return $this->hasMany(Peripheral::class, 'usersabs_id')->count();
	}

	public $messages;

  public static $rules = [
      'username' => 'required|unique:users,username,:id',
      'name'     => 'required',
      'email'    => 'required|email|unique:users,email,:id',
  ];
	
/* 	public static function boot()
	{
		parent::boot();
		
		// Validar integridad de los datos al Eliminar
		self::deleting(function ($model) {
      // Comprobar si el Usuario tiene asociados Periféricos
			if ($model->peripherals->count()) {
				//$html = 'El usuario no puede ser eliminado porque tiene Periféricos asociados:';
				$html = "El Usuario $model->name no puede ser eliminado porque tiene Periféricos asociados, con No. de Inventario:";
				$html .= '<ul>';
				foreach ($model->peripherals as $peripheral) {
					$html .= "<li>Inventario: $peripheral->inventory</li>";
				}
				$html .= "</ul>";
				Flash::overlay($html, "Error de integridad de los datos");
				return false;
			}
		});
	} */
}