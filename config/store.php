<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Store Information
    |--------------------------------------------------------------------------
    |
    | Datos centralizados de la tienda física Bocaditos Criollos.
    | Reutilizado en CTA, footer y cualquier componente que necesite
    | información de contacto o ubicación.
    |
    */

    'name' => 'Bocaditos Criollos',
    'slogan' => 'Auténtica Comida Colombiana',

    // Dirección física
    'address' => 'Carrera 87 # 68 - 91, Local esquina',
    'neighborhood' => 'Engativá',
    'city' => 'Bogotá',
    'full_address' => 'Carrera 87 # 68 - 91, Local esquina, Engativá, Bogotá',

    // Coordenadas geográficas
    'latitude' => 4.6917865806312635,
    'longitude' => -74.10957991132996,

    // Google Maps
    'google_maps_url' => 'https://maps.google.com/?q=4.6917865806312635,-74.10957991132996',
    'google_maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d0!2d-74.10957991132996!3d4.6917865806312635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNMKwNDEnMzAuNCJOIDc0wrAwNiczNC41Ilc!5e0!3m2!1ses!2sco!4v1',

    // WhatsApp
    'phone' => '3138513658',
    'whatsapp_number' => '573138513658',
    'whatsapp_url' => 'https://wa.me/573138513658',
    'whatsapp_message' => 'Hola%20Bocaditos%20Criollos%2C%20quiero%20hacer%20mi%20pedido%20ahora',
    'whatsapp_full_url' => 'https://wa.me/573138513658?text=Hola%20Bocaditos%20Criollos%2C%20quiero%20hacer%20mi%20pedido%20ahora',

    // Horarios de atención
    'hours' => [
        'weekdays' => [
            'label' => 'Lunes - Sábado',
            'hours' => '8:30 AM - 8:00 PM',
        ],
        'weekends' => [
            'label' => 'Domingos y Festivos',
            'hours' => '2:00 PM - 6:00 PM',
            'note' => 'Solo envíos a domicilio',
        ],
    ],

    // Redes sociales
    'email' => 'info@bocaditos.co',
    'social' => [
        'whatsapp' => 'https://wa.me/573138513658',
        'instagram' => 'https://www.instagram.com/bocaditoscriollos/',
        'facebook' => 'https://www.facebook.com/Bocaditos-Criollos-1487704988144414/',
    ],
];
