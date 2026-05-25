<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    private static array $roles = [
        'Cliente Satisfecho',
        'Estudiante',
        'Oficinista',
        'Mamá Emprendedora',
        'Trabajador Independiente',
        'Deportista',
        'Chef Pasante',
        'Ingeniero',
        'Profesor',
        'Diseñador',
        'Taxista',
        'Abogado',
        'Médico',
        'Arquitecto',
    ];

    private static array $avatars = ['😊', '👩', '👨', '👨‍💼', '👩‍🏫', '👨‍🍳', '🏃‍♀️', '👩‍💻', '🎨', '🚖'];

    private static array $templates = [
        'Una experiencia increíble. {product} de Bocaditos Criollos son las mejores que he probado. La calidad es inigualable y el servicio siempre excelente.',
        'Soy cliente frecuente y nunca me ha decepcionado. {product} son espectaculares, el precio es justo y la atención es rápida. ¡Altamente recomendado!',
        'Descubrí este lugar por recomendación y ahora es mi favorito. {product} son deliciosos, los ingredientes son frescos y el sabor es auténtico como la comida casera.',
        'Perfecto para el almuerzo o la cena rápida. {product} siempre llegan calientes y bien preparados. El servicio por WhatsApp es muy práctico para pedir.',
        'Mis hijos aman la comida de aquí. {product} son de primera calidad, porciones generosas y precios accesibles. Definitivamente nuestro lugar favorito en Engativá.',
        'Como profesional ocupado, valoro la rapidez sin sacrificar calidad. {product} de Bocaditos Criollos cumplen con ambos. Siempre frescos y deliciosos.',
        'La mejor comida rápida tradicional colombiana que he probado. {product} tienen ese sabor casero que tanto se extraña. Ingredientes frescos y preparación impecable.',
        'Pido aquí desde hace meses y la calidad nunca baja. {product} son consistentes, bien preparados y el trato al cliente es excepcional. Muy recomendados.',
    ];

    private static array $products = [
        'Las empanadas criollas',
        'Los pasteles de yuca',
        'Las hamburguesas',
        'Las arepas trifásicas',
        'Los aborrajados',
        'Las salchipapas',
        'Los combos familiares',
        'Todas las opciones del menú',
    ];

    public function definition(): array
    {
        $template = $this->faker->randomElement(self::$templates);
        $product = $this->faker->randomElement(self::$products);

        return [
            'name' => $this->faker->name(),
            'role' => $this->faker->randomElement(self::$roles),
            'rating' => $this->faker->numberBetween(3, 5),
            'avatar_emoji' => $this->faker->randomElement(self::$avatars),
            'text' => str_replace('{product}', $product, $template),
            'is_approved' => $this->faker->boolean(80),
            'sort_order' => $this->faker->numberBetween(1, 20),
        ];
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_approved' => true,
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_approved' => false,
        ]);
    }

    public function withRating(int $rating): static
    {
        return $this->state(fn (array $attributes) => [
            'rating' => min(5, max(1, $rating)),
        ]);
    }
}

