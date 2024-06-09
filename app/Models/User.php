<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\HasName;

class User extends Authenticatable implements HasName
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'maiden_name', 'last_name', 'full_name', 'username', 'profile_image', 'email', 'password', 'is_staff',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Overrides function that gets logged in admin's name in Filament
    public function getFilamentName(): string
    {
        return $this->full_name;
    }

    /**
     * Set the user's first_name, maiden_name and last_name values to uppercase.
     *
     * @param  string  $value
     * @return void
     */
    public function setFirstNameAttribute($value) {
        $this->attributes['first_name'] = strtoupper($value);
    }

    public function setMaidenNameAttribute($value) {
        $this->attributes['maiden_name'] = strtoupper($value);
    }

    public function setLastNameAttribute($value) {
        $this->attributes['last_name'] = strtoupper($value);
    }

    public function getImageAttribute() {
        return $this->profile_image;
    }

    /**
     * Get the employee associated with the user.
     */
    public function employee() {
        return $this->hasOne('App\Models\Employee');
    }

    /**
     * Get the admin logs associated with the user.
     */
    public function admin_log() {
        return $this->hasMany('App\Models\AdminLog');
    }

    /**
     * Get the announcements associated with the user.
     */
    public function announcement() {
        return $this->hasMany('App\Models\Announcement');
    }

    /**
     * Get the time records associated with the user.
     */
    public function time_record() {
        return $this->hasMany('App\Models\TimeRecord');
    }

    /**
     * Get the chat productions associated with the user.
     */
    public function production_chat() {
        return $this->hasMany('App\Models\ProductionChat');
    }

    /**
     * Get the focal productions associated with the user.
     */
    public function production_focal() {
        return $this->hasMany('App\Models\ProductionFocal');
    }

    /**
     * Get the plate productions associated with the user.
     */
    public function production_plate() {
        return $this->hasMany('App\Models\ProductionPlate');
    }

    /**
     * Get the schedules associated with the user.
     */
    public function schedule() {
        return $this->hasMany('App\Models\Schedule');
    }
}
