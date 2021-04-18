<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Http\Resources\TweetResource;
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

            return response()->json(['error' => $exception->getMessage()], 500 );
        }

    }
}
