<?php

namespace App\Models;

use App\Enums\ComboSize;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Combo extends Model
{
    use HasFactory;

    /**
     * Campos que solo pueden ser modificados desde el panel de administración.
     * Cualquier intento de asignarlos masivamente (seeders, comandos, etc.)
     * será ignorado a menos que se active explícitamente $adminOverride.
     */
    public const ADMIN_ONLY_FIELDS = ['image', 'image_url'];

    /**
     * Cuando está en true, permite que los campos ADMIN_ONLY_FIELDS sean asignados
     * masivamente. Debe activarse ÚNICAMENTE desde el panel de administración.
     */
    public static bool $adminOverride = false;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'image_url',
        'is_active',
        'is_featured',
        'sort_order',
        'size',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Override de fill() para proteger campos de solo-admin.
     *
     * Si $adminOverride es false, los campos en ADMIN_ONLY_FIELDS se eliminan
     * automáticamente de los atributos a asignar, evitando que seeders,
     * comandos artesanales u otros procesos masivos los sobrescriban.
     */
    public function fill(array $attributes)
    {
        if (! static::$adminOverride) {
            $attributes = collect($attributes)
                ->except(static::ADMIN_ONLY_FIELDS)
                ->toArray();
        }

        return parent::fill($attributes);
    }

    /**
     * Boot the model and register model event hooks.
     */
    protected static function booted(): void
    {
        static::saving(function (self $combo) {
            if (! ComboSize::isValid($combo->size)) {
                $invalid = $combo->size;
                $combo->size = null;

                Log::warning("Tamaño de combo inválido «{$invalid}» para «{$combo->name}», se asignó null.");
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order');
    }
}
