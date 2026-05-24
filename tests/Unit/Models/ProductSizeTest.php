<?php

namespace Tests\Unit\Models;

use App\Models\ProductSize;
use PHPUnit\Framework\TestCase;

class ProductSizeTest extends TestCase
{
    private ProductSize $productSize;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productSize = new ProductSize();
    }

    public function test_fillable_attributes(): void
    {
        $fillable = $this->productSize->getFillable();

        $expectedFillable = [
            'product_id',
            'name',
            'slug',
            'price_adjustment',
            'is_available',
            'sort_order',
        ];

        foreach ($expectedFillable as $attribute) {
            $this->assertContains($attribute, $fillable, "{$attribute} should be fillable");
        }
    }

    public function test_casts_are_defined(): void
    {
        $casts = $this->productSize->getCasts();

        $this->assertArrayHasKey('price_adjustment', $casts);
        $this->assertArrayHasKey('is_available', $casts);
        $this->assertArrayHasKey('sort_order', $casts);

        $this->assertEquals('decimal:2', $casts['price_adjustment']);
        $this->assertEquals('boolean', $casts['is_available']);
        $this->assertEquals('integer', $casts['sort_order']);
    }

    public function test_product_relationship_exists(): void
    {
        $this->assertTrue(
            method_exists(ProductSize::class, 'product'),
            'ProductSize must have a product() relationship method'
        );
    }

    public function test_table_name_is_product_sizes(): void
    {
        $this->assertEquals('product_sizes', $this->productSize->getTable());
    }
}
