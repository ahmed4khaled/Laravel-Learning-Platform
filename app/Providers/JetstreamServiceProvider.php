<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter as GlobalRateLimiter;
use App\Models\user_session;
use Illuminate\Validation\ValidationException;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        // 👇 إضافة الـ rate limiting لتسجيل الدخول
        GlobalRateLimiter::for('login', function (Request $request) {
            $emailOrPhone = (string) $request->input('Phone');
            return Limit::perMinute(5)->by($emailOrPhone . $request->ip());
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('phone', $request->input('Phone'))->first();

            if (! $user || ! Hash::check($request->input('password'), $user->password)) {
                // فشل تسجيل الدخول
                return null;
            }

            // بيانات الجهاز
            $deviceToken  = (string) $request->input('device_token');
            $screenWidth  = (int) $request->input('screen_width');
            $screenHeight = (int) $request->input('screen_height');

            $session = user_session::firstOrNew(['user_id' => $user->id]);

            if (! $session->exists) {
                // أول تسجيل دخول - إنشاء جلسة جديدة
                $session->fill([
                    'device_token'  => $deviceToken ?: bin2hex(random_bytes(16)),
                    'screen_width'  => $screenWidth ?: 0,
                    'screen_height' => $screenHeight ?: 0,
                    'phone'         => $request->input('Phone'),
                ]);
                $session->save();
            } else {
                // تحقق من التوافق
                $mismatch =
                    ($session->device_token && $deviceToken && $session->device_token !== $deviceToken) ||
                    ($session->screen_width && $screenWidth && (int) $session->screen_width !== $screenWidth) ||
                    ($session->screen_height && $screenHeight && (int) $session->screen_height !== $screenHeight);

                if ($mismatch) {
                    throw ValidationException::withMessages([
                        Fortify::username() => 'هذا الجهاز غير مسموح به لهذا الحساب.',
                    ]);
                }
            }

            // تسجيل دخول ناجح
            return $user;
        });
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
