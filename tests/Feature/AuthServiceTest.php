<?php

namespace Tests\Feature;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthServiceTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanRegister()
    {
        $userRaw = User::factory()->raw([
            'birth_of_date' => '1997-01-10',
            'password' => '123456789',
            'password_confirmation' => '123456789',
        ]);

        $response = $this->withoutExceptionHandling()
            ->post('api/v1/auth/register', $userRaw);

        $userResource = UserResource::make(User::first())->response()->getData(true);

        $response->assertJson($userResource);
    }

    public function testUserCanLogin()
    {
        $user = User::factory()->create();

         $response = $this->withoutExceptionHandling()
            ->withHeaders(['Accept' => 'application/json'])
            ->post('api/v1/auth/login', [
                'email' => $user->email,
                'password' => '123456789'
            ]);

        $response->assertStatus(200);

        $this->assertAuthenticated('api');

        $response->assertJsonStructure(['data', 'token']);

    }

    public function testUserBlockedForThirtyMinutesAfterFiveFailedAttempts()
    {
        $user = User::factory()->create();

        for($i = 0;  $i <= 5; $i++) {

            $response = $this->withExceptionHandling()
                ->withHeaders(['Accept' => 'application/json'])
                ->post('api/v1/auth/login', [
                    'email' => $user->email,
                    'password' => '123456789'
                ]);


        }

        $response->assertStatus(422);

        $response->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "email" => ['Too many login attempts. Please try again in 30 Minutes.']
            ]
        ]);

    }
}
