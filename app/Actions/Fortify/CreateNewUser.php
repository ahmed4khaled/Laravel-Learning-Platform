<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */public function create(array $input): User
{
    Validator::make($input, [
        'name'         => ['required', 'string', 'max:255'],
        'Phone'        => ['required', 'string', 'max:255', 'unique:users,phone'],
        'Phone_par'    => ['required', 'string', 'max:255'],
        'class'        => ['required', 'string', 'max:255'],
        'type'         => ['required', 'string', 'max:255'],
        'password'     => $this->passwordRules(),
        'terms'        => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
    ])->validate();

    // إنشاء المستخدم أولاً
    $user = User::create([
        'name'       => strip_tags(trim($input['name'])),
        'Phone'      => preg_replace('/\D/', '', $input['Phone']),
        'Phone_par'  => preg_replace('/\D/', '', $input['Phone_par']),
        'type'       => strip_tags(trim($input['type'])),
        'class'      => strip_tags(trim($input['class'])),
        'password'   => Hash::make($input['password']),
    ]);

    // تسجيل بيانات الجهاز
    $user->devices()->create([
        'user_id'       => $user->id,
        'device_token'  => isset($input['device_token']) ?$input['device_token'] : null ,
        'phone'      => preg_replace('/\D/', '', $input['Phone']),        
        'ip_address'    => $input['ip_address'] ?? request()->ip(),
        'user_agent'    => $input['user_agent'] ?? request()->userAgent(),
        'last_activity' => now(),
        'screen_width'  => isset($input['screen_width']) ? (int) $input['screen_width'] : null,
        'screen_height' => isset($input['screen_height']) ? (int) $input['screen_height'] : null,
    ]);
Auth::login($user); // يسجل الدخول تلقائيًا

    return $user;
}

}
