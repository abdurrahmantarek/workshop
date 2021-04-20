<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Exception;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(UserLoginRequest $request)
    {

        if($userToken =  $this->authService->login($request->validated())) {

            return response()->json([
                'data' => UserResource::make(auth()->user()),
                'token' => $userToken,
            ]);

        } else {

            return response()->json(['error' => [trans('auth.failed')]], 422);
        }
    }

    public function register(UserRegisterRequest $request)
    {

        try {

            $user = $this->authService->register($request->validated());

            return UserResource::make($user);

        }catch (Exception $exception) {

            return response()->json(['error' => $exception->getMessage()], 500 );

        }

    }
}
