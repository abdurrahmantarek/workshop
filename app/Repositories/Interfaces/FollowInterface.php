<?php

namespace App\Repositories\Interfaces;


interface FollowInterface {

    public function store($data);

    public function exist($followingUserId, $userId);

}
