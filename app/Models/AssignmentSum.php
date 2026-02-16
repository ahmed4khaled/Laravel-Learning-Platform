<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Assignment submission (table: assignmentsums).
 */
class AssignmentSum extends Model
{
    use HasFactory;

    protected $table = 'assignmentsums';

    protected $fillable = [
        'lecture_id',
        'user_id',
        'file_path',
        'teacher_notes',
        'grade',
        'notes',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function getFileUrlAttribute()
    {
        return $this->file_path ? asset('storage/' . $this->file_path) : null;
    }
}
