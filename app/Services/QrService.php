<?php

namespace App\Services;

use App\Models\Lecture;
use App\Models\QrCode;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Handles QR code validation and lecture purchase (redemption) logic.
 */
class QrService
{
    /**
     * Validate QR code, create sale record, and mark QR as used.
     * Returns redirect on success or back with 'no' message on validation failure.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function checkAndRedeem(array $validated)
    {
        return DB::transaction(function () use ($validated) {
            $qrCode = QrCode::where('qr', $validated['Buy'])
                ->lockForUpdate()
                ->first();

            if (!$qrCode) {
                return back()->with('no', $validated['id_lec']);
            }

            if ($qrCode->value !== '0' && $qrCode->value !== null) {
                return back()->with('no', $validated['id_lec']);
            }

            if ($qrCode->role != $validated['role_lec'] || $qrCode->std != $validated['lec_std']) {
                return back()->with('no', $validated['id_lec']);
            }

            Lecture::where('id', $validated['id_lec'])->increment('selling');

            $sellData = [
                'user_id' => Auth::id(),
                'phone' => Auth::user()->Phone,
                'state' => 1,
                'Name' => $this->resolveName($validated),
                'id_lec' => $validated['id_lec'],
                'std' => $validated['lec_std'],
                'date_exp' => $validated['date_exp'],
                'role_lec' => $validated['role_lec'],
                'monthly' => $validated['monthly_lec'] ?? null,
                'termely' => $validated['termely_lec'] ?? null,
            ];

            Sale::create($sellData);
            $qrCode->update([
                'value' => $validated['id_lec'],
                'user_id' => Auth::id(),
                'used' => now(),
                'Lecname' => $validated['name_lec'],
                'phone' => Auth::user()->Phone,
            ]);

            return $this->successRedirect(
                $validated['role_lec'],
                $validated['lec_std'],
                $validated['id_lec'],
                $validated['monthly_lec'] ?? null,
                $validated['termely_lec'] ?? null
            );
        });
    }

    /**
     * Resolve display name for sale based on role.
     */
    public function resolveName(array $validated): string
    {
        return match ((int) $validated['role_lec']) {
            4 => 'اشتراك شهري - ' . ($validated['monthly_lec'] ?? ''),
            8 => 'اشتراك ترمي - ' . ($validated['termely_lec'] ?? ''),
            default => $validated['name_lec'],
        };
    }

    /**
     * Build success redirect by role and params.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function successRedirect($role, $std, $lecId, $monthly, $termely)
    {
        $routes = [
            1 => ['route' => 'course.1', 'params' => [$std, $lecId, 0]],
            3 => ['route' => 'course.1', 'params' => [$std, $lecId, 0]],
            4 => ['route' => 'course.4', 'params' => [$std, $monthly, $lecId]],
            8 => ['route' => 'course.8', 'params' => [$std, $termely, $lecId]],
            10 => ['route' => 'course.1', 'params' => [$std, $lecId, 0]],
        ];

        if (!array_key_exists((int) $role, $routes)) {
            return response()->json([
                'success' => false,
                'message' => 'نوع المحاضرة غير معروف',
            ], 422);
        }

        $config = $routes[(int) $role];
        return redirect()->route($config['route'], $config['params']);
    }
}
