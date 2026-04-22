<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'Phone' => ['nullable', 'string', 'max:255', 'unique:users,Phone'],
            'Phone_par' => ['nullable', 'string', 'max:255'],
            'class' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:255'],
            'school' => ['nullable', 'string', 'max:255'],
            'numnational' => ['nullable', 'string', 'max:255', 'unique:users,numnational'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $phone = isset($input['Phone']) && $input['Phone'] !== ''
            ? preg_replace('/\D/', '', $input['Phone'])
            : null;

        $parentPhone = isset($input['Phone_par']) && $input['Phone_par'] !== ''
            ? preg_replace('/\D/', '', $input['Phone_par'])
            : null;

        $user = User::create([
            'name' => strip_tags(trim($input['name'])),
            'email' => $input['email'] ?? $phone,
            'Phone' => $phone,
            'Phone_par' => $parentPhone,
            'type' => $input['type'] ?? 'Center',
            'class' => $input['class'] ?? 'grade3',
            'school' => $input['school'] ?? null,
            'numnational' => $input['numnational'] ?? null,
            'password' => Hash::make($input['password']),
        ]);

        $user->devices()->create([
            'user_id' => $user->id,
            'token' => Str::random(40),
            'device_token' => $input['device_token'] ?? null,
            'phone' => $phone,
            'ip_address' => $input['ip_address'] ?? request()->ip(),
            'user_agent' => $input['user_agent'] ?? request()->userAgent(),
            'last_activity' => now(),
            'screen_width' => isset($input['screen_width']) ? (int) $input['screen_width'] : null,
            'screen_height' => isset($input['screen_height']) ? (int) $input['screen_height'] : null,
        ]);

        return $user;
    }
}
