<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Combo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminComboControllerTest extends TestCase
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
    //  Helpers
    // ---------------------------------------------------------------

    /**
     * Since the Combo model overrides fill() to strip ADMIN_ONLY_FIELDS
     * (image, image_url) when $adminOverride is false, we need to enable
     * admin mode when creating combos that include those fields.
     */
    private function createComboWithImage(array $attributes = []): Combo
    {
        Combo::$adminOverride = true;
        try {
            return Combo::factory()->create($attributes);
        } finally {
            Combo::$adminOverride = false;
        }
    }

    /**
     * Perform an admin-authenticated POST request with file upload.
     * Passes the UploadedFile directly in the data array so Laravel's
     * extractFilesFromDataArray() places it in the Symfony FileBag.
     */
    private function adminPostWithFile(string $uri, array $data): \Illuminate\Testing\TestResponse
    {
        return $this->withSession($this->adminSession)
            ->post($uri, $data);
    }

    // ---------------------------------------------------------------
    //  Authentication guard
    // ---------------------------------------------------------------

    public function test_index_requires_authentication(): void
    {
        $response = $this->get(route('admin.combos'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_edit_requires_authentication(): void
    {
        $combo = Combo::factory()->create();

        $response = $this->get(route('admin.combos.edit', $combo));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_update_requires_authentication(): void
    {
        $combo = Combo::factory()->create();

        $response = $this->put(route('admin.combos.update', $combo), [
            'name' => 'Hacked Combo',
        ]);

        $response->assertRedirect(route('admin.login'));
    }

    public function test_destroy_requires_authentication(): void
    {
        $combo = Combo::factory()->create();

        $response = $this->delete(route('admin.combos.destroy', $combo));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_toggle_active_requires_authentication(): void
    {
        $combo = Combo::factory()->create();

        $response = $this->patch(route('admin.combos.toggle-active', $combo));

        $response->assertRedirect(route('admin.login'));
    }

    // ---------------------------------------------------------------
    //  Index
    // ---------------------------------------------------------------

    public function test_index_displays_combos_and_stats(): void
    {
        $activeCombos = Combo::factory()->count(3)->create([
            'is_active' => true,
        ]);
        $inactiveCombos = Combo::factory()->count(2)->create([
            'is_active' => false,
        ]);

        $response = $this->withSession($this->adminSession)
            ->get(route('admin.combos'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.combos.index');
        $response->assertViewHas('combos');
        $response->assertViewHas('activeCount', 3);
        $response->assertViewHas('inactiveCount', 2);

        $combos = $response->viewData('combos');
        $this->assertCount(5, $combos);
        $this->assertTrue($combos->contains($activeCombos->first()));
        $this->assertTrue($combos->contains($inactiveCombos->first()));
    }

    public function test_index_combos_are_ordered_by_sort_order(): void
    {
        Combo::factory()->create(['sort_order' => 10, 'is_active' => true]);
        $first = Combo::factory()->create(['sort_order' => 1, 'is_active' => true]);

        $response = $this->withSession($this->adminSession)
            ->get(route('admin.combos'));

        $combos = $response->viewData('combos');
        $this->assertEquals($first->id, $combos->first()->id);
    }

    public function test_index_shows_empty_state_when_no_combos(): void
    {
        $response = $this->withSession($this->adminSession)
            ->get(route('admin.combos'));

        $response->assertStatus(200);
        $combos = $response->viewData('combos');
        $this->assertCount(0, $combos);
        $this->assertEquals(0, $response->viewData('activeCount'));
        $this->assertEquals(0, $response->viewData('inactiveCount'));
    }

    // ---------------------------------------------------------------
    //  Edit
    // ---------------------------------------------------------------

    public function test_edit_displays_form_with_combo(): void
    {
        $combo = Combo::factory()->create([
            'name' => 'Combo de Prueba',
            'price' => 25000,
        ]);

        $response = $this->withSession($this->adminSession)
            ->get(route('admin.combos.edit', $combo));

        $response->assertStatus(200);
        $response->assertViewIs('admin.combos.edit');
        $response->assertViewHas('combo');

        $viewCombo = $response->viewData('combo');
        $this->assertEquals($combo->id, $viewCombo->id);
        $this->assertEquals('Combo de Prueba', $viewCombo->name);
    }

    // ---------------------------------------------------------------
    //  Update
    // ---------------------------------------------------------------

    public function test_update_combo_basic_fields(): void
    {
        $combo = Combo::factory()->create([
            'name' => 'Original Name',
            'description' => 'Original description',
            'price' => 10000,
            'size' => 'tradicional',
            'is_featured' => false,
            'sort_order' => 5,
        ]);

        $response = $this->withSession($this->adminSession)
            ->from(route('admin.combos.edit', $combo))
            ->put(route('admin.combos.update', $combo), [
                'name' => 'Updated Name',
                'description' => 'Updated description',
                'price' => 35000,
                'size' => 'bocado',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 1,
            ]);

        $response->assertRedirect(route('admin.combos'));
        $response->assertSessionHas('success');

        $combo->refresh();
        $this->assertEquals('Updated Name', $combo->name);
        $this->assertEquals('Updated description', $combo->description);
        $this->assertEquals(35000, (int) $combo->price);
        $this->assertEquals('bocado', $combo->size);
        $this->assertTrue($combo->is_featured);
        $this->assertEquals(1, $combo->sort_order);
        $this->assertTrue($combo->is_active);
    }

    public function test_update_combo_validation_errors(): void
    {
        $combo = Combo::factory()->create();

        $response = $this->withSession($this->adminSession)
            ->from(route('admin.combos.edit', $combo))
            ->put(route('admin.combos.update', $combo), [
                'name' => '',
                'price' => -100,
                'sort_order' => 9999,
            ]);

        $response->assertRedirect(route('admin.combos.edit', $combo));
        $response->assertSessionHasErrors(['name', 'price', 'sort_order']);
    }

    // ---------------------------------------------------------------
    //  Update — Image upload
    // ---------------------------------------------------------------

    public function test_update_combo_with_image_upload(): void
    {
        Storage::fake('public');

        $combo = Combo::factory()->create([
            'image' => null,
            'image_url' => null,
        ]);

        $file = UploadedFile::fake()->image('combo.jpg', 200, 200);

        $response = $this->adminPostWithFile(
            route('admin.combos.update', $combo),
            [
                '_method' => 'PUT',
                'name' => 'Combo con Imagen',
                'price' => 30000,
                'sort_order' => 1,
                'is_active' => true,
                'image' => $file,
            ],
        );

        $response->assertRedirect(route('admin.combos'));
        $response->assertSessionHas('success');

        $combo->refresh();
        $this->assertNotNull($combo->image, 'image should have been stored');
        $this->assertNotNull($combo->image_url, 'image_url should have been set');
        $this->assertStringStartsWith('combos/', $combo->image, 'image path should start with combos/');
        Storage::disk('public')->assertExists($combo->image);
    }

    public function test_update_combo_replaces_existing_image(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('combos/old-image.jpg', 'old');

        $combo = $this->createComboWithImage([
            'name' => 'Old Image Combo',
            'price' => 20000,
            'image' => 'combos/old-image.jpg',
            'image_url' => '/storage/combos/old-image.jpg',
        ]);

        $newFile = UploadedFile::fake()->image('new-combo.jpg', 200, 200);

        $response = $this->adminPostWithFile(
            route('admin.combos.update', $combo),
            [
                '_method' => 'PUT',
                'name' => 'Updated',
                'price' => 30000,
                'sort_order' => 1,
                'is_active' => true,
                'image' => $newFile,
            ],
        );

        $response->assertSessionHas('success');

        // Old image should be deleted
        Storage::disk('public')->assertMissing('combos/old-image.jpg');

        $combo->refresh();
        $this->assertNotNull($combo->image, 'new image should have been stored');
        $this->assertStringStartsWith('combos/', $combo->image);
        Storage::disk('public')->assertExists($combo->image);
    }

    public function test_update_combo_removes_image(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('combos/to-remove.jpg', 'content');

        $combo = $this->createComboWithImage([
            'name' => 'With Image',
            'price' => 20000,
            'image' => 'combos/to-remove.jpg',
            'image_url' => '/storage/combos/to-remove.jpg',
        ]);

        $response = $this->withSession($this->adminSession)
            ->post(route('admin.combos.update', $combo), [
                '_method' => 'PUT',
                'name' => 'Sin Imagen',
                'price' => 30000,
                'sort_order' => 1,
                'remove_image' => true,
                'is_active' => true,
            ]);

        $response->assertSessionHas('success');

        Storage::disk('public')->assertMissing('combos/to-remove.jpg');

        $combo->refresh();
        $this->assertNull($combo->image);
        $this->assertNull($combo->image_url);
    }

    public function test_update_combo_preserves_admin_only_fields_when_not_provided(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('combos/preserve-me.jpg', 'data');

        $combo = $this->createComboWithImage([
            'name' => 'Original',
            'price' => 20000,
            'image' => 'combos/preserve-me.jpg',
            'image_url' => '/storage/combos/preserve-me.jpg',
        ]);

        $response = $this->withSession($this->adminSession)
            ->post(route('admin.combos.update', $combo), [
                '_method' => 'PUT',
                'name' => 'Updated',
                'price' => 30000,
                'sort_order' => 1,
                'is_active' => true,
            ]);

        $response->assertSessionHas('success');

        $combo->refresh();
        // The image should still be preserved because we didn't send a new one or remove request
        $this->assertEquals('combos/preserve-me.jpg', $combo->image);
        $this->assertEquals('/storage/combos/preserve-me.jpg', $combo->image_url);
    }

    // ---------------------------------------------------------------
    //  Destroy
    // ---------------------------------------------------------------

    public function test_destroy_deletes_combo_and_image(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('combos/delete-me.jpg', 'bye');

        $combo = $this->createComboWithImage([
            'name' => 'To Delete',
            'price' => 20000,
            'image' => 'combos/delete-me.jpg',
            'image_url' => '/storage/combos/delete-me.jpg',
        ]);

        $response = $this->withSession($this->adminSession)
            ->post(route('admin.combos.destroy', $combo), [
                '_method' => 'DELETE',
            ]);

        $response->assertRedirect(route('admin.combos'));
        $response->assertSessionHas('success');

        $this->assertModelMissing($combo);
        Storage::disk('public')->assertMissing('combos/delete-me.jpg');
    }

    public function test_destroy_combo_without_image(): void
    {
        $combo = Combo::factory()->create([
            'image' => null,
            'image_url' => null,
        ]);

        $response = $this->withSession($this->adminSession)
            ->post(route('admin.combos.destroy', $combo), [
                '_method' => 'DELETE',
            ]);

        $response->assertRedirect(route('admin.combos'));
        $this->assertModelMissing($combo);
    }

    // ---------------------------------------------------------------
    //  Toggle Active
    // ---------------------------------------------------------------

    public function test_toggle_active_switches_status(): void
    {
        $combo = Combo::factory()->create(['is_active' => true]);

        // Toggle to inactive
        $response = $this->withSession($this->adminSession)
            ->patch(route('admin.combos.toggle-active', $combo));

        $response->assertRedirect(route('admin.combos'));
        $response->assertSessionHas('success');

        $combo->refresh();
        $this->assertFalse($combo->is_active);

        // Toggle back to active
        $response = $this->withSession($this->adminSession)
            ->patch(route('admin.combos.toggle-active', $combo));

        $response->assertSessionHas('success');

        $combo->refresh();
        $this->assertTrue($combo->is_active);
    }

    public function test_toggle_active_inactive_combo_excluded_from_frontend(): void
    {
        // Create a non-featured active combo so it appears in $combos (not $featuredCombos)
        $combo = Combo::factory()->create([
            'is_active' => true,
            'is_featured' => false,
        ]);

        // Verify it appears on the frontend
        $homeResponse = $this->get('/');
        $homeCombos = $homeResponse->viewData('combos');
        $this->assertTrue(
            $homeCombos->contains('id', $combo->id),
            'Active non-featured combo should appear in frontend combos',
        );

        // Toggle to inactive via admin
        $this->withSession($this->adminSession)
            ->patch(route('admin.combos.toggle-active', $combo));

        $combo->refresh();
        $this->assertFalse($combo->is_active);

        // Verify it's excluded from the frontend
        $homeResponse = $this->get('/');
        $homeCombos = $homeResponse->viewData('combos');
        $this->assertFalse(
            $homeCombos->contains('id', $combo->id),
            'Inactive combo should be excluded from frontend combos',
        );
    }

    public function test_toggle_active_on_featured_combo_excluded_from_frontend(): void
    {
        // Create a featured active combo (appears in $featuredCombos)
        $combo = Combo::factory()->create([
            'is_active' => true,
            'is_featured' => true,
        ]);

        // Verify it appears in featured combos
        $homeResponse = $this->get('/');
        $featuredCombos = $homeResponse->viewData('featuredCombos');
        $this->assertTrue(
            $featuredCombos->contains('id', $combo->id),
            'Featured combo should appear in featuredCombos',
        );

        // Toggle to inactive via admin
        $this->withSession($this->adminSession)
            ->patch(route('admin.combos.toggle-active', $combo));

        $combo->refresh();
        $this->assertFalse($combo->is_active);

        // Verify it's excluded from featured combos as well
        $homeResponse = $this->get('/');
        $featuredCombos = $homeResponse->viewData('featuredCombos');
        $this->assertFalse(
            $featuredCombos->contains('id', $combo->id),
            'Inactive featured combo should be excluded from featuredCombos',
        );
    }

    // ---------------------------------------------------------------
    //  Login flow (complementary)
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
}
