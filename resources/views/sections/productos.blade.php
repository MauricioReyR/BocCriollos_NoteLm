{{-- Productos Destacados Section --}}
<section id="productos" class="relative py-20 md:py-32 bg-elegant-black overflow-hidden">
  
  {{-- Background Decorative Elements --}}
  <div class="absolute inset-0 opacity-5">
    <div class="absolute top-20 right-0 w-96 h-96 bg-warm-orange-500 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 left-0 w-96 h-96 bg-burnt-red-500 rounded-full blur-3xl"></div>
  </div>

  {{-- Content Container --}}
  <div class="relative z-10 container-premium">
    
    {{-- Section Header --}}
    <div class="max-w-3xl mx-auto text-center mb-16" data-scroll-reveal="bottom" data-delay="0">
      <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-warm-orange-500/20 border border-warm-orange-500/50 mb-6">
        <span class="text-warm-orange-400 font-bold text-sm uppercase tracking-widest">⭐ Destacados</span>
      </span>
      
      <div class="relative mb-6">
        <h2 class="text-5xl sm:text-6xl md:text-7xl font-display font-black text-cream leading-tight">
          Nuestros <span class="gradient-text">Productos</span>
        </h2>
        <div class="mt-4 flex items-center justify-center gap-3">
          <span class="block w-12 h-0.5 bg-gradient-to-r from-transparent to-warm-orange-500/60"></span>
          <span class="block w-2 h-2 rotate-45 bg-warm-orange-500"></span>
          <span class="block w-12 h-0.5 bg-gradient-to-r from-warm-orange-500/60 to-transparent"></span>
        </div>
      </div>
      
      <p class="text-lg md:text-xl text-gray-400 leading-relaxed max-w-2xl mx-auto">
        Selección premium de comida rápida tradicional colombiana, preparada con los mejores ingredientes
      </p>

      {{-- Filter Indicator --}}
      <div 
        x-show="selectedCategory"
        x-transition.duration.300ms
        class="mt-8 flex items-center justify-center gap-3"
      >
        <span class="text-sm text-gray-400">Mostrando:</span>
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-warm-orange-500/20 border border-warm-orange-500/50 text-warm-orange-400 font-semibold text-sm">
          <span x-text="selectedCategory"></span>
          <button 
            @click="selectedCategory = null"
            class="ml-1 w-5 h-5 rounded-full bg-warm-orange-500/30 hover:bg-warm-orange-500/60 flex items-center justify-center transition-colors"
            aria-label="Quitar filtro"
          >
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </span>
        <button
          @click="selectedCategory = null"
          class="text-xs text-gray-500 hover:text-warm-orange-400 underline transition-colors"
        >
          Mostrar todos
        </button>
      </div>
    </div>

    {{-- Products Grid --}}
    <div 
      class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8"
      x-transition.duration.400ms
    >
      
      @forelse($products ?? [] as $product)
        <div
          x-show="!selectedCategory || selectedCategory === '{{ $product->category?->slug }}'"
          x-transition.duration.300ms.opacity
        >
          <x-product-card
            data-scroll-reveal="bottom"
            data-delay="{{ ($loop->index ?? 0) * 150 }}"
            name="{{ $product->name }}"
            description="{{ $product->description }}"
            price="{{ $product->price }}"
            category="{{ $product->category?->name ?? 'Producto' }}"
            icon="{{ $product->icon ?? '🍔' }}"
            imageGradient="{{ $product->image_gradient }}"
            imageUrl="{{ $product->image_url }}"
            :sizes="$product->sizes"
          />
        </div>
      @empty
        {{-- Hardcoded fallback --}}
        <div
          x-show="!selectedCategory || selectedCategory === 'empanadas'"
          x-transition.duration.300ms.opacity
        >
          <x-product-card
            data-scroll-reveal="bottom"
            data-delay="0"
            name="Empanadas Criollas"
            description="Empanadas caseras rellenas de carne molida, papa y cebolla. Crujientes por fuera, jugosas por dentro."
            price="12000"
            category="Empanadas"
            icon="🥟"
            imageGradient="from-burnt-red-600 to-warm-orange-700"
          />
        </div>
        <div
          x-show="!selectedCategory || selectedCategory === 'pasteles'"
          x-transition.duration.300ms.opacity
        >
          <x-product-card
            data-scroll-reveal="bottom"
            data-delay="150"
            name="Pasteles de Yuca"
            description="Delicias de yuca rellena de queso derretido y carne. Textura suave y sabor inconfundible."
            price="14000"
            category="Pasteles"
            icon="🍠"
            imageGradient="from-warm-orange-600 to-burnt-red-700"
          />
        </div>
        <div
          x-show="!selectedCategory || selectedCategory === 'hamburguesas'"
          x-transition.duration.300ms.opacity
        >
          <x-product-card
            data-scroll-reveal="bottom"
            data-delay="300"
            name="Hamburguesa Criolla"
            description="Hamburguesa artesanal con carne 100% angus, queso, aguacate, tomate y salsa especial."
            price="18000"
            category="Hamburguesas"
            icon="🍔"
            imageGradient="from-burnt-red-700 to-burnt-red-900"
          />
        </div>
        <div
          x-show="!selectedCategory || selectedCategory === 'hamburguesas'"
          x-transition.duration.300ms.opacity
        >
          <x-product-card
            data-scroll-reveal="bottom"
            data-delay="450"
            name="Salchipapas Premium"
            description="Papas crujientes con salchichas fritas, queso derretido y salsas caseras variadas."
            price="16000"
            category="Salchipapas"
            icon="🍟"
            imageGradient="from-warm-orange-700 to-orange-800"
          />
        </div>
        <div
          x-show="!selectedCategory || selectedCategory === 'arepas'"
          x-transition.duration.300ms.opacity
        >
          <x-product-card
            data-scroll-reveal="bottom"
            data-delay="600"
            name="Arepa de Queso"
            description="Arepa recién hecha con queso blanco casero. Perfecta para desayuno o cualquier hora del día."
            price="10000"
            category="Arepas"
            icon="🥕"
            imageGradient="from-burnt-red-500 to-burnt-red-700"
          />
        </div>
        <div
          x-show="!selectedCategory || selectedCategory === 'combos'"
          x-transition.duration.300ms.opacity
        >
          <x-product-card
            data-scroll-reveal="bottom"
            data-delay="750"
            name="Combo Familiar"
            description="4 empanadas + 2 pasteles + 1 hamburguesa + salchipapas + bebidas. Ideal para compartir."
            price="65000"
            category="Combos"
            icon="👨‍👩‍👧‍👦"
            imageGradient="from-warm-orange-600 to-warm-orange-900"
          />
        </div>
      @endforelse

    </div>

    {{-- CTA Section --}}
    <div class="mt-16 text-center" data-scroll-reveal="bottom" data-delay="300">
      <p class="text-gray-400 mb-6">
        ¿No ves lo que buscas?
      </p>
      
      <a 
        href="{{ whatsapp_url('Hola%20Bocaditos%20Criollos%2C%20me%20gustar%C3%ADa%20conocer%20m%C3%A1s%20opciones') }}"
        target="_blank"
        rel="noopener noreferrer"
        class="inline-flex items-center gap-2 btn btn-secondary"
      >
        <span>Ver Menú Completo</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
        </svg>
      </a>
    </div>

  </div>

</section>
