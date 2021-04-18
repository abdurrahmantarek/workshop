<?php

namespace App\Repositories;


use App\Models\Follow;
use App\Repositories\Interfaces\FollowInterface;

class FollowRepository implements FollowInterface {

    protected $model;

    public function __construct(Follow $model)
    {
        $this->model = $model;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function exist($followingUserId, $userId)
    {
        return $this->model->where('user_id', $userId)->where('following_user_id', $followingUserId)->exists();
    }
}
