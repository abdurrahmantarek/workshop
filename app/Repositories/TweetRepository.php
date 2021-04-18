<?php

namespace App\Repositories;


use App\Models\Tweet;
use App\Repositories\Interfaces\TweetInterface;

class TweetRepository implements TweetInterface {


    protected $model;

    public function __construct(Tweet $tweet)
    {
        $this->model = $tweet;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function totalTweets()
    {
        return $this->model->count();
    }
}
