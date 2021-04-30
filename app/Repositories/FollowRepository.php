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

    public function isFollow($userId, $followingUserId)
    {
        return $this->model->whereUserId($userId)->whereFollowingUserId($followingUserId)->exists();
    }
}
