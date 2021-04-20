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

    public function exist($attributes)
    {
        return $this->model->whereUserId($attributes['user_id'])->whereFollowingUserId($attributes['following_user_id'])->exists();
    }
}
