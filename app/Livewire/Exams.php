<?php

namespace App\Livewire;

use App\Models\Exam;
use App\Models\StudentAnswer;
use App\Models\ExamResult;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

/**
 * Livewire component: take exam (questions, timer, submit, attempts).
 */
class Exams extends Component
{
    public $exam;
    public $questions;
    public $currentQuestion = 0;
    public $timeRemaining;
    public $startTime;
    public $selectedAnswers = [];
    public $maxAttempts ;
    public $showLecture;
    public $examFinished = false;
    public $examStarted = false;
    public $currentAttempt = 0;
    public $score = 0;
    public $totalScore = 0;
    public $totalScores = 0;
    public $allAttempts = [];
    public $examId;
    public $grade;
    public $lec_id;

    public function mount( $examId, $grade, $lec_id)
    {
        $this->grade = $grade;
        $this->lec_id = $lec_id;

        $this->examId = $examId;
        $this->exam = Exam::findOrFail(intval($examId));
        $this->maxAttempts = $this->exam->max_attempts;
        


    

        $this->questions = $this->exam->questions;
        $this->totalScore = $this->questions->sum('mark');
         $this->totalScores=$this->exam->total_points;

        $this->currentAttempt = ExamResult::where('user_id', Auth::id())
            ->where('exam_id', $this->exam->id)
            ->max('attempt') ?? 0;

        $this->allAttempts = ExamResult::where('user_id', Auth::id())
            ->where('exam_id', $this->exam->id)
            ->orderBy('attempt')
            ->get();

        // انتهاء المحاولات
        if ($this->currentAttempt >= $this->maxAttempts) {
            $this->examFinished = true;
            return;
        }

        // لو نجح في أي محاولة، نظهر له المحاضرة
        $last = ExamResult::where('user_id', Auth::id())
            ->where('exam_id', $this->exam->id)
            ->orderByDesc('attempt')
            ->first();
        if ($last && $last->total >= $this->exam->pass_score) {
            $this->showLecture = true;
            $this->score = $last->total;
        }

        // استرجاع وقت الامتحان لو كان شغال
        if (session()->has('exam_start_time_' . $this->examId)) {
            $this->examStarted = true;
            $this->startTime = Carbon::parse(session('exam_start_time_' . $this->examId));
            $this->countdown();

            // تحميل الإجابات السابقة في الجلسة
            $attemptNumber = $this->currentAttempt + 1;
            $answers = StudentAnswer::where('user_id', Auth::id())
                ->where('attempt', $attemptNumber)
                ->pluck('answer_chosen', 'question_id')
                ->toArray();
            $this->selectedAnswers = $answers;
        }
    }

 public function startExam()
{
    if ($this->examStarted || $this->examFinished) return;

    $this->examStarted = true;
    $this->examFinished = false;
    $this->selectedAnswers = [];
    $this->currentQuestion = 0;

    $attemptNumber = $this->currentAttempt + 1;

    if ($attemptNumber <= 2) {
        // 🔹 لو أول أو تاني محاولة: الأسئلة حسب attempt_number
        $this->questions = $this->exam->questions()
            ->where('attempt_number', $attemptNumber)
            ->get();
    } else {
        // 🔹 المحاولة الثالثة: ميكس 50/50
        $questions1 = $this->exam->questions()
            ->where('attempt_number', 1)
            ->inRandomOrder()
            ->get();

        $questions2 = $this->exam->questions()
            ->where('attempt_number', 2)
            ->inRandomOrder()
            ->get();

        // تحديد العدد المطلوب من كل مجموعة
        $count1 = floor($questions1->count() / 2);
        $count2 = floor($questions2->count() / 2);

        $mix = $questions1->take($count1)
            ->merge($questions2->take($count2))
            ->shuffle();

        $this->questions = $mix;
    }

    $this->startTime = now();
    session(['exam_start_time_' . $this->examId => $this->startTime->toDateTimeString()]);
    $this->timeRemaining = $this->exam->duration_min * 60;
}


    public function countdown()
    {
        if (!$this->examStarted || $this->examFinished) return;

        $start = Carbon::parse(session('exam_start_time_' . $this->examId));
        $elapsed = now()->diffInSeconds($start);
        $this->timeRemaining = max(0, ($this->exam->duration_min * 60) - $elapsed);

        if ($this->timeRemaining <= 0) {
            $this->submitExam();
        }
    }

    public function next()
    {
        if ($this->currentQuestion < count($this->questions) - 1) {
            $this->currentQuestion++;
        }
    }

    public function previous()
    {
        if ($this->currentQuestion > 0) {
            $this->currentQuestion--;
        }
    }

    public function chooseAnswer($questionId, $correctAnswer, $selectedAnswer, $mark)
    {
        $this->selectedAnswers[$questionId] = $selectedAnswer;
        $attemptNumber = $this->currentAttempt + 1;
        $score = $correctAnswer === $selectedAnswer ? $mark : 0;

        $examResult = ExamResult::firstOrCreate(
            ['user_id' => Auth::id(), 'exam_id' => $this->exam->id, 'attempt' => $attemptNumber],
            ['total' => 0]
        );

        $studentAnswer = StudentAnswer::firstOrNew([
            'user_id' => Auth::id(),
            'exam_result_id' => $examResult->id,
            'question_id' => $questionId,
            'attempt' => $attemptNumber,
        ]);

        $studentAnswer->answer_chosen = $selectedAnswer;
        $studentAnswer->is_correct = $correctAnswer === $selectedAnswer;
        $studentAnswer->mark = $score;
        $studentAnswer->save();
    }

    public function submitExam()
    {
        session()->forget('exam_start_time_' . $this->examId);
        $attemptNumber = $this->currentAttempt + 1;

        $total = StudentAnswer::where('user_id', Auth::id())
            ->whereIn('question_id', $this->questions->pluck('id'))
            ->where('attempt', $attemptNumber)
            ->sum('mark');

        ExamResult::updateOrCreate(
            ['user_id' => Auth::id(), 'exam_id' => $this->exam->id, 'attempt' => $attemptNumber],
            ['total' => $total, 'passed' => $total >= $this->exam->pass_score]
        );

        $this->examFinished = true;
        $this->examStarted = false;
        $this->score = $total;

        $this->currentAttempt++;
        $this->allAttempts = ExamResult::where('user_id', Auth::id())
            ->where('exam_id', $this->exam->id)
            ->orderBy('attempt')
            ->get();

        if ($total >= $this->exam->pass_score) {
            $this->showLecture = true;
        }
    }

    public function render()
    {
        return view('livewire.exams', [
            'timeRemaining' => $this->timeRemaining,
        ]);
    }
}
