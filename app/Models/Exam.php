<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'lecture_id',
        'pass_score',
        'duration_min',
        'max_attempts',
        'is_active',
        'start_date',
        'end_date',
        'total_questions',
        'total_points'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(ExamResult::class);
    }

    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class);
    }

    // Scope للامتحانات النشطة
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope للامتحانات المتاحة حالياً
    public function scopeAvailable($query)
    {
        $now = now();
        return $query->where('is_active', true)
                    ->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
    }

    // حساب النسبة المئوية للنجاح
    public function getPassRateAttribute()
    {
        if ($this->results()->count() === 0) {
            return 0;
        }
        
        $passedCount = $this->results()->where('total', '>=', $this->pass_score)->count();
        return round(($passedCount / $this->results()->count()) * 100, 2);
    }

    // التحقق من أن الامتحان متاح
    public function isAvailable()
    {
        $now = now();
        return $this->is_active && 
               $this->start_date <= $now && 
               $this->end_date >= $now;
    }
}
