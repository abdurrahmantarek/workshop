<?php

namespace App\Services;

use App\Repositories\Interfaces\UserInterface;
use App\Repositories\UserRepository;
use App\Traits\ImageUploader;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService{

    use ImageUploader;

    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function create($userData)
    {

        $image = $this->save($userData['image']);

        $user = $this->userRepository->store(array_merge($userData, [
            'password' => Hash::make($userData['password']),
            'image' => $image
            ]));

        return $user;
    }

}
