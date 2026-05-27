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

    // Google Maps (enlace externo para navegación)
    'google_maps_url' => 'https://maps.google.com/?q=4.6917865806312635,-74.10957991132996',

    // OpenStreetMap Embed (gratuito, sin API key)
    'osm_embed_url' => 'https://www.openstreetmap.org/export/embed.html?bbox=-74.11258%2C4.68879%2C-74.10658%2C4.69479&layer=mapnik&marker=4.69179%2C-74.10958',

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
    'email' => 'nuestrosbocaditoscriollos@gmail.com',
    'social' => [
        'whatsapp' => 'https://wa.me/573138513658',
        'instagram' => 'https://www.instagram.com/bocaditoscriollos/',
        'facebook' => 'https://www.facebook.com/Bocaditos-Criollos-1487704988144414/',
    ],
];
