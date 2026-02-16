<?php

namespace App\Http\Controllers;

use App\Services\LectureOpenService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Opens lecture/course content for authenticated users.
 * Delegates access and data to LectureOpenService.
 */
class LectureOpenController extends Controller
{
    public function __construct(
        protected LectureOpenService $lectureOpenService
    ) {}

    /**
     * Open single lecture/course view.
     */
    public function OpenOne(int $std, int $lec, int $link): View|RedirectResponse
    {
        $result = $this->lectureOpenService->openOne($std, $lec, $link);
        if ($result === null) {
            return redirect()->route('index');
        }
        return view($result['view'], $result['data']);
    }

    /**
     * Show monthly subscription lectures.
     */
    public function ShowMonthly(int $std, int $mon, int $id): View|RedirectResponse
    {
        $result = $this->lectureOpenService->showMonthly($std, $mon, $id);
        if ($result === null) {
            return redirect()->route('index');
        }
        return view($result['view'], $result['data']);
    }

    /**
     * Show termly subscription lectures (route name: ShowTermely).
     */
    public function ShowTermely(int $std, int $ter, int $id): View|RedirectResponse
    {
        $result = $this->lectureOpenService->showTermly($std, $ter, $id);
        if ($result === null) {
            return redirect()->route('index');
        }
        return view($result['view'], $result['data']);
    }
}
