<?php

namespace App\Livewire;

use App\Models\QuestionLec;
use App\Models\AnswerLec;
use App\Models\Commentsans;
use Livewire\WithPagination;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

/**
 * Livewire component: lecture Q&A (questions and answers per lecture).
 * Uses QuestionLec, AnswerLec, Commentsans models.
 */
class QuestionsLec extends Component
{
    use WithPagination, WithFileUploads;

    public $lectureId;
    public $newQuestion = '';
    public $questionImage; 
    public $newAnswers = [];
    public $newComments = [];
    public $showAnswersForQuestion = null;
    public $answers = [];

    public function mount($lectureId)
    {
        $this->lectureId = $lectureId;
    }

    public function submitQuestion()
    {
        $this->validate([
            'newQuestion'   => 'required|min:5|max:1000',
            'questionImage' => 'nullable|image|max:2048', // صورة اختيارية 2MB
        ]);

        $imagePath = null;

        if ($this->questionImage) {
            // يرفع الصورة داخل storage/app/public/questions
            $imageName = time() . '_' . $this->questionImage->getClientOriginalName();
            $this->questionImage->storeAs('questions', $imageName, 'public');

            // نخزن المسار بالنسبة للـ public
            $imagePath = 'storage/questions/' . $imageName;
        }

        QuestionLec::create([
            'lecture_id' => $this->lectureId,
            'user_id'    => auth()->id(),
            'content'    => $this->newQuestion,
            'image'      => $imagePath
        ]);

        $this->reset(['newQuestion', 'questionImage']);
    }

    public function toggleAnswers($questionId)
    {
        if ($this->showAnswersForQuestion === $questionId) {
            $this->showAnswersForQuestion = null;
        } else {
            $this->showAnswersForQuestion = $questionId;
            $this->loadAnswers($questionId);
        }
    }

    public function loadAnswers($questionId)
    {
        $answers = AnswerLec::where('questionlec_id', $questionId)
            ->with(['user', 'commentsan.user'])
            ->get();

        $this->answers[$questionId] = $answers;
    }

    public function submitAnswer($questionId)
    {
        $this->validate([
            "newAnswers.$questionId" => 'required|min:5|max:1000'
        ]);

        AnswerLec::create([
            'questionlec_id' => $questionId,
            'user_id'        => auth()->id(),
            'content'        => $this->newAnswers[$questionId]
        ]);

        unset($this->newAnswers[$questionId]);
        $this->loadAnswers($questionId);
    }

    public function submitComment($answerId)
    {
        $this->validate([
            "newComments.$answerId" => 'required|min:2|max:500'
        ]);

        Commentsans::create([
            'answerlec_id' => $answerId,
            'user_id'      => auth()->id(),
            'content'      => $this->newComments[$answerId]
        ]);

        unset($this->newComments[$answerId]);
        $this->loadAnswers(AnswerLec::find($answerId)->questionlec_id);
    }

    public function render()
    {
        $questions = QuestionLec::with(['user', 'answers.user', 'answers.commentsan.user'])
            ->where('lecture_id', $this->lectureId)
            ->latest()
            ->paginate(10);

        return view('livewire.questions-lec', compact('questions'));
    }
}
