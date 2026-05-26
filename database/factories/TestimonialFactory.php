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
        'Una experiencia increíble. {combo} de Bocaditos Criollos es el mejor que he probado. La calidad es inigualable y el servicio siempre excelente.',
        'Soy cliente frecuente y nunca me ha decepcionado. {combo} es espectacular, el precio es justo y la atención es rápida. ¡Altamente recomendado!',
        'Descubrí este lugar por recomendación y ahora es mi favorito. {combo} es delicioso, los ingredientes son frescos y el sabor es auténtico como la comida casera.',
        'Perfecto para compartir en familia. {combo} siempre llega caliente y bien preparado. El servicio por WhatsApp es muy práctico para pedir.',
        'Mis hijos aman la comida de aquí. {combo} es de primera calidad, porciones generosas y precios accesibles. Definitivamente nuestro lugar favorito en Engativá.',
        'Como profesional ocupado, valoro la rapidez sin sacrificar calidad. {combo} de Bocaditos Criollos cumple con ambos. Siempre fresco y delicioso.',
        'La mejor comida rápida tradicional colombiana que he probado. {combo} tiene ese sabor casero que tanto se extraña. Ingredientes frescos y preparación impecable.',
        'Pido aquí desde hace meses y la calidad nunca baja. {combo} es consistente, bien preparado y el trato al cliente es excepcional. Muy recomendado.',
    ];

    private static array $combos = [
        'El Combo Familiar Especial',
        'El Combo Pareja',
        'El Combo Ejecutivo',
        'El Combo Fiesta',
        'El Combo Aborrajado Valluno',
        'El Combo Infantil',
        'Todos los combos del menú',
    ];

    public function definition(): array
    {
        $template = $this->faker->randomElement(self::$templates);
        $combo = $this->faker->randomElement(self::$combos);

        return [
            'name' => $this->faker->name(),
            'role' => $this->faker->randomElement(self::$roles),
            'rating' => $this->faker->numberBetween(3, 5),
            'avatar_emoji' => $this->faker->randomElement(self::$avatars),
            'text' => str_replace('{combo}', $combo, $template),
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

