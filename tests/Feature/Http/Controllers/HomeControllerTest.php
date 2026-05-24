<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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

    public function test_home_page_has_featured_products(): void
    {
        // Create categories with products
        $category = Category::factory()->create();

        $featuredProduct = Product::factory()->create([
            'category_id' => $category->id,
            'is_featured' => true,
            'is_active' => true,
        ]);

        $nonFeaturedProduct = Product::factory()->create([
            'category_id' => $category->id,
            'is_featured' => false,
            'is_active' => true,
        ]);

        $response = $this->get('/');

        $response->assertViewHas('featuredProducts');

        $featuredProducts = $response->viewData('featuredProducts');
        $this->assertTrue($featuredProducts->contains($featuredProduct));
        $this->assertFalse($featuredProducts->contains($nonFeaturedProduct));
    }

    public function test_home_page_has_active_categories_with_count(): void
    {
        Category::factory()->create(['is_active' => true]);
        Category::factory()->create(['is_active' => true]);
        Category::factory()->create(['is_active' => false]);

        $response = $this->get('/');

        $response->assertViewHas('categories');

        $categories = $response->viewData('categories');
        $this->assertCount(2, $categories);
    }

    public function test_home_page_has_combos(): void
    {
        $combosCategory = Category::factory()->create(['slug' => 'combos']);

        $combo = Product::factory()->create([
            'category_id' => $combosCategory->id,
            'is_active' => true,
        ]);

        $response = $this->get('/');

        $response->assertViewHas('combos');

        $combos = $response->viewData('combos');
        $this->assertTrue($combos->contains($combo));
    }

    public function test_home_page_products_are_sorted(): void
    {
        $category = Category::factory()->create();

        Product::factory()->create([
            'category_id' => $category->id,
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $firstProduct = Product::factory()->create([
            'category_id' => $category->id,
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->get('/');

        $featuredProducts = $response->viewData('featuredProducts');
        $this->assertEquals($firstProduct->id, $featuredProducts->first()->id);
    }

    public function test_home_page_excludes_inactive_products(): void
    {
        $category = Category::factory()->create();

        Product::factory()->create([
            'category_id' => $category->id,
            'is_featured' => true,
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $featuredProducts = $response->viewData('featuredProducts');
        $this->assertCount(0, $featuredProducts);
    }
}
