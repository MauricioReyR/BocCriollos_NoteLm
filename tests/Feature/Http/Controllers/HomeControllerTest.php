<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Combo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_returns_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_home_page_uses_correct_view(): void
    {
        $response = $this->get('/');

        $response->assertViewIs('pages.home');
    }

    public function test_home_page_has_combos(): void
    {
        $combo = Combo::factory()->create([
            'is_active' => true,
            'is_featured' => false,
        ]);

        $response = $this->get('/');

        $response->assertViewHas('combos');

        $combos = $response->viewData('combos');
        $this->assertTrue($combos->contains($combo));
    }

    public function test_home_page_combos_are_sorted(): void
    {
        Combo::factory()->create([
            'is_active' => true,
            'is_featured' => false,
            'sort_order' => 2,
        ]);

        $firstCombo = Combo::factory()->create([
            'is_active' => true,
            'is_featured' => false,
            'sort_order' => 1,
        ]);

        $response = $this->get('/');

        $combos = $response->viewData('combos');
        $this->assertEquals($firstCombo->id, $combos->first()->id);
    }

    public function test_home_page_excludes_inactive_combos(): void
    {
        Combo::factory()->create([
            'is_active' => false,
            'is_featured' => false,
        ]);

        $response = $this->get('/');

        $combos = $response->viewData('combos');
        $this->assertCount(0, $combos);
    }

    public function test_home_page_has_testimonials(): void
    {
        $response = $this->get('/');

        $response->assertViewHas('testimonials');
    }

    public function test_home_page_has_combos_adiciones(): void
    {
        $combo = Combo::factory()->create([
            'is_active' => true,
            'is_featured' => false,
            'size' => 'adiciones',
        ]);

        $response = $this->get('/');

        $response->assertViewHas('combosAdiciones');

        $combosAdiciones = $response->viewData('combosAdiciones');
        $this->assertTrue($combosAdiciones->contains($combo));
    }
}
