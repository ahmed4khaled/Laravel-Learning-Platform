<?php

namespace App\Services;

use App\Models\Lecture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Handles opening and authorizing lecture/course content for authenticated users.
 */
class LectureOpenService
{
    /**
     * Get single lecture access and exam result for course view.
     *
     * @return array{view: string, data: array}|null Null when unauthorized.
     */
    public function openOne(int $std, int $lecId, int $link): ?array
    {
        $lecture = Lecture::where('id', $lecId)->where('grade', $std)->first();
        if (!$lecture) {
            return null;
        }

        $examId = $lecture->exam_id;
        $grade = $lecture->grade;

        $resultExam = DB::table('exam_results')
            ->where('user_id', Auth::id())
            ->where('exam_id', $examId)
            ->where('passed', 1)
            ->first();

        $hasAccess = DB::table('sells')
            ->where('user_id', Auth::id())
            ->where('id_lec', $lecture->id)
            ->where('std', $grade)
            ->exists();

        if (!$hasAccess && $lecture->price != 0) {
            return null;
        }

        return [
            'view' => 'course.1',
            'data' => [
                'info' => $lecture,
                'std' => $grade,
                'lec' => $lecId,
                'num' => $link,
                'result_exam' => $resultExam,
            ],
        ];
    }

    /**
     * Get monthly subscription lectures if user has access.
     *
     * @return array{view: string, data: array}|null
     */
    public function showMonthly(int $std, int $mon, int $lectureId): ?array
    {
        $lectureRole = Lecture::where('id', $lectureId)->where('grade', $std)->first();
        if (!$lectureRole) {
            return null;
        }

        $hasAccess = DB::table('sells')
            ->where('user_id', Auth::id())
            ->where('id_lec', $lectureRole->id)
            ->exists();

        if (!$hasAccess) {
            return null;
        }

        $lectures = Lecture::where('monthly', $mon)
            ->where('grade', $std)
            ->where('role', 1)
            ->get();

        return [
            'view' => 'Lec.4',
            'data' => ['Lec1' => $lectures, 'std' => $std],
        ];
    }

    /**
     * Get termly subscription lectures if user has access.
     *
     * @return array{view: string, data: array}|null
     */
    public function showTermly(int $std, int $ter, int $lectureId): ?array
    {
        $lectureRole = Lecture::where('id', $lectureId)->where('grade', $std)->first();
        if (!$lectureRole) {
            return null;
        }

        $hasAccess = DB::table('sells')
            ->where('user_id', Auth::id())
            ->where('id_lec', $lectureRole->id)
            ->exists();

        if (!$hasAccess) {
            return null;
        }

        $lectures = Lecture::where('termely', $ter)
            ->where('grade', $std)
            ->where('role', 1)
            ->get();

        return [
            'view' => 'Lec.4',
            'data' => ['Lec1' => $lectures, 'std' => $std],
        ];
    }
}
