<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Exam;
use App\Models\Lecture;
use App\Models\Question;

/**
 * Livewire component for creating exams with questions.
 */
class ExamCreator extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $lecture_id;
    public $duration_min = 30;
    public $max_attempts = 3;
    public $pass_score = 50;
    public $is_active = true;
    public $start_date;
    public $end_date;
    public $questions = [];

    public function mount()
    {
        $this->addQuestion();
    }

    public function addQuestion()
    {
        $this->questions[] = [
            'question' => '',
            'question_type' => 'multiple_choice',
            'option_a' => '',
            'option_b' => '',
            'option_c' => '',
            'option_d' => '',
            'correct_option' => '',
            'points' => 1,
            'explanation' => '',
            'is_active' => true,
        ];
    }

    public function updateQuestionType($index, $type)
    {
        $this->questions[$index]['question_type'] = $type;
        if ($type === 'multiple_choice') {
            $this->questions[$index]['option_a'] = '';
            $this->questions[$index]['option_b'] = '';
            $this->questions[$index]['option_c'] = '';
            $this->questions[$index]['option_d'] = '';
            $this->questions[$index]['correct_option'] = '';
        } else {
            $this->questions[$index]['option_a'] = '';
            $this->questions[$index]['option_b'] = '';
            $this->questions[$index]['option_c'] = '';
            $this->questions[$index]['option_d'] = '';
            $this->questions[$index]['correct_option'] = '';
        }
    }

    public function removeQuestion($index)
    {
        if (count($this->questions) > 1) {
            unset($this->questions[$index]);
            $this->questions = array_values($this->questions);
        }
    }

    public function submitExam()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lecture_id' => 'required|exists:lectures,id',
            'duration_min' => 'required|integer|min:1',
            'max_attempts' => 'required|integer|min:1',
            'pass_score' => 'required|integer|min:1|max:100',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'questions.*.question' => 'required|string',
            'questions.*.question_type' => 'required|in:multiple_choice,true_false,essay',
            'questions.*.option_a' => 'required_if:questions.*.question_type,multiple_choice|nullable|string',
            'questions.*.option_b' => 'required_if:questions.*.question_type,multiple_choice|nullable|string',
            'questions.*.option_c' => 'required_if:questions.*.question_type,multiple_choice|nullable|string',
            'questions.*.option_d' => 'required_if:questions.*.question_type,multiple_choice|nullable|string',
            'questions.*.correct_option' => 'required_if:questions.*.question_type,multiple_choice,true_false|nullable|in:a,b,c,d,true,false',
            'questions.*.points' => 'required|integer|min:1',
            'questions.*.explanation' => 'nullable|string',
            'questions.*.is_active' => 'boolean',
        ]);

        $exam = Exam::create([
            'title' => $this->title,
            'description' => $this->description,
            'lecture_id' => $this->lecture_id,
            'duration_min' => $this->duration_min,
            'max_attempts' => $this->max_attempts,
            'pass_score' => $this->pass_score,
            'is_active' => $this->is_active,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'total_questions' => count($this->questions),
            'total_points' => array_sum(array_column($this->questions, 'points')),
        ]);

        foreach ($this->questions as $questionData) {
            $question = new Question([
                'question' => $questionData['question'],
                'question_type' => $questionData['question_type'],
                'option_a' => $questionData['question_type'] === 'multiple_choice' ? $questionData['option_a'] : null,
                'option_b' => $questionData['question_type'] === 'multiple_choice' ? $questionData['option_b'] : null,
                'option_c' => $questionData['question_type'] === 'multiple_choice' ? $questionData['option_c'] : null,
                'option_d' => $questionData['question_type'] === 'multiple_choice' ? $questionData['option_d'] : null,
                'correct_option' => $questionData['correct_option'],
                'points' => $questionData['points'],
                'explanation' => $questionData['explanation'],
                'is_active' => $questionData['is_active'],
            ]);
            $exam->questions()->save($question);
        }

        session()->flash('success', 'تم إنشاء الامتحان بنجاح');
        return redirect()->route('dashboard.exams.index');
    }

    public function render()
    {
        $lectures = Lecture::all();
        return view('livewire.examcreator', compact('lectures'));
    }
}
