<?php

namespace App\Repositories;


use App\Models\User;
use App\Repositories\Interfaces\UserInterface;

class UserRepository implements UserInterface {

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function store($userData)
    {
        return $this->model->create($userData);
    }
    public function usersWithCountedTweets()
    {

        return $this->model->withCount('tweets')->get();
    }

    public function totalUsers()
    {
        return $this->model->count();
    }
}
