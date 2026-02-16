<?php

namespace App\Actions\Fortify;

use App\Models\UserDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Models\User_session;

class AuthenticateUser
{
    public function __invoke(Request $request): LoginResponse
    {
        $credentials = $request->only('phone', 'password');

    

        $user = Auth::user();

        // بيانات الجهاز من الفورم (مرسلة بالـ JavaScript)
        $deviceToken  = $request->input('device_token');
        $screenWidth  = $request->input('screen_width');
        $screenHeight = $request->input('screen_height');

        $device = User_session::where('user_id', $user->id)->first();
        dd($device);

        if (!$device) {
            // أول تسجيل → نخزن الجهاز
            User_session::create([
                'user_id'       => $user->id,
                'device_token'  => $deviceToken ?: bin2hex(random_bytes(16)),
                'screen_width'  => $screenWidth ?: 0,
                'screen_height' => $screenHeight ?: 0,
            ]);
        } else {
            // تحقق من أن الجهاز نفس المسجل
            if (
                $device->device_token !== $deviceToken ||
                $device->screen_width != $screenWidth ||
                $device->screen_height != $screenHeight
            ) {
                Auth::logout();
                abort(403, 'هذا الجهاز غير مسموح به لهذا الحساب');
            }
        }

        return app(LoginResponse::class);
    }
}

