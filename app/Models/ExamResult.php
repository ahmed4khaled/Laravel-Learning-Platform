<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'exam_id',
        'score',
        'total',
        'passed',
        'attempt',
    ];

    protected $casts = [
        'passed' => 'boolean',
        'score' => 'float',
        'total' => 'integer',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    
    public function answers()
    {
        return $this->hasMany(StudentAnswer::class);
    }

    // حساب النسبة المئوية
    public function getPercentageAttribute()
    {
        if ($this->total === 0) {
            return 0;
        }
        return round(($this->total / $this->exam->total_points) * 100, 2);
    }

    // التحقق من النجاح
    public function isPassed()
    {
        return $this->passed;
    }

    // الحصول على التقدير
    public function getGradeAttribute()
    {
        $percentage = $this->percentage;
        
        if ($percentage >= 90) return 'ممتاز';
        if ($percentage >= 80) return 'جيد جداً';
        if ($percentage >= 70) return 'جيد';
        if ($percentage >= 60) return 'مقبول';
        return 'ضعيف';
    }
}
