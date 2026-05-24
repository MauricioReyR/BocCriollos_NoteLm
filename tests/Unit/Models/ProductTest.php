<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->product = new Product();
    }

    public function test_fillable_attributes(): void
    {
        $fillable = $this->product->getFillable();

        $expectedFillable = [
            'name',
            'description',
            'price',
            'stock',
            'category_id',
            'icon',
            'image_gradient',
            'image_url',
            'is_featured',
            'is_active',
            'sort_order',
        ];

        foreach ($expectedFillable as $attribute) {
            $this->assertContains($attribute, $fillable, "{$attribute} should be fillable");
        }
    }

    public function test_casts_are_defined(): void
    {
        $casts = $this->product->getCasts();

        $this->assertArrayHasKey('price', $casts);
        $this->assertArrayHasKey('is_featured', $casts);
        $this->assertArrayHasKey('is_active', $casts);
        $this->assertArrayHasKey('sort_order', $casts);

        $this->assertEquals('decimal:2', $casts['price']);
        $this->assertEquals('boolean', $casts['is_featured']);
        $this->assertEquals('boolean', $casts['is_active']);
        $this->assertEquals('integer', $casts['sort_order']);
    }

    public function test_category_relationship_exists(): void
    {
        $this->assertTrue(
            method_exists(Product::class, 'category'),
            'Product must have a category() relationship method'
        );
    }

    public function test_active_scope_exists(): void
    {
        $this->assertTrue(
            method_exists(Product::class, 'scopeActive'),
            'Product must have a scopeActive() method'
        );
    }

    public function test_featured_scope_exists(): void
    {
        $this->assertTrue(
            method_exists(Product::class, 'scopeFeatured'),
            'Product must have a scopeFeatured() method'
        );
    }

    public function test_sorted_scope_exists(): void
    {
        $this->assertTrue(
            method_exists(Product::class, 'scopeSorted'),
            'Product must have a scopeSorted() method'
        );
    }

    public function test_table_name_is_products(): void
    {
        $this->assertEquals('products', $this->product->getTable());
    }
}
