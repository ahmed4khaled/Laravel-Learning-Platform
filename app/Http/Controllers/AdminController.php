<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Admin dashboard: users, QR codes, lectures, sales.
 * Delegates business logic to AdminService.
 */
class AdminController extends Controller
{
    public function __construct(
        protected AdminService $adminService
    ) {}

    /**
     * Legacy dashboard fetch (route: two).
     */
    public function Fetch(): View|RedirectResponse
    {
        return $this->Fetchstd('1', 'Center');
    }

    /**
     * Dashboard by grade and state filter.
     */
    public function Fetchstd(string $id, string $state): View|RedirectResponse
    {
        $gradeId = (int) $id;
        $result = $this->adminService->getDashboardData($gradeId, $state);
        return view($result['view'], $result['data']);
    }

    /**
     * Create QR codes (legacy method name for route).
     */
    public function Create(Request $request): void
    {
        $input = $request->only(['RoleQR', 'qr', 'std', 'cop', 'dis']);
        $result = $this->adminService->createQrCodes($input);
        foreach ($result['codes'] as $pass) {
            echo $pass . '<br>';
        }
    }

    /**
     * Search QR by coupon (legacy method name for route).
     */
    public function Result(Request $request): View
    {
        $data = $this->adminService->searchQrByCoupon(
            $request->input('cobon', ''),
            $request->input('value', ''),
            $request->input('role', '')
        );
        return view('Qr', ['Data' => $data]);
    }

    /**
     * Search QR by code (legacy method name for route).
     */
    public function Result_b(Request $request): View
    {
        $data = $this->adminService->searchQrByCode($request->input('QR_search', ''));
        return view('Qr', ['Dataa' => $data, 'user' => \App\Models\User::all()]);
    }

    /**
     * Search users by phone (legacy method name for route).
     */
    public function sea(Request $request): View
    {
        $userSearch = $this->adminService->searchUsersByPhone($request->input('sea', ''));
        return view('Qr', ['Dataaa' => $userSearch]);
    }

    /**
     * Search user by ID (legacy method name for route).
     */
    public function sea_id(Request $request): View
    {
        $userSearch = $this->adminService->searchUserById((int) $request->input('sea_id', 0));
        return view('Qr', ['Dataaa' => $userSearch]);
    }

    /**
     * Create one lecture (legacy method name for route).
     */
    public function createone(Request $request): RedirectResponse
    {
        $input = $request->only([
            'Num', 'name', 'std', 'title', 'des', 'RoleQR', 'Monthly', 'subname', 'link',
            'Time', 'price', 'exam',
        ]);
        $input['img_file'] = $request->file('img');
        $this->adminService->createLecture($input);
        return redirect()->back();
    }

    /**
     * Update user (legacy method name for route).
     */
    public function edit(string $id): RedirectResponse
    {
        $this->adminService->updateUser((int) $id, request()->only(['Name', 'Phone', 'Phone_par', 'pass']));
        return redirect()->back();
    }

    /**
     * Show lectures for admin by grade and role (legacy method name for route).
     */
    public function Show(string $id, string $Role): View|RedirectResponse
    {
        $result = $this->adminService->getLecturesForAdmin((int) $id, $Role);
        return view('lec', $result);
    }

    /**
     * Edit lecture form (legacy method name for route).
     */
    public function edit_lec(string $std, string $id): View
    {
        $lecture = $this->adminService->getLectureForEdit((int) $std, (int) $id);
        return view('Edit_lec', ['lec' => $lecture, 'std' => (int) $std]);
    }

    /**
     * Update lecture (legacy method name for route).
     */
    public function edit1(string $std, string $id): RedirectResponse
    {
        $this->adminService->updateLecture((int) $std, (int) $id, request()->only(['Name', 'File', 'Time', 'Month', 'name0', 'link0']));
        return redirect()->back();
    }

    /**
     * QR codes for user (legacy method name for route).
     */
    public function Qrs_user(string $id): View
    {
        $data = $this->adminService->getQrCodesForUser((int) $id);
        return view('qrs', $data);
    }

    /**
     * Sales (lectures) for user (legacy method name for route).
     */
    public function Lec_user(string $id): View
    {
        $data = $this->adminService->getSalesForUser((int) $id);
        return view('lecs', $data);
    }
}
