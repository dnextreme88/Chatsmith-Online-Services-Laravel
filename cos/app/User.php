<?php

namespace App;

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
		'name', 'username', 'profile_image', 'email', 'password', 'is_staff',
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

	public function getImageAttribute () {
		return $this->profile_image;
	}

	/**
	 * Get the employee associated with the user.
	 */
	public function employee () {
		return $this->hasOne('App\Employee');
	}

	/**
	 * Get the admin log associated with the user.
	 */
	public function admin_log () {
		return $this->hasOne('App\AdminLog');
	}
}
