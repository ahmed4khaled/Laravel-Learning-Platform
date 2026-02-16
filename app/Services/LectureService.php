<?php

namespace App\Services;

use App\Models\Lecture;

/**
 * Handles public lecture listing by grade and role (no auth admin logic).
 */
class LectureService
{
    /**
     * Get lectures for public view by grade and role.
     *
     * @return array{Lec1: \Illuminate\Support\Collection, std: int}|null Null if role not supported.
     */
    public function getLecturesByGradeAndRole(int $gradeId, string $role): ?array
    {
        $supportedRoles = ['1', '4', '8', '10'];
        if (!in_array($role, $supportedRoles)) {
            return null;
        }

        $lectures = Lecture::where('role', $role)->where('grade', $gradeId)->get();

        return [
            'Lec1' => $lectures,
            'std' => $gradeId,
        ];
    }
}
