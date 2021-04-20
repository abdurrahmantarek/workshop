<?php

namespace Tests\Feature;


use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Barryvdh\DomPDF\Facade as PDF;

class ReportServiceTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthenticatedUserCanDownloadPdf()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        PDF::shouldReceive('loadView')
            ->once()
            ->andReturnSelf()
            ->getMock()
            ->shouldReceive('download')
            ->once()
            ->andReturn('THE_PDF_BINARY_DATA');

        $this->withoutExceptionHandling()
            ->get('api/v1/report')
            ->assertSuccessful()
            ->assertSeeText('THE_PDF_BINARY_DATA');
    }

    public function testUnAuthenticatedUserCantDownloadPdfReport()
    {
        $response = $this
            ->withHeaders(['Accept' => 'application/json'])
            ->get('api/v1/report');

        $this->assertGuest();

        $response->assertStatus(401);
    }

}
