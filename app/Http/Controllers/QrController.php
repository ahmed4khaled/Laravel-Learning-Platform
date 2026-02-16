<?php

namespace App\Http\Controllers;

use App\Http\Requests\QrCheckRequest;
use App\Services\QrService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

/**
 * QR code redemption (purchase) endpoint.
 * Validates via QrCheckRequest, delegates to QrService.
 */
class QrController extends Controller
{
    public function __construct(
        protected QrService $qrService
    ) {
        $this->middleware('auth');
    }

    /**
     * Validate QR and create sale; redirect on success or return error.
     */
    public function check(QrCheckRequest $request): RedirectResponse|JsonResponse
    {
        try {
            return $this->qrService->checkAndRedeem($request->validated());
        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ غير متوقع، حاول مرة أخرى.',
            ], 500);
        }
    }
}
