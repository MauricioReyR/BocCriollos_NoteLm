<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    {{-- SEO Meta Tags --}}
    <meta name="description" content="{{ $metaDescription ?? '🥟 Bocaditos Criollos - Auténtica comida colombiana en Engativá, Bogotá. Empanadas, pasteles, arepas, combos y más. Entrega a domicilio y tienda física.' }}">
    <meta name="keywords" content="comida colombiana, empanadas, pasteles de yuca, arepas, aborrajados, hamburguesas, comida rápida, Engativá, Bogotá, domicilios">
    <meta name="author" content="Bocaditos Criollos">
    <meta name="robots" content="index, follow">
    <meta name="format-detection" content="telephone=yes">
    
    {{-- Open Graph / Facebook / LinkedIn / WhatsApp --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ $title ?? 'Bocaditos Criollos - Auténtica Comida Colombiana' }}">
    <meta property="og:description" content="{{ $metaDescription ?? '🥟 Empanadas criollas, pasteles de yuca, arepas trifásicas y combos familiares. ¡Pide ahora en Engativá, Bogotá! 🛵 Entrega a domicilio.' }}">
    <meta property="og:image" content="{{ url('/images/og-image.jpg') . '?v=' . (file_exists(public_path('images/og-image.jpg')) ? filemtime(public_path('images/og-image.jpg')) : '1') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Bocaditos Criollos - Auténtica Comida Colombiana">
    <meta property="og:locale" content="es_CO">
    <meta property="og:site_name" content="Bocaditos Criollos">
    
    {{-- Business Contact Data (Facebook / Google) --}}
    <meta property="business:contact_data:street_address" content="{{ config('store.address') }}">
    <meta property="business:contact_data:locality" content="{{ config('store.city') }}">
    <meta property="business:contact_data:region" content="{{ config('store.neighborhood') }}">
    <meta property="business:contact_data:country_name" content="Colombia">
    <meta property="business:contact_data:phone_number" content="+57 {{ config('store.phone') }}">
    <meta property="business:contact_data:email" content="{{ config('store.email') }}">
    
    {{-- Schema.org JSON-LD Structured Data (LocalBusiness) --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "Bocaditos Criollos",
      "description": "{{ $metaDescription ?? 'Auténtica comida rápida tradicional colombiana en Engativá, Bogotá. Empanadas, pasteles de yuca, arepas trifásicas, aborrajados y combos familiares.' }}",
      "url": "{{ url('/') }}",
      "telephone": "+57 {{ config('store.phone') }}",
      "email": "{{ config('store.email') }}",
      "image": "{{ url('/images/og-image.jpg') }}",
      "priceRange": "$",
      "servesCuisine": "Colombian",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ config('store.address') }}",
        "addressLocality": "{{ config('store.city') }}",
        "addressRegion": "{{ config('store.neighborhood') }}",
        "addressCountry": "CO"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": {{ config('store.latitude') }},
        "longitude": {{ config('store.longitude') }}
      },
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          "opens": "08:30",
          "closes": "20:00"
        },
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Sunday"],
          "opens": "14:00",
          "closes": "18:00"
        }
      ],
      "sameAs": [
        "{{ config('store.social.instagram') }}",
        "{{ config('store.social.facebook') }}",
        "{{ config('store.social.whatsapp') }}"
      ]
    }
    </script>

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/') }}">
    <meta name="twitter:title" content="{{ $title ?? 'Bocaditos Criollos - Auténtica Comida Colombiana' }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? '🥟 Empanadas criollas, pasteles de yuca, arepas trifásicas y combos familiares. ¡Pide ahora en Engativá, Bogotá! 🛵' }}">
    <meta name="twitter:image" content="{{ url('/images/og-image.jpg') . '?v=' . (file_exists(public_path('images/og-image.jpg')) ? filemtime(public_path('images/og-image.jpg')) : '1') }}">
    
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
