<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Log in
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        $user = User::query()->where('email', $data['email'])
            ->with('roles')
            ->first();

        if (!$user || !Hash::check($data['password'], $user->password))
            return error_out(['email' => 'Неверный электронный адрес или пароль']);
        if ($user->status !== User::STATUS_ACTIVE)
            return error_out(['email' => 'Пользователь блокирован']);

        $token = auth('api')->login($user);
        return $this->respondWithToken($token);
    }

    /**
     * Log out user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return success_out(['message' => 'Успешно!']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    /**
     * @param $token
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    protected function respondWithToken($token)
    {
        return success_out([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
