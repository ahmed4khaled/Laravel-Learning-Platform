<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Lecture question answer (table: answerlecs).
 */
class AnswerLec extends Model
{
    use HasFactory;

    protected $table = 'answerlecs';

    protected $fillable = ['questionlec_id', 'user_id', 'content', 'image'];

    public function questionlec()
    {
        return $this->belongsTo(QuestionLec::class);
    }

    public function commentsan()
    {
        return $this->hasMany(Commentsans::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
