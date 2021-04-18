<?php

namespace Tests\Unit;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


class ExampleTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $user = User::factory()->create();
        $twitt = Tweet::factory()->create(['user_id'=>$user->id]);
        $this->assertInstanceOf(Tweet::class,$user->tweets->first());

    }
}
