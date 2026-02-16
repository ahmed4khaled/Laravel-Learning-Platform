<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Sale / lecture purchase record (table: sells).
 */
class Sale extends Model
{
    use HasFactory;

    protected $table = 'sells';

    protected $fillable = [
        'user_id',
        'phone',
        'state',
        'Name',
        'id_lec',
        'std',
        'date_exp',
        'role_lec',
        'monthly',
        'termely',
    ];
}
