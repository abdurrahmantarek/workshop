<?php

namespace App\Services;

use App\Repositories\Interfaces\UserInterface;
use App\Repositories\UserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService{

    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function create($userData)
    {

        $image = $this->uploadUserImage($userData);

        $user = $this->userRepository->store(array_merge($userData, [
            'password' => bcrypt($userData['password']),
            'image' => $image
            ]));

        return $user;
    }

    private function uploadUserImage($userData)
    {

        $image = $userData['image'];

        return $image->store('images');
    }

}
