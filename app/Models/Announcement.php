<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description'
    ];

    /**
     * Get the user associated with the announcement.
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
