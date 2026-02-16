<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'exam_id',
        'question',        
        'question_type', // 'multiple_choice', 'true_false', 'essay'
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_option',
        'mark',
        'points', // إضافة points للتوافق مع النماذج
        'explanation',
        'is_active',
        'question_image' ,
        'attempt_number'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'mark' => 'integer'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class);
    }

    // Scope للأسئلة النشطة
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // الحصول على الإجابة الصحيحة كنص
    public function getCorrectAnswerTextAttribute()
    {
        if ($this->question_type === 'multiple_choice') {
            $options = [
                'a' => $this->option_a,
                'b' => $this->option_b,
                'c' => $this->option_c,
                'd' => $this->option_d
            ];

            return $options[$this->correct_option] ?? '';
        } elseif ($this->question_type === 'true_false') {
            return $this->correct_option === 'true' ? 'صح' : 'خطأ';
        }
        
        return '';
    }

    // التحقق من صحة الإجابة
    public function isCorrectAnswer($answer)
    {
        if ($this->question_type === 'multiple_choice') {
            return strtolower($answer) === strtolower($this->correct_option);
        } elseif ($this->question_type === 'true_false') {
            return strtolower($answer) === strtolower($this->correct_option);
        }
        
        return false; // للأسئلة المقالية
    }

    // حساب النسبة المئوية للإجابات الصحيحة
    public function getCorrectAnswerRateAttribute()
    {
        $totalAnswers = $this->studentAnswers()->count();
        if ($totalAnswers === 0) {
            return 0;
        }

        $correctAnswers = $this->studentAnswers()
            ->where('is_correct', true)
            ->count();

        return round(($correctAnswers / $totalAnswers) * 100, 2);
    }
}
