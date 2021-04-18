<?php

namespace App\Services;


use App\Traits\AuthenticatesUsers;

class AuthService{

    use AuthenticatesUsers {

        AuthenticatesUsers::login AS jwtLogin;
    }

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

    }

    public function login($request)
    {

        return $this->jwtLogin($request);
    }

    public function register($userData)
    {
        return $this->userService->create($userData);
    }

}
