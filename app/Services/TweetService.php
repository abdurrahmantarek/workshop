<?php

namespace App\Services;

use App\Repositories\Interfaces\TweetInterface;
use App\Repositories\TweetRepository;

class TweetService {

    protected $tweetRepository;

    public function __construct(TweetInterface $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    public function createTweet($tweetData)
    {
        $tweetData = array_merge($tweetData, ['user_id' => auth()->id()]);

        return $this->tweetRepository->store($tweetData);
    }
}
