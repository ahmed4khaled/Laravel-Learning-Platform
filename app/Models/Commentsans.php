<?php

// app/Models/Comment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentsans extends Model
{
    use HasFactory;
    
    protected $fillable = ['answerlec_id', 'user_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answerlec()
    {
        return $this->belongsTo(AnswerLec::class);
    }
}
