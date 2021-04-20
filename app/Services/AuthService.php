<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

    }

    public function login($userData)
    {
         return JWTAuth::attempt($userData);
    }

    public function register($userData)
    {
        return $this->userService->create($userData);
    }

}
