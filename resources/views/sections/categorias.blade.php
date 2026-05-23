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
    <div class="max-w-3xl mx-auto text-center mb-16 animate-fade-in" data-animate>
      <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-burnt-red-500/20 border border-burnt-red-500/50 mb-4">
        <span class="text-burnt-red-500 font-semibold text-sm">🏷️ CATEGORÍAS</span>
      </span>
      
      <h2 class="text-4xl sm:text-5xl md:text-6xl font-display font-bold text-cream mb-4">
        Explorar por Tamaños
      </h2>
      
      <p class="text-lg text-gray-400">
        Encuentra exactamente lo que buscas en nuestras principales categorías de comida rápida tradicional
      </p>
    </div>

    {{-- Categories Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      
      @forelse($categories ?? [] as $category)
        <x-category-card
          name="{{ $category->name }}"
          count="{{ $category->products_count }}"
          icon="{{ $category->icon ?? '🍔' }}"
          gradient="{{ $category->gradient }}"
        />
      @empty
        {{-- Hardcoded fallback --}}
        <x-category-card
          name="Empanadas Tradicionales y Bocado "
          count="3"
          icon="🥟"
          gradient="from-burnt-red-600 to-burnt-red-800"
        />
        <x-category-card
          name="Pasteles de Yuca tipo Bocado"
          count="2"
          icon="🥐"
          gradient="from-warm-orange-600 to-warm-orange-800"
        />
        <x-category-card
          name="Hamburguesas"
          count="4"
          icon="🍔"
          gradient="from-burnt-red-700 to-burnt-red-900"
        />
        <x-category-card
          name="Arepas Trifasicas Tradicionales y Tipo Bocado"
          count="2"
          icon="🍘"
          gradient="from-warm-orange-700 to-orange-900"
        />
        <x-category-card
          name="Aborrajados"
          count="3"
          icon="🫔"
          gradient="from-burnt-red-500 to-orange-700"
        />
        <x-category-card
          name="Bebidas Masato y Avena Caleña"
          count="2"
          icon="🥤"
          gradient="from-warm-orange-600 to-burnt-red-700"
        />
      @endforelse

    </div>

    {{-- Info Section --}}
    <div class="mt-16 p-8 md:p-12 rounded-2xl bg-elegant-black/50 border border-white/10 backdrop-blur-md text-center animate-fade-in" data-animate style="animation-delay: 0.2s;">
      <p class="text-lg text-gray-300 mb-6">
        ¿No encuentras una categoría específica?
      </p>
      
      <a 
        href="https://wa.me/573001234567?text=Hola%20Bocaditos%20Criollos%2C%20me%20gustar%C3%ADa%20conocer%20todas%20sus%20categor%C3%ADas"
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
