<?php

namespace Tests\Feature;

use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TweetServiceTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthenticatedUserCanPostATweet()
    {

        $user = User::factory()->create();

        $this->actingAs($user);

        $tweetRaw = Tweet::factory()->raw([
            'user_id' => $user->id
        ]);

        $response = $this->withoutExceptionHandling()
            ->withHeaders(['Accept' => 'application/json'])
            ->post('api/tweet', $tweetRaw);

        $tweetResource = TweetResource::make(Tweet::first())->response()->getData(true);

        $response->assertJson($tweetResource);
    }

    public function testUnAuthenticatedUserCantPostATweet()
    {

        $user = User::factory()->create();

        $tweetRaw = Tweet::factory()->raw([
            'user_id' => $user->id
        ]);

        $response = $this
            ->withHeaders(['Accept' => 'application/json'])
            ->post('api/tweet', $tweetRaw);
        $this->assertGuest();

        $response->assertStatus(401);

    }

    public function testUserCantPostAnEmptyTweet()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $tweetRaw = Tweet::factory()->raw([
            'text' => '',
            'user_id' => $user->id
        ]);

        $response = $this->withHeaders(['Accept' => 'application/json'])->post('api/tweet', $tweetRaw);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'text' => [
                    'The text field is required.'
                ]
            ]
        ]);

    }


    public function testUserCantPostATweetWithCharacterLimit()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $tweetRaw = Tweet::factory()->raw([
            'text' =>  Str::random(150),
            'user_id' => $user->id
        ]);

        $response = $this->withHeaders(['Accept' => 'application/json'])->post('api/tweet', $tweetRaw);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'text' => [
                    'The text must not be greater than 140 characters.'
                ]
            ]
        ]);
    }
}
