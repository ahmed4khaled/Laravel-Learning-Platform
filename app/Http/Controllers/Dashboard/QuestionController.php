<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionImportRequest;
use App\Http\Requests\QuestionReorderRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Exam;
use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Question CRUD, import/export, reorder, toggle status.
 * Thin controller: request → QuestionService / Exam → response.
 */
class QuestionController extends Controller
{
    public function __construct(
        protected QuestionService $questionService
    ) {}

    /**
     * List questions with filters.
     */
    public function index(Request $request): View
    {
        $query = Question::with(['exam']);
        if ($request->filled('search')) {
            $query->where('question', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('question_type')) {
            $query->where('question_type', $request->question_type);
        }
        if ($request->filled('exam_id')) {
            $query->where('exam_id', $request->exam_id);
        }
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }
        $questions = $query->latest()->paginate(20);
        $exams = Exam::all();
        return view('dashboard.questions.index', compact('questions', 'exams'));
    }

    /**
     * Show create form.
     */
    public function create(): View
    {
        $exam = request()->route('exam');
        return view('dashboard.questions.create', compact('exam'));
    }

    /**
     * Store question and update exam totals.
     */
    public function store(StoreQuestionRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('questions', 'public');
        }
        $validated['mark'] = $validated['points'];
        unset($validated['points']);
        $exam = Exam::findOrFail($request->exam_id);
        $exam->questions()->create($validated);
        $this->questionService->updateExamTotals($exam);
        return redirect()
            ->route('dashboard.exams.questions', $exam)
            ->with('success', 'تم إضافة السؤال بنجاح');
    }

    /**
     * Show question details.
     */
    public function show(Question $question): View
    {
        $question->load('exam');
        return view('dashboard.questions.show', compact('question'));
    }

    /**
     * Show edit form.
     */
    public function edit(Question $question): View
    {
        return view('dashboard.questions.edit', compact('question'));
    }

    /**
     * Update question and exam totals.
     */
    public function update(UpdateQuestionRequest $request, Question $question): RedirectResponse
    {
        $validated = $request->validated();
        $validated['mark'] = $validated['points'];
        unset($validated['points']);
        $question->update($validated);
        $this->questionService->updateExamTotals($question->exam);
        return redirect()
            ->route('dashboard.exams.questions', $question->exam)
            ->with('success', 'تم تحديث السؤال بنجاح');
    }

    /**
     * Delete question and update exam totals.
     */
    public function destroy(Question $question): RedirectResponse
    {
        $exam = $question->exam;
        $question->delete();
        $this->questionService->updateExamTotals($exam);
        return redirect()
            ->route('dashboard.exams.questions', $exam)
            ->with('success', 'تم حذف السؤال بنجاح');
    }

    /**
     * Toggle question active status.
     */
    public function toggleStatus(Question $question): RedirectResponse
    {
        $question->update(['is_active' => !$question->is_active]);
        $this->questionService->updateExamTotals($question->exam);
        $status = $question->is_active ? 'تم تفعيل' : 'تم إلغاء تفعيل';
        return redirect()
            ->route('dashboard.exams.questions', $question->exam)
            ->with('success', $status . ' السؤال بنجاح');
    }

    /**
     * Import questions from CSV.
     */
    public function import(QuestionImportRequest $request, Exam $exam): RedirectResponse
    {
        $path = $request->file('csv_file')->getRealPath();
        $questions = $this->questionService->parseImportCsv($path, $exam->id);
        foreach ($questions as $row) {
            $exam->questions()->create($row);
        }
        $this->questionService->updateExamTotals($exam);
        return redirect()
            ->route('dashboard.exams.questions', $exam)
            ->with('success', 'تم استيراد ' . count($questions) . ' سؤال بنجاح');
    }

    /**
     * Export questions CSV.
     */
    public function export(Exam $exam)
    {
        $questions = $exam->questions()->get();
        $data = $questions->map(fn ($q) => [
            'السؤال' => $q->question,
            'نوع السؤال' => $q->question_type,
            'الخيار أ' => $q->option_a,
            'الخيار ب' => $q->option_b,
            'الخيار ج' => $q->option_c,
            'الخيار د' => $q->option_d,
            'الإجابة الصحيحة' => $q->correct_option,
            'النقاط' => $q->mark,
            'التوضيح' => $q->explanation,
            'الحالة' => $q->is_active ? 'نشط' : 'غير نشط',
        ]);
        $filename = 'أسئلة_' . $exam->title . '_' . now()->format('Y-m-d') . '.csv';
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
     * Duplicate question.
     */
    public function duplicate(Question $question): RedirectResponse
    {
        $newQuestion = $question->replicate();
        $newQuestion->question = $question->question . ' (نسخة)';
        $newQuestion->save();
        return redirect()
            ->route('dashboard.exams.questions', $question->exam)
            ->with('success', 'تم نسخ السؤال بنجاح');
    }

    /**
     * Reorder questions.
     */
    public function reorder(QuestionReorderRequest $request, Exam $exam): \Illuminate\Http\JsonResponse
    {
        foreach ($request->questions as $index => $questionId) {
            Question::where('id', $questionId)->update(['order' => $index + 1]);
        }
        return response()->json(['success' => true]);
    }
}
