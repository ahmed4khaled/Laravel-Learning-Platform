<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Lecture question (table: questionlecs).
 */
class QuestionLec extends Model
{
    use HasFactory;

    protected $table = 'questionlecs';

    protected $fillable = ['lecture_id', 'user_id', 'content', 'status', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(AnswerLec::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class, 'lecture_id');
    }
}
