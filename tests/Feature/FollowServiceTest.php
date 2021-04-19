<?php

namespace Tests\Feature;

use App\Http\Resources\FollowResource;
use App\Http\Resources\UserResource;
use App\Models\Follow;
use App\Models\Tweet;
use App\Models\User;
use App\Repositories\FollowRepository;
use App\Services\FollowService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FollowServiceTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanFollowAnotherUser()
    {
        $user = User::factory()->create();

        $anotherUser = User::factory()->create();

        $this->actingAs($user);

        $response = $this->withoutExceptionHandling()
            ->post('api/v1/follow', [
                'user_id' => $user->id,
                'following_user_id' => $anotherUser->id
            ]);

        $followResource = FollowResource::make(Follow::first())->response()->getData(true);

        $response->assertJson($followResource);
    }


    public function testUserCantFollowHimSelf()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response =
            $this->withHeaders(['Accept' => 'application/json'])->post('api/v1/follow', [
                'user_id' => $user->id,
                'following_user_id' => $user->id
            ]);
        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'following_user_id' => [
                    'You can not follow your self'
                ]
            ]
        ]);
    }

}
