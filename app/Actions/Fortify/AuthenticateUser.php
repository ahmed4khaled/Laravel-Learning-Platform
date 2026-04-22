<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticateUser
{
    public function __invoke(Request $request): ?User
    {
        $login = $request->input('email', $request->input('Phone'));
        $password = (string) $request->input('password', '');

        if ($login === null || $login === '') {
            return null;
        }

        $user = User::query()
            ->where('email', $login)
            ->orWhere('Phone', $login)
            ->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        return $user;
    }
}
