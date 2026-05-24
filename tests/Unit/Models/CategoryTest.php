<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->category = new Category();
    }

    public function test_fillable_attributes(): void
    {
        $fillable = $this->category->getFillable();

        $expectedFillable = [
            'name',
            'slug',
            'description',
            'icon',
            'gradient',
            'sort_order',
            'is_active',
        ];

        foreach ($expectedFillable as $attribute) {
            $this->assertContains($attribute, $fillable, "{$attribute} should be fillable");
        }
    }

    public function test_casts_are_defined(): void
    {
        $casts = $this->category->getCasts();

        $this->assertArrayHasKey('is_active', $casts);
        $this->assertArrayHasKey('sort_order', $casts);

        $this->assertEquals('boolean', $casts['is_active']);
        $this->assertEquals('integer', $casts['sort_order']);
    }

    public function test_products_relationship_exists(): void
    {
        $this->assertTrue(
            method_exists(Category::class, 'products'),
            'Category must have a products() relationship method'
        );
    }

    public function test_active_scope_exists(): void
    {
        $this->assertTrue(
            method_exists(Category::class, 'scopeActive'),
            'Category must have a scopeActive() method'
        );
    }

    public function test_sorted_scope_exists(): void
    {
        $this->assertTrue(
            method_exists(Category::class, 'scopeSorted'),
            'Category must have a scopeSorted() method'
        );
    }

    public function test_table_name_is_categories(): void
    {
        $this->assertEquals('categories', $this->category->getTable());
    }
}
