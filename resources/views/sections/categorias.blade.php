{{-- Categorías Section --}}
<section id="categorias" class="relative py-20 md:py-32 bg-warm-gray overflow-hidden">
  
  {{-- Background Decorative Elements --}}
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 right-1/3 w-96 h-96 bg-burnt-red-500 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-warm-orange-500 rounded-full blur-3xl"></div>
  </div>

  {{-- Content Container --}}
  <div class="relative z-10 container-premium">
    
    {{-- Section Header --}}
    <div class="max-w-3xl mx-auto text-center mb-16" data-scroll-reveal="bottom" data-delay="0">
      <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-burnt-red-500/20 border border-burnt-red-500/50 mb-6">
        <span class="text-burnt-red-400 font-bold text-sm uppercase tracking-widest">🏷️ Categorías</span>
      </span>
      
      <div class="relative mb-6">
        <h2 class="text-5xl sm:text-6xl md:text-7xl font-display font-black text-cream leading-tight">
          Explora por <span class="gradient-text">Categorías</span>
        </h2>
        <div class="mt-4 flex items-center justify-center gap-3">
          <span class="block w-12 h-0.5 bg-gradient-to-r from-transparent to-burnt-red-500/60"></span>
          <span class="block w-2 h-2 rotate-45 bg-burnt-red-500"></span>
          <span class="block w-12 h-0.5 bg-gradient-to-r from-burnt-red-500/60 to-transparent"></span>
        </div>
      </div>
      
      <p class="text-lg md:text-xl text-gray-400 leading-relaxed max-w-2xl mx-auto">
        Encuentra exactamente lo que buscas en nuestras principales categorías de comida rápida tradicional
      </p>
    </div>

    {{-- Categories Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      
      @forelse($categories ?? [] as $category)
        <x-category-card
          data-scroll-reveal="bottom"
          data-delay="{{ ($loop->index ?? 0) * 150 }}"
          name="{{ $category->name }}"
          count="{{ $category->products_count }}"
          icon="{{ $category->icon ?? '🍔' }}"
          gradient="{{ $category->gradient }}"
          slug="{{ $category->slug }}"
        />
      @empty
        {{-- Hardcoded fallback --}}
        <x-category-card
          data-scroll-reveal="bottom"
          data-delay="0"
          name="Empanadas"
          count="2"
          icon="🥟"
          gradient="from-burnt-red-600 to-burnt-red-800"
          slug="empanadas"
        />
        <x-category-card
          data-scroll-reveal="bottom"
          data-delay="150"
          name="Pasteles de Yuca"
          count="2"
          icon="🥐"
          gradient="from-warm-orange-600 to-warm-orange-800"
          slug="pasteles"
        />
        <x-category-card
          data-scroll-reveal="bottom"
          data-delay="300"
          name="Hamburguesas"
          count="3"
          icon="🍔"
          gradient="from-burnt-red-700 to-burnt-red-900"
          slug="hamburguesas"
        />
        <x-category-card
          data-scroll-reveal="bottom"
          data-delay="450"
          name="Arepas Trifásicas"
          count="2"
          icon="🍘"
          gradient="from-warm-orange-700 to-orange-900"
          slug="arepas"
        />
        <x-category-card
          data-scroll-reveal="bottom"
          data-delay="600"
          name="Aborrajados"
          count="2"
          icon="🫔"
          gradient="from-burnt-red-500 to-orange-700"
          slug="aborrajados"
        />
        <x-category-card
          data-scroll-reveal="bottom"
          data-delay="750"
          name="Bebidas"
          count="2"
          icon="🥤"
          gradient="from-warm-orange-600 to-burnt-red-700"
          slug="bebidas"
        />
      @endforelse

    </div>

    {{-- Info Section --}}
    <div class="mt-16 p-8 md:p-12 rounded-2xl bg-elegant-black/50 border border-white/10 backdrop-blur-md text-center" data-scroll-reveal="bottom" data-delay="300">
      <p class="text-lg text-gray-300 mb-6">
        ¿No encuentras una categoría específica?
      </p>
      
      <a 
        href="{{ whatsapp_url('Hola%20Bocaditos%20Criollos%2C%20me%20gustar%C3%ADa%20conocer%20todas%20sus%20categor%C3%ADas') }}"
        target="_blank"
        rel="noopener noreferrer"
        class="inline-flex items-center gap-2 btn btn-primary"
      >
        <span>📞 Contáctanos</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
        </svg>
      </a>
    </div>

  </div>

</section>
