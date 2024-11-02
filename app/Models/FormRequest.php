<?php

namespace App\Models;

use App\Enums\EmployeeRoles;
use App\Enums\RequestStatuses;
use App\Enums\RequestTypes;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormRequest extends Model
{
    use HasFactory;

    protected $casts = [
        'request_type' => RequestTypes::class,
        'request_status' => RequestStatuses::class
    ];

    protected $fillable = [
        'user_id', 'checked_by_employee_id', 'reason', 'request_type', 'request_status', 'date_from', 'date_to'
    ];

    public function getCheckedByFullNameAttribute(): ?string
    {
        if ($this->checked_by_employee_id) {
            $employee = Employee::find($this->checked_by_employee_id);

            return $employee->user->full_name;
        } else {
            return null;
        }
    }

    public function getCheckedByProfilePhotoPathAttribute(): ?string
    {
        if ($this->checked_by_employee_id) {
            $employee = Employee::find($this->checked_by_employee_id);

            return $employee->user->profile_photo_url;
        } else {
            return null;
        }
    }

    public function getCheckedByRoleAttribute(): ?EmployeeRoles
    {
        if ($this->checked_by_employee_id) {
            $employee = Employee::find($this->checked_by_employee_id);

            return $employee->role;
        } else {
            return null;
        }
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
