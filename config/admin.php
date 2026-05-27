<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Configuration
    |--------------------------------------------------------------------------
    |
    | Configuración del panel de administración protegido por contraseña.
    |
    */

    'password' => env('ADMIN_PASSWORD'),

    'email' => env('ADMIN_NOTIFICATION_EMAIL', 'nuestrosbocaditoscriollos@gmail.com'),

    /*
    |--------------------------------------------------------------------------
    | Session Lifetime
    |--------------------------------------------------------------------------
    |
    | Tiempo máximo de inactividad en minutos antes de cerrar sesión
    | automáticamente. Por defecto: 30 minutos.
    |
    */

    'session_lifetime' => env('ADMIN_SESSION_LIFETIME', 30),
];
