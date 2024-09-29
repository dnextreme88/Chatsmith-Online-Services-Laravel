<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements HasName
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'maiden_name', 'last_name', 'username', 'profile_photo_path', 'email', 'password', 'is_staff'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url', // Laravel Jetstream
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Overrides function that gets logged in admin's name in Filament
    public function getFilamentName(): string
    {
        return $this->getFullNameAttribute();
    }

    public function getFullNameAttribute(): string {
        return $this->first_name. ' ' .$this->maiden_name. ' ' .$this->last_name;
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

    // Laravel Jetstream functions overridden
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->attributes['profile_photo_path']) {
            return asset('storage/images/' .$this->profile_photo_path);
        }

        // Default profile photo URL
        return 'https://ui-avatars.com/api/?name=' .urlencode($this->last_name). '&color=7F9CF5&background=EBF4FF';
    }

    public function updateProfilePhoto(?UploadedFile $photo)
    {
        $config_disk = config('jetstream.profile_photo_disk', 'profile_photos');

        // Delete old file
        if (!is_null($this->attributes['profile_photo_path'])) {
            Storage::disk($config_disk)->delete($this->attributes['profile_photo_path']);
        }

        if ($photo) {
            $file_path = $photo->storePublicly('avatars', $config_disk);

            $this->attributes['profile_photo_path'] = $file_path;
        } elseif (!$photo && $this->attributes['profile_photo_path']) {
            $this->attributes['profile_photo_path'] = null;
        }
    }

    /**
     * Get the employee associated with the user.
     */
    public function employee() {
        return $this->hasOne('App\Models\Employee');
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
