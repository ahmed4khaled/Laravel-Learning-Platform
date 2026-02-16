<?php

namespace App\Http\Controllers;

use App\Services\LectureService;
use Illuminate\View\View;

/**
 * Public lecture listing by grade and role.
 * Delegates to LectureService.
 */
class LecturesController extends Controller
{
    public function __construct(
        protected LectureService $lectureService
    ) {}

    /**
     * Home / index.
     */
    public function index(): View
    {
        return view('index');
    }

    /**
     * Show role selection view (legacy method name for route).
     */
    public function ShowRole(string $std): View
    {
        return view('Lec.3', ['grade' => $std]);
    }

    /**
     * Show lectures by grade and role (legacy method name for route).
     */
    public function Show(string $id, string $Role): View
    {
        $result = $this->lectureService->getLecturesByGradeAndRole((int) $id, $Role);
        if ($result === null) {
            return view('Lec.1', ['Lec1' => collect(), 'std' => (int) $id]);
        }
        return view('Lec.1', $result);
    }
}
