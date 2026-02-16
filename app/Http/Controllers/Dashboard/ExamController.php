<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExamQuestionRequest;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Exam;
use App\Models\Lecture;
use App\Models\Question;
use App\Services\ExamService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Exam CRUD, questions, statistics, export, duplicate.
 * Thin controller: request → ExamService → response.
 */
class ExamController extends Controller
{
    public function __construct(
        protected ExamService $examService
    ) {}

    /**
     * List exams with filters and stats.
     */
    public function index(Request $request): View
    {
        $data = $this->examService->getIndexData($request);
        return view('dashboard.exams.index', $data);
    }

    /**
     * Show create form.
     */
    public function create(): View
    {
        $lectures = Lecture::all();
        return view('dashboard.exams.create', compact('lectures'));
    }

    /**
     * Store new exam.
     */
    public function store(StoreExamRequest $request): RedirectResponse
    {
        $exam = Exam::create($request->validated());
        return redirect()
            ->route('dashboard.exams.show', $exam)
            ->with('success', 'تم إنشاء الامتحان بنجاح');
    }

    /**
     * Show exam details.
     */
    public function show(Exam $exam): View
    {
        $exam->load(['questions', 'lecture', 'results']);
        $questionStats = [
            'total' => $exam->questions()->count(),
            'active' => $exam->questions()->where('is_active', true)->count(),
            'by_type' => $exam->questions()
                ->selectRaw('question_type, COUNT(*) as count')
                ->groupBy('question_type')
                ->pluck('count', 'question_type')
                ->toArray(),
        ];
        $resultStats = [
            'total_attempts' => $exam->results()->count(),
            'passed' => $exam->results()->where('total', '>=', $exam->pass_score)->count(),
            'failed' => $exam->results()->where('total', '<', $exam->pass_score)->count(),
            'average_score' => $exam->results()->avg('total') ?? 0,
        ];
        return view('dashboard.exams.show', compact('exam', 'questionStats', 'resultStats'));
    }

    /**
     * Show edit form.
     */
    public function edit(Exam $exam): View
    {
        $lectures = Lecture::all();
        return view('dashboard.exams.edit', compact('exam', 'lectures'));
    }

    /**
     * Update exam.
     */
    public function update(UpdateExamRequest $request, Exam $exam): RedirectResponse
    {
        $exam->update($request->validated());
        return redirect()
            ->route('dashboard.exams.show', $exam)
            ->with('success', 'تم تحديث الامتحان بنجاح');
    }

    /**
     * Delete exam.
     */
    public function destroy(Exam $exam): RedirectResponse
    {
        $exam->delete();
        return redirect()
            ->route('dashboard.exams.index')
            ->with('success', 'تم حذف الامتحان بنجاح');
    }

    /**
     * List questions for exam.
     */
    public function questions(Exam $exam): View
    {
        $questions = $exam->questions()->orderBy('created_at')->paginate(20);
        return view('dashboard.exams.questions', compact('exam', 'questions'));
    }

    /**
     * Show create question form.
     */
    public function createQuestion(Exam $exam): View
    {
        return view('dashboard.exams.create-question', compact('exam'));
    }

    /**
     * Store question and update exam totals.
     */
    public function storeQuestion(StoreExamQuestionRequest $request, Exam $exam): RedirectResponse
    {
        $validated = $request->validated();
        if ($request->hasFile('question_image')) {
            $validated['question_image'] = $request->file('question_image')->store('questions', 'public');
        }
        $validated['mark'] = $validated['points'];
        unset($validated['points']);
        $exam->questions()->create($validated);
        $this->examService->updateExamTotals($exam);
        return redirect()
            ->route('dashboard.exams.questions', $exam)
            ->with('success', 'تم إضافة السؤال بنجاح');
    }

    /**
     * Delete question and update exam totals.
     */
    public function destroyQuestion(Question $question): RedirectResponse
    {
        $exam = $question->exam;
        $question->delete();
        $this->examService->updateExamTotals($exam);
        return redirect()
            ->route('dashboard.exams.questions', $exam)
            ->with('success', 'تم حذف السؤال بنجاح');
    }

    /**
     * Exam statistics view.
     */
    public function statistics(Exam $exam): View
    {
        $exam->load(['questions', 'results']);
        $questionStats = $exam->questions()
            ->selectRaw('question_type, COUNT(*) as count, AVG(mark) as avg_points')
            ->groupBy('question_type')
            ->get();
        $scoreDistribution = $exam->results()
            ->selectRaw('
                CASE
                    WHEN total >= 90 THEN "90-100"
                    WHEN total >= 80 THEN "80-89"
                    WHEN total >= 70 THEN "70-79"
                    WHEN total >= 60 THEN "60-69"
                    ELSE "0-59"
                END as range,
                COUNT(*) as count
            ')
            ->groupBy('range')
            ->orderBy('range', 'desc')
            ->get();
        return view('dashboard.exams.statistics', compact('exam', 'questionStats', 'scoreDistribution'));
    }

    /**
     * Toggle exam active status.
     */
    public function toggleStatus(Exam $exam): RedirectResponse
    {
        $exam->update(['is_active' => !$exam->is_active]);
        $status = $exam->is_active ? 'تم تفعيل' : 'تم إلغاء تفعيل';
        return redirect()
            ->route('dashboard.exams.show', $exam)
            ->with('success', $status . ' الامتحان بنجاح');
    }

    /**
     * Export exams CSV.
     */
    public function export(Request $request)
    {
        $exams = $this->examService->getExportData($request);
        $data = $exams->map(fn ($exam) => [
            'عنوان الامتحان' => $exam->title,
            'الوصف' => $exam->description,
            'المحاضرة' => $exam->lecture->title ?? 'بدون محاضرة',
            'عدد الأسئلة' => $exam->questions_count,
            'عدد المحاولات' => $exam->results_count,
            'الحالة' => $exam->is_active ? 'نشط' : 'غير نشط',
            'تاريخ الإنشاء' => $exam->created_at->format('Y-m-d H:i'),
        ]);
        $filename = 'الامتحانات_' . now()->format('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            if ($data->count() > 0) {
                fputcsv($file, array_keys($data->first()));
            }
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Duplicate exam and its questions.
     */
    public function duplicate(Exam $exam): RedirectResponse
    {
        $newExam = $this->examService->duplicateExam($exam);
        $this->examService->updateExamTotals($newExam);
        return redirect()
            ->route('dashboard.exams.show', $newExam)
            ->with('success', 'تم نسخ الامتحان بنجاح');
    }
}
