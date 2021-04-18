<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowRequest;
use App\Http\Resources\FollowResource;
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

        } catch (ValidationException $exception) {

            return response()->json(['error' => $exception->errors()], 422 );

        } catch (Exception $exception) {

            return response()->json(['error' => $exception->getMessage()], 500 );
        }
    }
}
