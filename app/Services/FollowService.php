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

        if($this->exists($followData)) {

            throw ValidationException::withMessages([
                'message' => 'You Already Following This User'
            ]);

        }

        $followData['user_id'] = auth()->id();

        return $this->followRepository->store($followData);


    }

    public function exists($followData)
    {
        return $this->followRepository->exist($followData['following_user_id'], auth()->id());
    }
}
