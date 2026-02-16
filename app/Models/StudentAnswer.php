<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'exam_result_id',
        'question_id',
        'answer_chosen',
        'is_correct',
        'attempt',
        'mark',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'mark' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function examResult()
    {
        return $this->belongsTo(ExamResult::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // التحقق من صحة الإجابة
    public function isCorrect()
    {
        return $this->is_correct;
    }

    // الحصول على النقاط المكتسبة
    public function getEarnedPoints()
    {
        return $this->is_correct ? $this->mark : 0;
    }
}
