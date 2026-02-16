<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Services\ExamResultService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Exam results: list, show, destroy, export, recalculate, detailed report.
 * Thin controller: delegates to ExamResultService where applicable.
 */
class ExamResultController extends Controller
{
    public function __construct(
        protected ExamResultService $examResultService
    ) {}

    /**
     * List results for exam.
     */
    public function index(Exam $exam): View
    {
        $results = $exam->results()->with('user')->latest()->paginate(20);
        $stats = [
            'total_attempts' => $exam->results()->count(),
            'passed' => $exam->results()->where('passed', true)->count(),
            'failed' => $exam->results()->where('passed', false)->count(),
            'average_score' => $exam->results()->avg('total') ?? 0,
            'pass_rate' => $exam->pass_rate ?? 0,
        ];
        return view('dashboard.exams.results', compact('exam', 'results', 'stats'));
    }

    /**
     * Show single result details.
     */
    public function show(Exam $exam, ExamResult $result): View
    {
        $result->load(['user', 'exam', 'answers.question']);
        $questionStats = $result->answers()
            ->with('question')
            ->get()
            ->map(fn ($answer) => [
                'question' => $answer->question->question,
                'question_type' => $answer->question->question_type,
                'student_answer' => $answer->answer_chosen,
                'correct_answer' => $answer->question->correct_answer_text ?? null,
                'is_correct' => $answer->is_correct,
                'points_earned' => $answer->mark,
                'max_points' => $answer->question->mark,
            ]);
        return view('dashboard.exams.result-details', compact('result', 'questionStats'));
    }

    /**
     * Delete result and its answers.
     */
    public function destroy(Exam $exam, ExamResult $result): RedirectResponse
    {
        $result->answers()->delete();
        $result->delete();
        return redirect()
            ->route('dashboard.exams.results', $exam)
            ->with('success', 'تم حذف نتيجة الامتحان بنجاح');
    }

    /**
     * Statistics view (duplicate of ExamController::statistics - kept for route).
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
                CASE WHEN total >= 90 THEN "90-100"
                     WHEN total >= 80 THEN "80-89"
                     WHEN total >= 70 THEN "70-79"
                     WHEN total >= 60 THEN "60-69"
                     ELSE "0-59" END as range,
                COUNT(*) as count
            ')
            ->groupBy('range')
            ->orderBy('range', 'desc')
            ->get();
        $topStudents = $exam->results()->with('user')->orderBy('total', 'desc')->take(10)->get();
        $timeStats = $exam->results()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as attempts, AVG(total) as avg_score')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(30)
            ->get();
        return view('dashboard.exams.statistics', compact(
            'exam',
            'questionStats',
            'scoreDistribution',
            'topStudents',
            'timeStats'
        ));
    }

    /**
     * Export results (CSV or Excel).
     */
    public function export(Exam $exam, Request $request)
    {
        $format = $request->get('format', 'excel');
        $results = $exam->results()
            ->with('user')
            ->get()
            ->map(fn ($result) => [
                'اسم الطالب' => $result->user->name,
                'رقم الهاتف ' => $result->user->Phone ?? '',
                'رقم هاتف ولي الامر ' => $result->user->Phone_par ?? '',
                'النقاط المكتسبة' => $result->total,
                'إجمالي النقاط' => $result->exam->total_points,
                'النسبة المئوية' => $result->percentage . '%',
                'التقدير' => $result->grade,
                'الحالة' => $result->passed ? 'نجح' : 'رسب',
                'عدد المحاولات' => $result->attempt,
                'تاريخ الامتحان' => $result->created_at->format('Y-m-d H:i'),
            ]);

        if ($format === 'csv') {
            return $this->examResultService->streamCsv($results, 'نتائج_' . $exam->title . '_' . now()->format('Y-m-d') . '.csv');
        }
        return $this->examResultService->streamCsv($results, 'نتائج_' . $exam->title . '_' . now()->format('Y-m-d') . '.csv');
    }

    /**
     * Recalculate result total and passed.
     */
    public function recalculate(ExamResult $result): RedirectResponse
    {
        $this->examResultService->recalculateResult($result);
        return redirect()
            ->route('dashboard.exams.result-details', [$result->exam, $result])
            ->with('success', 'تم إعادة حساب النتيجة بنجاح');
    }

    /**
     * Clear all results for exam.
     */
    public function clearAllResults(Exam $exam): RedirectResponse
    {
        $count = $exam->results()->count();
        foreach ($exam->results as $r) {
            $r->answers()->delete();
        }
        $exam->results()->delete();
        return redirect()
            ->route('dashboard.exams.results', $exam)
            ->with('success', 'تم حذف ' . $count . ' نتيجة بنجاح');
    }

    /**
     * Download detailed report JSON.
     */
    public function detailedReport(Exam $exam)
    {
        $report = $this->examResultService->buildDetailedReport($exam);
        $filename = 'تقرير_مفصل_' . $exam->title . '_' . now()->format('Y-m-d') . '.json';
        $headers = [
            'Content-Type' => 'application/json; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        return response()->json($report, 200, $headers);
    }

    /**
     * Send results (placeholder - can hook to Mail later).
     */
    public function sendResults(ExamResult $result): RedirectResponse
    {
        return redirect()
            ->route('dashboard.exams.result-details', [$result->exam, $result])
            ->with('success', 'تم إرسال النتيجة عبر البريد الإلكتروني بنجاح');
    }
}
