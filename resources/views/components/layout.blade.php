<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    {{-- SEO Meta Tags --}}
    <meta name="description" content="Bocaditos Criollos - Auténtica comida colombiana en Engativá, Bogotá. Empanadas, pasteles, arepas y más. ¡Delicioso y hecho con amor!">
    <meta name="keywords" content="comida colombiana, empanadas, pasteles, arepas, fast food, Engativá, Bogotá">
    <meta name="author" content="Bocaditos Criollos">
    <meta name="robots" content="index, follow">
    
    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ $title ?? 'Bocaditos Criollos - Auténtica Comida Colombiana' }}">
    <meta property="og:description" content="Disfruta de auténticos bocaditos criollos colombianos. Empanadas, pasteles, arepas y más.">
    <meta property="og:image" content="{{ url('/images/og-image.jpg') }}">
    <meta property="og:locale" content="es_CO">
    <meta property="og:site_name" content="Bocaditos Criollos">
    
    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/') }}">
    <meta name="twitter:title" content="Bocaditos Criollos">
    <meta name="twitter:description" content="Auténtica comida colombiana">
    <meta name="twitter:image" content="{{ url('/images/twitter-image.jpg') }}">
    
    {{-- Canonical & Theme --}}
    <link rel="canonical" href="{{ url('/') }}">
    <meta name="theme-color" content="#B8341D">
    <meta name="msapplication-TileColor" content="#B8341D">
    
    {{-- Favicon & Icons --}}
    <link rel="icon" type="image/png" href="{{ url('/images/favicon-96x96.png?v=' . time()) }}" sizes="96x96">
    <link rel="shortcut icon" href="{{ url('/images/favicon-96x96.png?v=' . time()) }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ url('/images/favicon-96x96.png?v=' . time()) }}" sizes="96x96">
    
    {{-- Preconnect & DNS Prefetch --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    
    {{-- Font Preload (Async Loading - Opción A: Preload + onload async + noscript fallback) --}}
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&display=swap"></noscript>
    
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"></noscript>
    
    {{-- Font Fallback (JetBrains Mono - via stylesheet) --}}
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <title>{{ $title ?? 'Bocaditos Criollos - Auténtica Comida Colombiana' }}</title>
    
    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-elegant-black text-cream">
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    @include('components.footer')
</body>
</html>
