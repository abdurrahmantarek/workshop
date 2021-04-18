<?php

namespace App\Repositories\Interfaces;


interface TweetInterface {

    public function store($data);

    public function totalTweets();
}
