<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssistantAnswerRequest;
use App\Services\AssistantQuestionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Assistant questions listing and answer submission.
 * Validation via Form Requests; logic in AssistantQuestionService.
 */
class AssistantQuestionsController extends Controller
{
    public function __construct(
        protected AssistantQuestionService $assistantQuestionService
    ) {}

    /**
     * List lectures and questions with filters.
     */
    public function index(\Illuminate\Http\Request $request): View
    {
        $filter = $request->input('filter', 'all');
        $grade = $request->input('grade', 'all');
        $selectedLectureId = $request->input('lecture_id');

        $data = $this->assistantQuestionService->getIndexData($filter, $grade, $selectedLectureId);

        return view('assistant', [
            'lectures' => $data['lectures'],
            'questions' => $data['questions'],
            'selectedLectureId' => $data['selectedLectureId'],
            'filter' => $data['filter'],
            'grades' => $data['grades'],
            'grade' => $data['grade'],
        ]);
    }

    /**
     * Store answer and mark question as answered.
     */
    public function storeAnswer(StoreAssistantAnswerRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('answers', 'public');
        }
        $this->assistantQuestionService->storeAnswer($validated, $imagePath);
        return back()->with('success', 'تم إضافة الإجابة بنجاح');
    }
}
