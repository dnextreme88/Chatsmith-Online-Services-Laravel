<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Announcement;
use App\Models\Employee;
use App\Models\ProductionChat;
use App\Models\ProductionFocal;
use App\Models\ProductionPlate;
use App\Models\Schedule;
use App\Models\Task;
use App\Models\TimeRecord;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        'first_name',
        'maiden_name',
        'last_name',
        'email',
        'username',
        'phone_number',
        'address',
        'profile_photo_path',
        'password'
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
        return $this->last_name. ', ' .$this->first_name. ' ' .$this->maiden_name;
    }

    // Setter functions
    public function setFirstNameAttribute($value) {
        $this->attributes['first_name'] = Str::title($value);
    }

    public function setMaidenNameAttribute($value) {
        $this->attributes['maiden_name'] = Str::title($value);
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

    // Relationships
    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }

    public function production_chats(): HasMany
    {
        return $this->hasMany(ProductionChat::class);
    }

    public function production_focals(): HasMany
    {
        return $this->hasMany(ProductionFocal::class);
    }

    public function production_plates(): HasMany
    {
        return $this->hasMany(ProductionPlate::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function time_records(): HasMany
    {
        return $this->hasMany(TimeRecord::class);
    }
}
