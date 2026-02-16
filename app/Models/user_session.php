<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_session extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'session_id',
        'phone',
        'ip_address',
        'user_agent',
        'last_activity',
        'screen_width',
        'screen_height',
        'device_token',
    ];
        public function user()
    {
        return $this->belongsTo(User::class);
    }
}
