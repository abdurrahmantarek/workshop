<?php

namespace App\Services;

use App\Http\Requests\FollowRequest;
use App\Repositories\FollowRepository;
use App\Repositories\Interfaces\FollowInterface;
use Illuminate\Validation\ValidationException;

class FollowService{

    protected $followRepository;

    public function __construct(FollowInterface $followRepository)
    {
        $this->followRepository = $followRepository;
    }

    public function followAnotherUser($followData)
    {
        $followData['user_id'] = auth()->id();

        return $this->followRepository->store($followData);


    }
}
