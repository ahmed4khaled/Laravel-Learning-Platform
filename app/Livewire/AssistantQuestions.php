<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lecture;
use App\Models\QuestionLec;
use App\Models\AnswerLec;

/**
 * Livewire component: assistant questions list and submit answers.
 * Uses QuestionLec, AnswerLec models.
 */
class AssistantQuestions extends Component
{         
    public $selectedLectureId = null;
    public $expandedLectures = [];
    public $newAnswers = [];
    public $filter = 'all'; // all, answered, unanswered
    public function toggleLecture($lectureId)
    {

        $this->selectedLectureId = $lectureId;
        
        if (in_array($lectureId, $this->expandedLectures)) {
            $this->expandedLectures = array_diff($this->expandedLectures, [$lectureId]);
        } else {
            $this->expandedLectures[] = $lectureId;
        }
    }

    public function submitAnswer($questionId)
    {
        $this->validate([
            "newAnswers.$questionId" => 'required|min:10'
        ]);
        

        AnswerLec::create([
            'content' => $this->newAnswers[$questionId],
            'questionlec_id' => $questionId,
            'user_id' => auth()->id()
        ]);

        unset($this->newAnswers[$questionId]);
        $this->dispatchBrowserEvent('notify', ['message' => 'تم إضافة الإجابة بنجاح']);
    }
public function render()
{
    $lectures = Lecture::withCount([
            'questions',
            'questions as answered_questions_count' => function($query) {
                $query->has('answers');
            },
            'questions as unanswered_questions_count' => function($query) {
                $query->doesntHave('answers');
            }
        ])
        ->when($this->filter === 'answered', function($query) {
            $query->having('answered_questions_count', '>', 0);
        })
        ->when($this->filter === 'unanswered', function($query) {
            $query->having('unanswered_questions_count', '>', 0);
        })
        ->orderBy('created_at', 'desc')
        ->get();

    $questions = collect();
    if ($this->selectedLectureId) {
        $questions = QuestionLec::where('lecture_id', $this->selectedLectureId)
            ->when($this->filter === 'answered', function($query) {
                $query->has('answers');
            })
            ->when($this->filter === 'unanswered', function($query) {
                $query->doesntHave('answers');
            })
            ->with(['user', 'answers.user'])
            ->latest()
            ->get();
    }

    return view('livewire.assistant-questions', [
        'lectures' => $lectures,
        'questions' => $questions
    ]);
}
}