<?php

namespace App\Services;

use App\Models\AnswerLec;
use App\Models\Lecture;
use App\Models\QuestionLec;
use Illuminate\Support\Collection;

/**
 * Handles assistant questions listing and storing answers.
 */
class AssistantQuestionService
{
    /**
     * Get filtered lectures with question counts and optional questions list.
     *
     * @return array{lectures: \Illuminate\Support\Collection, questions: \Illuminate\Support\Collection, grades: \Illuminate\Support\Collection, selectedLectureId: mixed, filter: string, grade: string}
     */
    public function getIndexData(string $filter, string $grade, $selectedLectureId): array
    {
        $lectures = Lecture::withCount([
            'questions',
            'questions as answered_questions_count' => fn ($q) => $q->where('status', 1),
            'questions as unanswered_questions_count' => fn ($q) => $q->where('status', 0),
        ])
            ->when($filter === 'answered', fn ($q) => $q->having('answered_questions_count', '>', 0))
            ->when($filter === 'unanswered', fn ($q) => $q->having('unanswered_questions_count', '>', 0))
            ->when($grade !== 'all', fn ($q) => $q->where('grade', $grade))
            ->orderBy('created_at', 'desc')
            ->where('role', 1)
            ->get();

        $questions = $this->getQuestionsForFilter($filter, $grade, $selectedLectureId);
        $grades = Lecture::select('grade')->distinct()->pluck('grade');

        return [
            'lectures' => $lectures,
            'questions' => $questions,
            'grades' => $grades,
            'selectedLectureId' => $selectedLectureId,
            'filter' => $filter,
            'grade' => $grade,
        ];
    }

    /**
     * Get questions based on filter, grade, and selected lecture.
     */
    protected function getQuestionsForFilter(string $filter, string $grade, $selectedLectureId): Collection
    {
        $baseQuery = QuestionLec::when($filter === 'answered', fn ($q) => $q->where('status', 1))
            ->when($filter === 'unanswered', fn ($q) => $q->where('status', 0))
            ->with(['user', 'answers.user'])
            ->latest();

        if ($selectedLectureId) {
            return (clone $baseQuery)->where('lecture_id', $selectedLectureId)->get();
        }

        $baseQuery->when($grade !== 'all', function ($q) use ($grade) {
            $q->whereHas('lecture', fn ($q2) => $q2->where('grade', $grade));
        });
        return $baseQuery->get();
    }

    /**
     * Store answer and mark question as answered.
     */
    public function storeAnswer(array $validated, ?string $imagePath): void
    {
        $data = [
            'content' => $validated['content'],
            'questionlec_id' => $validated['question_id'],
            'user_id' => auth()->id(),
        ];
        if ($imagePath) {
            $data['image'] = $imagePath;
        }
        AnswerLec::create($data);

        $question = QuestionLec::find($validated['question_id']);
        $question->status = 1;
        $question->save();
    }
}
