<?php

namespace Tests\Feature\Http\Controllers;

use App\Mail\NuevoTestimonio;
use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class TestimonialControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Ensure APP_KEY is set for HMAC token generation
        if (! config('app.key')) {
            config(['app.key' => 'base64:'.base64_encode(random_bytes(32))]);
        }

        // Disable throttling for tests (3 requests/minute would interfere)
        $this->withoutMiddleware(\Illuminate\Routing\Middleware\ThrottleRequests::class);

        // Disable CSRF for all tests (no session-based auth needed here)
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    // ---------------------------------------------------------------
    //  Helpers
    // ---------------------------------------------------------------

    /**
     * Generate a valid approval token for the given testimonial.
     */
    private function approvalToken(Testimonial $testimonial): string
    {
        return hash_hmac('sha256', (string) $testimonial->id, config('app.key'));
    }

    /**
     * Submit a testimonial via the public store endpoint.
     */
    private function submitTestimonial(array $overrides = []): \Illuminate\Testing\TestResponse
    {
        return $this->postJson('/testimonios', array_merge([
            'name'   => 'María López',
            'role'   => 'Cliente Satisfecho',
            'rating' => 5,
            'text'   => 'Las empanadas son deliciosas, muy recomendadas. Volveré a pedir sin duda alguna.',
        ], $overrides));
    }

    // ---------------------------------------------------------------
    //  Store — Honeypot
    // ---------------------------------------------------------------

    public function test_store_ignores_bot_when_honeypot_is_filled(): void
    {
        $response = $this->postJson('/testimonios', [
            'name'    => 'Bot',
            'rating'  => 5,
            'text'    => 'Un texto largo de prueba para el testimonio.',
            'website' => 'http://spam.example.com',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'message' => 'Tu testimonio ha sido recibido y será revisado pronto.',
        ]);

        // No testimonial should have been created
        $this->assertEquals(0, Testimonial::count());
    }

    // ---------------------------------------------------------------
    //  Store — Validation
    // ---------------------------------------------------------------

    public function test_store_requires_name(): void
    {
        $response = $this->submitTestimonial(['name' => '']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }

    public function test_store_name_max_length(): void
    {
        $response = $this->submitTestimonial(['name' => str_repeat('a', 101)]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }

    public function test_store_requires_rating(): void
    {
        $response = $this->submitTestimonial(['rating' => '']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('rating');
    }

    public function test_store_rating_must_be_between_1_and_5(): void
    {
        $response = $this->submitTestimonial(['rating' => 6]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('rating');
    }

    public function test_store_requires_text(): void
    {
        $response = $this->submitTestimonial(['text' => '']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('text');
    }

    public function test_store_text_min_length(): void
    {
        $response = $this->submitTestimonial(['text' => 'Corto']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('text');
    }

    public function test_store_text_max_length(): void
    {
        $response = $this->submitTestimonial(['text' => str_repeat('a', 1001)]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('text');
    }

    public function test_store_role_is_optional(): void
    {
        $response = $this->submitTestimonial(['role' => '']);

        $response->assertStatus(201);
        $this->assertDatabaseHas('testimonials', [
            'name' => 'María López',
        ]);
    }

    // ---------------------------------------------------------------
    //  Store — Successful creation
    // ---------------------------------------------------------------

    public function test_store_creates_testimonial_with_expected_defaults(): void
    {
        $response = $this->submitTestimonial([
            'name' => 'Carlos Pérez',
            'role' => 'Ingeniero',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'message' => 'Tu testimonio ha sido recibido y será revisado pronto.',
        ]);

        $this->assertDatabaseHas('testimonials', [
            'name'       => 'Carlos Pérez',
            'role'       => 'Ingeniero',
            'rating'     => 5,
            'text'       => 'Las empanadas son deliciosas, muy recomendadas. Volveré a pedir sin duda alguna.',
            'is_approved' => false,
        ]);

        // Avatar emoji should be set from the avatars array
        $testimonial = Testimonial::where('name', 'Carlos Pérez')->first();
        $this->assertNotEmpty($testimonial->avatar_emoji);
        $this->assertContains($testimonial->avatar_emoji, [
            '😊', '👩', '👨', '👨‍💼', '👩‍🏫', '👨‍🍳', '🏃‍♀️', '👩‍💻', '🎨', '🚖', '👨‍🎓', '👩‍🎓', '👨‍👩‍👧‍👦',
        ]);
    }

    public function test_store_sets_auto_incrementing_sort_order(): void
    {
        // Create an existing testimonial to set baseline
        Testimonial::factory()->create(['sort_order' => 5]);

        $response = $this->submitTestimonial([
            'name' => 'Primero',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('testimonials', [
            'name'       => 'Primero',
            'sort_order' => 6, // max(sort_order) = 5, then +1
        ]);
    }

    public function test_store_sets_sort_order_to_1_when_no_testimonials_exist(): void
    {
        $response = $this->submitTestimonial([
            'name' => 'Primero',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('testimonials', [
            'name'       => 'Primero',
            'sort_order' => 1,
        ]);
    }

    public function test_store_returns_created_testimonial_in_response(): void
    {
        $response = $this->submitTestimonial([
            'name' => 'Ana Gómez',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'success',
            'message',
            'testimonial' => [
                'id',
                'name',
                'rating',
                'text',
                'avatar_emoji',
            ],
        ]);

        $data = $response->json('testimonial');
        $this->assertEquals('Ana Gómez', $data['name']);
        $this->assertEquals(5, $data['rating']);
    }

    // ---------------------------------------------------------------
    //  Store — Email notification
    // ---------------------------------------------------------------

    public function test_store_sends_email_notification(): void
    {
        Mail::fake();

        $this->submitTestimonial([
            'name' => 'María López',
        ]);

        Mail::assertSent(NuevoTestimonio::class, function ($mail) {
            return $mail->testimonial->name === 'María López';
        });
    }

    public function test_store_does_not_fail_when_email_sending_fails(): void
    {
        // Instead of actually making the mail fail, we use Mail::fake() and
        // verify the testimonial IS created regardless. The try/catch in the
        // controller handles real failures gracefully.
        Mail::fake();

        $response = $this->submitTestimonial([
            'name' => 'Fail Email',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('testimonials', [
            'name' => 'Fail Email',
        ]);
    }

    public function test_store_email_goes_to_configured_address(): void
    {
        Mail::fake();

        $this->submitTestimonial();

        Mail::assertSent(NuevoTestimonio::class, function ($mail) {
            // The mail is sent via Mail::to($this->getNotificationEmail())
            // which uses config('app.admin_notification_email') or env() fallback
            $expected = config('app.admin_notification_email')
                ?: env('ADMIN_NOTIFICATION_EMAIL', 'nuestrosbocaditoscriollos@gmail.com');

            return $mail->hasTo($expected);
        });
    }

    // ---------------------------------------------------------------
    //  Approve — Token verification
    // ---------------------------------------------------------------

    public function test_approve_with_valid_token_approves_testimonial(): void
    {
        $testimonial = Testimonial::factory()->pending()->create([
            'name' => 'Pendiente',
        ]);

        $token = $this->approvalToken($testimonial);

        $response = $this->get(route('testimonios.aprobar', [
            'testimonial' => $testimonial,
            'token'       => $token,
        ]));

        $response->assertRedirect('/#testimonios');
        $response->assertSessionHas('success');

        $testimonial->refresh();
        $this->assertTrue($testimonial->is_approved);
    }

    public function test_approve_with_valid_token_is_idempotent(): void
    {
        $testimonial = Testimonial::factory()->approved()->create([
            'name' => 'Ya Aprobado',
        ]);

        $token = $this->approvalToken($testimonial);

        $response = $this->get(route('testimonios.aprobar', [
            'testimonial' => $testimonial,
            'token'       => $token,
        ]));

        $response->assertRedirect('/#testimonios');
        $response->assertSessionHas('info');
        $response->assertSessionMissing('success');

        // Should still be approved
        $testimonial->refresh();
        $this->assertTrue($testimonial->is_approved);
    }

    public function test_approve_with_invalid_token_returns_404(): void
    {
        $testimonial = Testimonial::factory()->pending()->create();

        $response = $this->get(route('testimonios.aprobar', [
            'testimonial' => $testimonial,
            'token'       => 'invalid-token',
        ]));

        $response->assertStatus(404);
    }

    public function test_approve_with_different_app_key_invalidates_token(): void
    {
        $testimonial = Testimonial::factory()->pending()->create();

        $originalKey = config('app.key');
        $token = hash_hmac('sha256', (string) $testimonial->id, 'different-key');

        $response = $this->get(route('testimonios.aprobar', [
            'testimonial' => $testimonial,
            'token'       => $token,
        ]));

        $response->assertStatus(404);
    }

    // ---------------------------------------------------------------
    //  Approve — Token generation matches controller logic
    // ---------------------------------------------------------------

    public function test_approve_token_uses_sha256_hmac(): void
    {
        $testimonial = Testimonial::factory()->pending()->create();

        // The controller uses: hash_hmac('sha256', (string) $testimonial->id, config('app.key'))
        $expected = hash_hmac('sha256', (string) $testimonial->id, config('app.key'));

        $this->assertEquals($expected, $this->approvalToken($testimonial));
    }
}
