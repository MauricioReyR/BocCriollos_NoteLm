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
        Combo::$adminOverride = false;
        $this->combo = new Combo();
    }

    protected function tearDown(): void
    {
        Combo::$adminOverride = false;
        parent::tearDown();
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

    // ----------------------------------------------------------------
    //  ADMIN_ONLY_FIELDS protection
    // ----------------------------------------------------------------

    public function test_admin_only_fields_are_stripped_when_admin_override_is_false(): void
    {
        Combo::$adminOverride = false;

        $this->combo->fill([
            'name'       => 'Test Combo',
            'price'      => 10000,
            'image'      => 'combos/test.jpg',
            'image_url'  => '/storage/combos/test.jpg',
            'is_active'  => true,
        ]);

        $this->assertNull($this->combo->image, 'image should be null (protected)');
        $this->assertNull($this->combo->image_url, 'image_url should be null (protected)');
        $this->assertEquals('Test Combo', $this->combo->name, 'name should be set');
        $this->assertEquals(10000, $this->combo->price, 'price should be set');
        $this->assertTrue($this->combo->is_active, 'is_active should be set');
    }

    public function test_admin_only_fields_are_set_when_admin_override_is_true(): void
    {
        Combo::$adminOverride = true;

        $this->combo->fill([
            'name'       => 'Admin Combo',
            'price'      => 20000,
            'image'      => 'combos/admin.jpg',
            'image_url'  => '/storage/combos/admin.jpg',
        ]);

        $this->assertEquals('combos/admin.jpg', $this->combo->image, 'image should be set (admin mode)');
        $this->assertEquals('/storage/combos/admin.jpg', $this->combo->image_url, 'image_url should be set (admin mode)');
        $this->assertEquals('Admin Combo', $this->combo->name, 'name should be set');
    }

    public function test_admin_override_resets_after_protected_operation(): void
    {
        // Enable admin mode, fill, then disable
        Combo::$adminOverride = true;
        $this->combo->fill(['image' => 'combos/temp.jpg']);
        $this->assertEquals('combos/temp.jpg', $this->combo->image, 'image should be set in admin mode');

        // Reset and verify protection is back
        Combo::$adminOverride = false;
        $secondCombo = new Combo();
        $secondCombo->fill(['image' => 'combos/should-not-set.jpg']);
        $this->assertNull($secondCombo->image, 'image should be protected after reset');
    }

    public function test_non_protected_fields_always_set_regardless_of_admin_mode(): void
    {
        // Without admin mode
        Combo::$adminOverride = false;
        $this->combo->fill([
            'name'        => 'Delicious Combo',
            'description' => 'Very tasty',
            'price'       => 25000,
            'is_featured' => true,
            'sort_order'  => 5,
            'size'        => 'tradicional',
        ]);

        $this->assertEquals('Delicious Combo', $this->combo->name);
        $this->assertEquals('Very tasty', $this->combo->description);
        $this->assertEquals(25000, $this->combo->price);
        $this->assertTrue($this->combo->is_featured);
        $this->assertEquals(5, $this->combo->sort_order);
        $this->assertEquals('tradicional', $this->combo->size);
    }

    public function test_admin_only_fields_constant_is_defined(): void
    {
        $this->assertIsArray(Combo::ADMIN_ONLY_FIELDS);
        $this->assertContains('image', Combo::ADMIN_ONLY_FIELDS);
        $this->assertContains('image_url', Combo::ADMIN_ONLY_FIELDS);
        $this->assertCount(2, Combo::ADMIN_ONLY_FIELDS);
    }

    public function test_admin_override_default_is_false(): void
    {
        $this->assertFalse(Combo::$adminOverride, 'adminOverride must default to false');
    }
}
