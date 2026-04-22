<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_session extends Model
{
    use HasFactory;

    protected $table = 'user_sessions';

    protected $fillable = [
        'user_id',
        'token',
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
