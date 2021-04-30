<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Http\Resources\API\V1\TweetResource;
use App\Services\TweetService;
use Exception;

class TweetsController extends Controller
{
    protected $tweetService;

    public function __construct(TweetService $tweetService)
    {
        $this->tweetService = $tweetService;
    }

    public function store(TweetRequest $request)
    {
        try {

            $tweet = $this->tweetService->createTweet($request->validated());

            return new TweetResource($tweet);

        }catch (Exception $exception) {

            return response()->json(['error' => 'something went wrong'], 400 );
        }

    }
}
