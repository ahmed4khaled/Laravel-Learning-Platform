<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * QR code model (table: qrs).
 */
class QrCode extends Model
{
    use HasFactory;

    protected $table = 'qrs';

    protected $fillable = [
        'qr',
        'value',
        'role',
        'std',
        'user_id',
        'used',
        'discount',
        'copon',
        'Lecname',
        'phone',
    ];
}
