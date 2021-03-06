<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowRequest;
use App\Http\Resources\API\V1\FollowResource;
use App\Services\FollowService;
use Exception;
use Illuminate\Validation\ValidationException;

class FollowsController extends Controller
{
    protected $followService;

    public function __construct(FollowService $followService)
    {
        $this->followService = $followService;
    }

    public function store(FollowRequest  $request)
    {

        try {

            $follow = $this->followService->followAnotherUser($request->validated());

            return new FollowResource($follow);

        } catch (Exception $exception) {

            return response()->json(['error' => 'something went wrong'], 400 );
        }
    }
}
