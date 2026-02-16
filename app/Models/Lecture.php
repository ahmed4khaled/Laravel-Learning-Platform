<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'std',
        'role',
        'monthly',
        'img',
        'grade',
        'name0',
        'link0',
        'time',
        'selling',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'time' => 'integer',
    ];

    // Accessor للحصول على اسم المحاضرة
    public function getNameAttribute()
    {
        return $this->title;
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function questions()
    {
        return $this->hasMany(QuestionLec::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sells()
    {
        return $this->hasMany(Sale::class, 'id_lec');
    }

    // Scope للمحاضرات النشطة
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
