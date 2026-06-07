<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminTestimonialControllerTest extends TestCase
{
    use RefreshDatabase;

    private array $adminSession;

    protected function setUp(): void
    {
        parent::setUp();

        // Set admin password for tests (hashed)
        config(['admin.password' => Hash::make('test-admin-pass')]);

        // Simulate an authenticated admin session
        $this->adminSession = [
            'admin_authenticated' => true,
            'admin_last_activity' => now()->timestamp,
        ];

        // Disable CSRF protection and throttle for testing — the admin
        // auth middleware provides sufficient authentication coverage
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->withoutMiddleware(\Illuminate\Routing\Middleware\ThrottleRequests::class);
    }

    // ---------------------------------------------------------------
    //  Authentication guard
    // ---------------------------------------------------------------

    public function test_index_requires_authentication(): void
    {
        $response = $this->get(route('admin.testimonios'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_edit_requires_authentication(): void
    {
        $testimonial = Testimonial::factory()->create();

        $response = $this->get(route('admin.testimonios.edit', $testimonial));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_update_requires_authentication(): void
    {
        $testimonial = Testimonial::factory()->create();

        $response = $this->put(route('admin.testimonios.update', $testimonial), [
            'name' => 'Hacked Name',
        ]);

        $response->assertRedirect(route('admin.login'));
    }

    public function test_destroy_requires_authentication(): void
    {
        $testimonial = Testimonial::factory()->create();

        $response = $this->delete(route('admin.testimonios.destroy', $testimonial));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_approve_requires_authentication(): void
    {
        $testimonial = Testimonial::factory()->create();

        $response = $this->post(route('admin.testimonios.approve', $testimonial));

        $response->assertRedirect(route('admin.login'));
    }

    // ---------------------------------------------------------------
    //  Login / logout
    // ---------------------------------------------------------------

    public function test_login_with_correct_password_grants_access(): void
    {
        $response = $this->post(route('admin.login'), [
            'password' => 'test-admin-pass',
        ]);

        $response->assertRedirect(route('admin.testimonios'));
        $response->assertSessionHas('admin_authenticated');
    }

    public function test_login_with_incorrect_password_denies_access(): void
    {
        $response = $this->post(route('admin.login'), [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('password');
        $response->assertSessionMissing('admin_authenticated');
    }

    public function test_login_requires_password(): void
    {
        $response = $this->post(route('admin.login'), []);

        $response->assertSessionHasErrors('password');
    }

    public function test_login_with_empty_config_denies_access(): void
    {
        config(['admin.password' => null]);

        $response = $this->post(route('admin.login'), [
            'password' => 'anything',
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_logout_clears_session(): void
    {
        $response = $this->withSession($this->adminSession)
            ->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $response->assertSessionMissing('admin_authenticated');
    }

    // ---------------------------------------------------------------
    //  Index
    // ---------------------------------------------------------------

    public function test_index_displays_testimonials_and_stats(): void
    {
        $approvedTestimonials = Testimonial::factory()->count(3)->create([
            'is_approved' => true,
        ]);
        $pendingTestimonials = Testimonial::factory()->count(2)->create([
            'is_approved' => false,
        ]);

        $response = $this->withSession($this->adminSession)
            ->get(route('admin.testimonios'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.testimonios.index');
        $response->assertViewHas('testimonials');
        $response->assertViewHas('pendingCount', 2);
        $response->assertViewHas('approvedCount', 3);

        $testimonials = $response->viewData('testimonials');
        $this->assertCount(5, $testimonials);
        $this->assertTrue($testimonials->contains($approvedTestimonials->first()));
        $this->assertTrue($testimonials->contains($pendingTestimonials->first()));
    }

    public function test_index_testimonials_are_ordered_by_created_at_desc(): void
    {
        $old = Testimonial::factory()->create([
            'created_at' => now()->subDays(2),
        ]);
        $recent = Testimonial::factory()->create([
            'created_at' => now()->subHour(),
        ]);

        $response = $this->withSession($this->adminSession)
            ->get(route('admin.testimonios'));

        $testimonials = $response->viewData('testimonials');
        $this->assertEquals($recent->id, $testimonials->first()->id);
    }

    public function test_index_shows_empty_state_when_no_testimonials(): void
    {
        $response = $this->withSession($this->adminSession)
            ->get(route('admin.testimonios'));

        $response->assertStatus(200);
        $testimonials = $response->viewData('testimonials');
        $this->assertCount(0, $testimonials);
        $this->assertEquals(0, $response->viewData('pendingCount'));
        $this->assertEquals(0, $response->viewData('approvedCount'));
    }

    // ---------------------------------------------------------------
    //  Edit
    // ---------------------------------------------------------------

    public function test_edit_displays_form_with_testimonial(): void
    {
        $testimonial = Testimonial::factory()->create([
            'name' => 'María López',
            'rating' => 5,
        ]);

        $response = $this->withSession($this->adminSession)
            ->get(route('admin.testimonios.edit', $testimonial));

        $response->assertStatus(200);
        $response->assertViewIs('admin.testimonios.edit');
        $response->assertViewHas('testimonial');

        $viewTestimonial = $response->viewData('testimonial');
        $this->assertEquals($testimonial->id, $viewTestimonial->id);
        $this->assertEquals('María López', $viewTestimonial->name);
    }

    // ---------------------------------------------------------------
    //  Update
    // ---------------------------------------------------------------

    public function test_update_testimonial_basic_fields(): void
    {
        $testimonial = Testimonial::factory()->create([
            'name' => 'Original Name',
            'role' => 'Cliente',
            'rating' => 3,
            'text' => 'Un testimonio original y muy bueno.',
            'is_approved' => false,
        ]);

        $response = $this->withSession($this->adminSession)
            ->from(route('admin.testimonios.edit', $testimonial))
            ->put(route('admin.testimonios.update', $testimonial), [
                'name' => 'Updated Name',
                'role' => 'Cliente Satisfecho',
                'rating' => 5,
                'text' => 'Un testimonio actualizado y muy bueno realmente.',
                'is_approved' => true,
            ]);

        $response->assertRedirect(route('admin.testimonios'));
        $response->assertSessionHas('success');

        $testimonial->refresh();
        $this->assertEquals('Updated Name', $testimonial->name);
        $this->assertEquals('Cliente Satisfecho', $testimonial->role);
        $this->assertEquals(5, $testimonial->rating);
        $this->assertEquals('Un testimonio actualizado y muy bueno realmente.', $testimonial->text);
        $this->assertTrue($testimonial->is_approved);
    }

    public function test_update_testimonial_validation_errors(): void
    {
        $testimonial = Testimonial::factory()->create();

        $response = $this->withSession($this->adminSession)
            ->from(route('admin.testimonios.edit', $testimonial))
            ->put(route('admin.testimonios.update', $testimonial), [
                'name' => '',
                'rating' => 6,
                'text' => 'short',
            ]);

        $response->assertRedirect(route('admin.testimonios.edit', $testimonial));
        $response->assertSessionHasErrors(['name', 'rating', 'text']);
    }

    public function test_update_testimonial_clears_role_when_empty(): void
    {
        $testimonial = Testimonial::factory()->create([
            'role' => 'Original Role',
        ]);

        $response = $this->withSession($this->adminSession)
            ->put(route('admin.testimonios.update', $testimonial), [
                'name' => 'Sin Rol',
                'role' => '',
                'rating' => 4,
                'text' => 'Un texto de prueba para el testimonio sin rol.',
            ]);

        $response->assertSessionHas('success');

        $testimonial->refresh();
        $this->assertEquals('Sin Rol', $testimonial->name);
        $this->assertEmpty($testimonial->role);
    }

    // ---------------------------------------------------------------
    //  Destroy
    // ---------------------------------------------------------------

    public function test_destroy_deletes_testimonial(): void
    {
        $testimonial = Testimonial::factory()->create([
            'name' => 'To Delete',
        ]);

        $response = $this->withSession($this->adminSession)
            ->delete(route('admin.testimonios.destroy', $testimonial));

        $response->assertRedirect(route('admin.testimonios'));
        $response->assertSessionHas('success');

        $this->assertModelMissing($testimonial);
    }

    public function test_destroy_with_pending_testimonial(): void
    {
        $testimonial = Testimonial::factory()->pending()->create();

        $response = $this->withSession($this->adminSession)
            ->delete(route('admin.testimonios.destroy', $testimonial));

        $response->assertRedirect(route('admin.testimonios'));
        $this->assertModelMissing($testimonial);
    }

    // ---------------------------------------------------------------
    //  Approve
    // ---------------------------------------------------------------

    public function test_approve_pending_testimonial(): void
    {
        $testimonial = Testimonial::factory()->pending()->create([
            'name' => 'Pending User',
        ]);

        $response = $this->withSession($this->adminSession)
            ->post(route('admin.testimonios.approve', $testimonial));

        $response->assertRedirect(route('admin.testimonios'));
        $response->assertSessionHas('success');

        $testimonial->refresh();
        $this->assertTrue($testimonial->is_approved);
    }

    public function test_approve_already_approved_testimonial(): void
    {
        $testimonial = Testimonial::factory()->approved()->create();

        $response = $this->withSession($this->adminSession)
            ->post(route('admin.testimonios.approve', $testimonial));

        $response->assertRedirect(route('admin.testimonios'));
        $response->assertSessionHas('info');
        $response->assertSessionMissing('success');

        $testimonial->refresh();
        $this->assertTrue($testimonial->is_approved);
    }

    // ---------------------------------------------------------------
    //  Show login form (unauthenticated)
    // ---------------------------------------------------------------

    public function test_show_login_form_returns_view(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.login');
    }
}
