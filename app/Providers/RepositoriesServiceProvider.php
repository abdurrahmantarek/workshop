<?php

namespace App\Providers;

use App\Repositories\FollowRepository;
use App\Repositories\Interfaces\FollowInterface;
use App\Repositories\Interfaces\TweetInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\TweetRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FollowInterface::class, FollowRepository::class);
        $this->app->bind(TweetInterface::class, TweetRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
