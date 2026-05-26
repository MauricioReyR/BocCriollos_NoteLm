<?php

namespace Tests\Unit\Models;

use App\Models\Combo;
use PHPUnit\Framework\TestCase;

class ComboTest extends TestCase
{
    private Combo $combo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->combo = new Combo();
    }

    public function test_fillable_attributes(): void
    {
        $fillable = $this->combo->getFillable();

        $expectedFillable = [
            'name',
            'description',
            'price',
            'image',
            'image_url',
            'is_active',
            'sort_order',
        ];

        foreach ($expectedFillable as $attribute) {
            $this->assertContains($attribute, $fillable, "{$attribute} should be fillable");
        }
    }

    public function test_casts_are_defined(): void
    {
        $casts = $this->combo->getCasts();

        $this->assertArrayHasKey('price', $casts);
        $this->assertArrayHasKey('is_active', $casts);
        $this->assertArrayHasKey('sort_order', $casts);

        $this->assertEquals('decimal:2', $casts['price']);
        $this->assertEquals('boolean', $casts['is_active']);
        $this->assertEquals('integer', $casts['sort_order']);
    }

    public function test_active_scope_exists(): void
    {
        $this->assertTrue(
            method_exists(Combo::class, 'scopeActive'),
            'Combo must have a scopeActive() method'
        );
    }

    public function test_sorted_scope_exists(): void
    {
        $this->assertTrue(
            method_exists(Combo::class, 'scopeSorted'),
            'Combo must have a scopeSorted() method'
        );
    }

    public function test_table_name_is_combos(): void
    {
        $this->assertEquals('combos', $this->combo->getTable());
    }
}
