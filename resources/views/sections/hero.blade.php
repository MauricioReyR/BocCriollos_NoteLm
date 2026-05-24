{{-- Hero Section Premium --}}
<section 
  id="hero"
  class="relative min-h-screen w-full overflow-hidden flex items-center justify-center bg-gradient-to-br from-burnt-red-900 via-burnt-red-800 to-warm-orange-900"
>
  {{-- Background Decorative Elements --}}
  <div class="absolute inset-0 opacity-20">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-warm-orange-500 rounded-full blur-3xl animate-float" data-parallax="0.3"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-burnt-red-500 rounded-full blur-3xl animate-float" style="animation-delay: 2s;" data-parallax="0.15"></div>
  </div>

  {{-- Dark Overlay for Text Readability --}}
  <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

  {{-- Content Container --}}
  <div class="relative z-10 container-premium text-center px-4 py-20">
    
    {{-- Top Badge --}}
    <div 
      class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-warm-orange-500/20 border border-warm-orange-500/50 mb-8 animate-fade-in"
      style="animation-delay: 0.2s;"
    >
      <span class="text-warm-orange-500 font-semibold text-sm">⭐ Desde 2000</span>
    </div>

    {{-- Main Heading --}}
    <h1 
      class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-display font-black mb-6 animate-fade-in"
      style="animation-delay: 0.4s;"
    >
      <span class="block text-cream">Bocaditos</span>
      <span class="block gradient-text">Criollos</span>
    </h1>

    {{-- Subheading --}}
    <p 
      class="text-lg sm:text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto mb-8 animate-fade-in font-light"
      style="animation-delay: 0.6s;"
    >
      Auténtica comida rápida tradicional colombiana.
      <span class="block mt-2 text-warm-orange-400">Hecha con corazón, servida con orgullo.</span>
    </p>

    {{-- CTA Buttons --}}
    <div 
      class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12 animate-fade-in"
      style="animation-delay: 0.8s;"
    >
      {{-- Primary CTA --}}
      <a 
        href="{{ whatsapp_url('Hola%20Bocaditos%20Criollos%2C%20me%20gustaría%20hacer%20un%20pedido') }}"
        target="_blank"
        rel="noopener noreferrer"
        class="btn btn-primary lg:px-8 lg:py-4 lg:text-lg group"
      >
        <span class="flex items-center gap-2">
          <span>📱 Ordenar por WhatsApp</span>
          <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
          </svg>
        </span>
      </a>

      {{-- Secondary CTA --}}
      <button 
        class="btn btn-outline"
        @click="smoothScroll('productos')"
      >
        Explorar Menú
      </button>
    </div>

    {{-- Trust Indicators --}}
    <div 
      class="flex flex-col sm:flex-row items-center justify-center gap-8 text-sm text-gray-300 animate-fade-in"
      style="animation-delay: 1s;"
    >
      <div class="flex items-center gap-2">
        <span class="text-2xl">⚡</span>
        <span>Entrega Rápida</span>
      </div>
      <div class="flex items-center gap-2">
        <span class="text-2xl">🌮</span>
        <span>Recetas Auténticas</span>
      </div>
      <div class="flex items-center gap-2">
        <span class="text-2xl">❤️</span>
        <span>Hecho con Amor</span>
      </div>
    </div>

  </div>

  {{-- Scroll Indicator (bonus) --}}
  <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
    <svg class="w-6 h-6 text-cream" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
    </svg>
  </div>

</section>
