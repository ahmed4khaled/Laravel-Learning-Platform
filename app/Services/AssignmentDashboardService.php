<?php

namespace App\Services;

use App\Models\AssignmentSum;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Support\Collection;

/**
 * Handles assignment dashboard: listings, reminders, and file download.
 */
class AssignmentDashboardService
{
    /**
     * Get all lectures with role 1 for assignment dashboard.
     */
    public function getLecturesForDashboard(): Collection
    {
        return Lecture::where('role', 1)->get();
    }

    /**
     * Get assignment show data: submitted students and non-submitted students.
     *
     * @return array{lecture: \App\Models\Lecture, submittedAssignments: \Illuminate\Support\Collection, submittedStudents: \Illuminate\Support\Collection, notSubmittedStudents: \Illuminate\Support\Collection}
     */
    public function getShowData(int $lectureId): array
    {
        $lecture = Lecture::findOrFail($lectureId);

        $submittedAssignments = AssignmentSum::where('lecture_id', $lecture->id)
            ->with(['user' => fn ($q) => $q->where('role', 'std')])
            ->get();

        $submittedStudents = $submittedAssignments->map(fn ($a) => $a->user)->filter();
        $allStudents = User::where('role', 'std')->get();
        $notSubmittedStudents = $allStudents->diff($submittedStudents);

        return [
            'lecture' => $lecture,
            'submittedAssignments' => $submittedAssignments,
            'submittedStudents' => $submittedStudents,
            'notSubmittedStudents' => $notSubmittedStudents,
        ];
    }

    /**
     * Get file path for assignment download.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getAssignmentFilePath(int $assignmentId): string
    {
        $assignment = AssignmentSum::findOrFail($assignmentId);
        if (!$assignment->file_path) {
            abort(404, 'الملف غير موجود');
        }
        return storage_path('app/public/' . $assignment->file_path);
    }
}
