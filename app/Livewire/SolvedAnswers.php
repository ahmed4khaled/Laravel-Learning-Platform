<?php

namespace App\Livewire;

use App\Models\Exam;
use App\Models\StudentAnswer;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

/**
 * Livewire component: display solved exam answers (review).
 */
class SolvedAnswers extends Component
{
    public $exam;
    public $attempt;
    public $questions;
    public $studentAnswers = [];

    public function mount($exam, $attempt)
    {
        $this->exam = Exam::findOrFail($exam);
        $this->attempt = $attempt;
        $this->questions = $this->exam->questions;

        $answers = StudentAnswer::where('user_id', Auth::id())
            ->where('attempt', $attempt)
            ->whereIn('question_id', $this->questions->pluck('id'))
            ->get()
            ->keyBy('question_id');

        foreach ($this->questions as $question) {
            $this->studentAnswers[$question->id] = [
                'selected_option' => $answers[$question->id]->answer_chosen ?? null,
                'is_correct' => $answers[$question->id]->is_correct ?? false,
            ];
        }
    }

    public function render()
    {
        return view('livewire.solved-answers');
    }
}
