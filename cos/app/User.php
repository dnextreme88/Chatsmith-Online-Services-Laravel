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
		'first_name', 'maiden_name', 'last_name', 'username', 'profile_image', 'email', 'password', 'is_staff',
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

	/**
	 * Set the user's first_name, maiden_name and last_name values to uppercase.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setFirstNameAttribute ($value) {
		$this->attributes['first_name'] = strtoupper($value);
	}

	public function setMaidenNameAttribute ($value) {
		$this->attributes['maiden_name'] = strtoupper($value);
	}

	public function setLastNameAttribute ($value) {
		$this->attributes['last_name'] = strtoupper($value);
	}

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
	 * Get the admin logs associated with the user.
	 */
	public function admin_log () {
		return $this->hasMany('App\AdminLog');
	}

	/**
	 * Get the announcements associated with the user.
	 */
	public function announcement () {
		return $this->hasMany('App\Announcement');
	}

	/**
	 * Get the time records associated with the user.
	 */
	public function time_record () {
		return $this->hasMany('App\TimeRecord');
	}

	/**
	 * Get the chat productions associated with the user.
	 */
	public function production_chat () {
		return $this->hasMany('App\ProductionChat');
	}

	/**
	 * Get the focal productions associated with the user.
	 */
	public function production_focal () {
		return $this->hasMany('App\ProductionFocal');
	}

	/**
	 * Get the plate productions associated with the user.
	 */
	public function production_plate () {
		return $this->hasMany('App\ProductionPlate');
	}

    /**
     * Get the schedules associated with the user.
     */
    public function schedule () {
        return $this->hasMany('App\Schedule');
    }
}
