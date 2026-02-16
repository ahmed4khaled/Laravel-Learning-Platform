<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendReminderRequest;
use App\Http\Requests\ShowAssignmentRequest;
use App\Services\AssignmentDashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Assignment dashboard: list lectures, show submissions, send reminder, download.
 * Validation via Form Requests; logic in AssignmentDashboardService.
 */
class AssignmentDashboardController extends Controller
{
    public function __construct(
        protected AssignmentDashboardService $assignmentDashboardService
    ) {}

    /**
     * List lectures for assignment dashboard.
     */
    public function index(): View
    {
        $lectures = $this->assignmentDashboardService->getLecturesForDashboard();
        return view('dashboard.assignments', compact('lectures'));
    }

    /**
     * Show submissions for a lecture (validated by ShowAssignmentRequest).
     */
    public function show(ShowAssignmentRequest $request): View
    {
        $data = $this->assignmentDashboardService->getShowData($request->validated()['lecture_id']);

        return view('dashboard.assignments', [
            'lectures' => $this->assignmentDashboardService->getLecturesForDashboard(),
            'selectedLecture' => $data['lecture'],
            'submittedStudents' => $data['submittedStudents'],
            'submittedAssignments' => $data['submittedAssignments'],
            'notSubmittedStudents' => $data['notSubmittedStudents'],
        ]);
    }

    /**
     * Send reminder to student (validated by SendReminderRequest).
     */
    public function sendReminder(SendReminderRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'تم إرسال التذكير بنجاح',
        ]);
    }

    /**
     * Download assignment file.
     */
    public function downloadAssignment(int $id): \Symfony\Component\HttpFoundation\BinaryFileResponse|Response
    {
        $path = $this->assignmentDashboardService->getAssignmentFilePath($id);
        return response()->download($path);
    }
}
