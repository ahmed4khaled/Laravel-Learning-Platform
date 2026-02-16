<?php

namespace App\Services;

use App\Models\Exam;
use App\Models\Lecture;
use App\Models\Question;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Handles exam CRUD, listing, stats, export, duplicate, and question totals.
 */
/**
 * Exam listing, stats, export, and duplicate logic.
 * Used by ExamController to keep controllers thin.
 */
class ExamService
{
    /**
     * Build filtered exam list, stats, and recent exams for dashboard index.
     */
    public function getIndexData(Request $request): array
    {
        $query = Exam::withCount(['questions', 'results'])->with('lecture');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('lecture_id')) {
            $query->where('lecture_id', $request->lecture_id);
        }
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }
        if ($request->filled('date_from')) {
            $query->where('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('created_at', '<=', $request->date_to);
        }

        $stats = [
            'total_exams' => Exam::count(),
            'active_exams' => Exam::where('is_active', true)->count(),
            'total_questions' => Question::count(),
            'total_attempts' => DB::table('exam_results')->count(),
        ];

        $recent_exams = Exam::withCount('questions')
            ->with('lecture')
            ->latest()
            ->take(5)
            ->get();

        $exams = $query->latest()->paginate(10);
        $lectures = Lecture::all();

        return compact('exams', 'stats', 'recent_exams', 'lectures');
    }

    public function updateExamTotals(Exam $exam): void
    {
        $totals = $exam->questions()
            ->where('is_active', true)
            ->selectRaw('COUNT(*) as total_questions, SUM(mark) as total_points')
            ->first();

        $exam->update([
            'total_questions' => $totals->total_questions ?? 0,
            'total_points' => $totals->total_points ?? 0,
        ]);
    }

    public function getExportData(Request $request)
    {
        $query = Exam::withCount(['questions', 'results'])->with('lecture');
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('lecture_id')) {
            $query->where('lecture_id', $request->lecture_id);
        }
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }
        return $query->get();
    }

    public function duplicateExam(Exam $exam): Exam
    {
        $newExam = $exam->replicate();
        $newExam->title = $exam->title . ' (نسخة)';
        $newExam->is_active = false;
        $newExam->save();

        foreach ($exam->questions as $question) {
            $newQuestion = $question->replicate();
            $newQuestion->exam_id = $newExam->id;
            $newQuestion->save();
        }

        return $newExam;
    }
}
