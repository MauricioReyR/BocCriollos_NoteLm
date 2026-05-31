<?php

namespace Database\Seeders;

use App\Models\Combo;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. COMBOS
        // ==========================================
        $combos = [
            [
                'name'         => 'Combo Bocaditos',
                'description'  => 'Lleva 30 deliciosas empanadas tradicionales en tamaño BOCADO. Disfrutalas acompañadas de aji criollo y nuestra espectacular salsa casera tipo chimichurri. Perfectas para compartir en familia o con amigos. ¡Pide tu domicilio ahora y disfruta de esta delicia en casa! 🏡🛵😎',
                'price'        => 35000,
                'is_active'    => true,
                'is_featured'  => true,
                'sort_order'   => 1,
                'size'         => 'bocado',
            ],           
            [
                'name'         => 'Combo Mini Pastelitos de Yuca',
                'description'  => 'COMBO PASTELITOS DE YUCA*📢 Recibe en la comodidad de tu casa 🏡  20 deliciosos y calientitos mini  pastelitos de yuca 😋 acompañados de ají criollo y salsa casera tipo chimichurri. Haz tu pedido ahora🛵🛵',
                'price'        => 35000,
                'is_active'    => true,
                'is_featured'  => true,
                'sort_order'   => 2,
                'size'         => 'bocado',
            ],
            [
                'name'         => 'Combo Baby Arepitas',
                'description'  => 'Disfruta de 20 deliciosas arepitas de huevo de codorniz trifasicas, con pollo desmechado y carne molida. ¡Que mejor compañía que nuestra salsa casera y aji criollo para esta pequeñas arepas!',
                'price'        => 35000,
                'is_active'    => true,
                'is_featured'  => true,
                'sort_order'   => 3,
                'size'         => 'bocado',
            ],
             [
                'name'         => 'Combo Tradicional',
                'description'  => '12 crujientes y deliciosas empanadas vallunas 🤤 con aji criollo🥵 y salsa casera tipo chimichurri😏. Disfruta esta delicia en casa🏡, calientitas y crujientes 🛵 pide tu domicilio ahora 😎',
                'price'        => 35000,
                'is_active'    => true,
                'is_featured'  => false,
                'sort_order'   => 4,
                'size'         => 'tradicional',
            ],
            [
                'name'         => 'Combo Vegetarianas',
                'description'  => 'Deliciosas empanadas vegetarianas😋 hechas en cubierta de harina trigo rellenas de espinaca 🥬, maíz dulce 🌽, queso, tomate 🍅 y ajo🧄. Una opción diferente y deliciosa😏. Animate a probar!!! Haz tu pedido',
                'price'        => 30000,
                'is_active'    => true,
                'is_featured'  => false,
                'sort_order'   => 5,
                'size'         => 'tradicional',
            ],
            [
                'name'         => 'Combo Arepa Trífasica',
                'description'  => 'Disfruta de 8 crujientes arepas de huevo 🍳trifasicas con 🍗pollo desmechado y 🥩 carne molida. Las llevamos calientitas a domicilio 🛵. Las entregamos con aji criollo 🥵 y salsa casera tipo chimichurri 😏. Que esperas? ',
                'price'        => 35000,
                'is_active'    => true,
                'is_featured'  => false,
                'sort_order'   => 6,
                'size'         => 'tradicional',
            ],
            
            [
                'name'         => 'Megacombo',
                'description'  => '⚠️ 6 crujientes y deliciosas😋 empanadas tradicionales y 4 arepas de huevo 🍳 trifasicas con pollo 🍗 desmechado y carne 🥩 desmechada. Se preparan  y salen calientitos para despacho 🏍️. Los entregamos con aji criollo 🥵y salsa casera tipo chimichurri 😏',
                'price'        => 35000,
                'is_active'    => true,
                'is_featured'  => false,
                'sort_order'   => 7,
                'size'         => 'tradicional',
            ],
            
            [
                'name'         => 'Combo Pipian',
                'description'  => 'Deliciosas receta vegetariana ancestral colombiana. Animate y pide 10 empanaditas de pipian',
                'price'        => 20000,
                'is_active'    => true,
                'is_featured'  => false,
                'sort_order'   => 8,
                'size'         => 'bocado',
            ],            
            [
                'name'         => 'Combo Cerpincho',
                'description'  => 'COMBO CERPINCHO🐷  3 deliciosos pinchos 🍢con chicharroncito carnudito  con papa salada, jugosa carne de cerdo y plátano maduro delicioso💯. Acompañados de ají criollo y nuestra infaltable salsa casera tipo chimichurri',
                'price'        => 35000,
                'is_active'    => true,
                'is_featured'  => false,
                'sort_order'   => 9,
                'size'         => 'tradicional',
            ],
            [
                'name'         => 'MegaBocado',
                'description'  => '‼️Todo lo que te gusta de Bocaditos Criollos en un solo combo ✅ lleva 5 empanadas tradicionales 😋 2 arepas de huevo🍳 trifasicas con pollo 🍗 y carne molida y 2 empanadas vegetarianas con espinaca 🥬, maiz dulce 🌽 y queso 🧀. Todo esto llega a la puerta de tu casa 🏡 con aji criollo 🥵 y salsa casera tipo chimichurri 😏. Haz tu pedido 🪀!!!',
                'price'        => 35000,
                'is_active'    => true,

                'is_featured'  => false,
                'sort_order'   => 10,
                'size'         => 'tradicional',
            ],
            [
                'name'         => 'Combo Valluno',
                'description'  => '⚠️⚠️COMBO VALLUNO⚠️⚠️ Disfruta de 4 crujientes empanadas rellenas de papa 🥔 y carne desmechada🥩, 4 marranitas 🐷(patacon relleno chicharron) y 2 avenas caleñas🧊 en empaque pet sellado de 250ml. Te las llevamos a 🏡 con aji criollo 🥵 y salsa casera tipo chimichurri 😏. Que esperas? Haz tu pedido ahora',
                'price'        => 35000,
                'is_active'    => true,
                'is_featured'  => false,
                'sort_order'   => 11,
                'size'         => 'tradicional',
            ],
            [
                'name'         => 'Combo Marranitas',
                'description'  => 'Disfruta de esta delicia valluna ‼️COMBO MARRANITAS‼️
                 💯Deliciosas bolitas de plátano verde rellenas del crujiente chicharrón🤤. Y siempre es mejor acompañadas de aji criollo y nuestra exquisita salsa casera tipo chimichurri.',
                'price'        => 30000,
                'is_active'    => true,
                'is_featured'  => false,
                'sort_order'   => 12,
                'size'         => 'tradicional',
            ],
            [
                'name'         => 'Avena Caleña',
                'description'  => 'Deliciosa avena helada hecha en pura leche, con harina de avena y aliños dulces como canela, clavo de olor y panela. Perfecta para acompañar tus empanadas o simplemente para disfrutarla sola. Pide tu domicilio ahora y disfruta de esta delicia en casa! 🏡🛵😎',
                'price'        => 5500,
                'is_active'    => true,
                'is_featured'  => false,
                'sort_order'   => 13,
                'size'         => 'adiciones',
            ],
            [
                'name'         => 'Masato de Arroz frio',
                'description'  => 'Deliciosa receta de masato de arroz tradicional Bien frio',
                'price'        => 5500,
                'is_active'    => true,
                'is_featured'  => false,
                'sort_order'   => 14,
                'size'         => 'adiciones',
            ],
            [
                'name'         => 'Combo Tolimense',
                'description'  => '12 Crujientes empanadas de maíz, rellenas de puré de papa con riogo y trozos de pollo desmechado, acompañadas de aji criollo y salsa casera tipo chimichurri. Pide tu domicilio ahora y disfruta de esta delicia en casa! 🏡🛵😎',
                'price'        => 35000,
                'is_active'    => true,
                'is_featured'  => false,
                'sort_order'   => 14,
                'size'         => 'tradicional',
            ],
            
        ];

        $approvedNames = collect($combos)->pluck('name')->all();

        Combo::whereNotIn('name', $approvedNames)->delete();

        // Nota: image e image_url se omiten intencionalmente para
        // no sobrescribir las imágenes subidas desde el admin.
        foreach ($combos as $data) {
            Combo::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }

        // ==========================================
        // 2. TESTIMONIOS
        // ==========================================
        $testimonials = [
            [
                'name' => 'María González',
                'role' => 'Estudiante',
                'rating' => 5,
                'avatar_emoji' => '😊',
                'text' => 'Las empanadas de Bocaditos Criollos son increíbles. Crujientes por fuera, jugosas por dentro. ¡Altamente recomendado!',
                'is_approved' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Carlos Rodríguez',
                'role' => 'Trabajador Independiente',
                'rating' => 5,
                'avatar_emoji' => '👨‍💼',
                'text' => 'Perfecto para mi almuerzo rápido. La comida llega en menos de 15 minutos y siempre está caliente. Vuelvo cada semana.',
                'is_approved' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Ana Martínez',
                'role' => 'Mamá Emprendedora',
                'rating' => 5,
                'avatar_emoji' => '👩',
                'text' => 'Mis hijos aman las salchipapas. Comida rápida hecha con calidad. Ingredientes frescos y porciones generosas.',
                'is_approved' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::updateOrCreate(
                ['name' => $data['name'], 'text' => $data['text']],
                $data
            );
        }

        // ==========================================
        // 3. USUARIO ADMIN
        // ==========================================
        User::updateOrCreate(
            ['email' => 'nuestrosbocaditoscriollos@gmail.com'],
            [
                'name' => 'Admin Bocaditos Criollos',
                'password' => Hash::make('maryory1984'),
                'email_verified_at' => now(),
            ]
        );
    }
}
