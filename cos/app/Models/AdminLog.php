<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'description'
    ];

    /**
     * Get the user associated with the log.
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
