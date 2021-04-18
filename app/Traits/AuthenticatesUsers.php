<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

trait AuthenticatesUsers {

    use \Illuminate\Foundation\Auth\AuthenticatesUsers;

    public function login($request)
    {

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


        if ($token = JWTAuth::attempt($request->validated())) {

            $this->clearLoginAttempts($request);

            return $token;
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            'throttle' => [Lang::get('auth.throttle', ['minutes' => ceil($seconds / 60)])],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }

    public function maxAttempts()
    {
        return 5;
    }

    public function decayMinutes()
    {
        return 30;
    }
}
