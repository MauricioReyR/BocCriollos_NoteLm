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
    <div class="max-w-3xl mx-auto text-center mb-16 animate-fade-in" data-animate>
      <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-warm-orange-500/20 border border-warm-orange-500/50 mb-4">
        <span class="text-warm-orange-500 font-semibold text-sm">⭐ DESTACADOS</span>
      </span>
      
      <h2 class="text-4xl sm:text-5xl md:text-6xl font-display font-bold text-cream mb-4">
        Nuestros Productos
      </h2>
      
      <p class="text-lg text-gray-400">
        Selección premium de comida rápida tradicional colombiana, preparada con los mejores ingredientes
      </p>
    </div>

    {{-- Products Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      
      @forelse($products ?? [] as $product)
        <x-product-card
          name="{{ $product->name }}"
          description="{{ $product->description }}"
          price="{{ $product->price }}"
          category="{{ $product->category?->name ?? 'Producto' }}"
          icon="{{ $product->icon ?? '🍔' }}"
          imageGradient="{{ $product->image_gradient }}"
        />
      @empty
        {{-- Hardcoded fallback --}}
        <x-product-card
          name="Empanadas Criollas"
          description="Empanadas caseras rellenas de carne molida, papa y cebolla. Crujientes por fuera, jugosas por dentro."
          price="12000"
          category="Empanadas"
          icon="🥟"
          imageGradient="from-burnt-red-600 to-warm-orange-700"
        />
        <x-product-card
          name="Pasteles de Yuca"
          description="Delicias de yuca rellena de queso derretido y carne. Textura suave y sabor inconfundible."
          price="14000"
          category="Pasteles"
          icon="🍠"
          imageGradient="from-warm-orange-600 to-burnt-red-700"
        />
        <x-product-card
          name="Hamburguesa Criolla"
          description="Hamburguesa artesanal con carne 100% angus, queso, aguacate, tomate y salsa especial."
          price="18000"
          category="Hamburguesas"
          icon="🍔"
          imageGradient="from-burnt-red-700 to-burnt-red-900"
        />
        <x-product-card
          name="Salchipapas Premium"
          description="Papas crujientes con salchichas fritas, queso derretido y salsas caseras variadas."
          price="16000"
          category="Salchipapas"
          icon="🍟"
          imageGradient="from-warm-orange-700 to-orange-800"
        />
        <x-product-card
          name="Arepa de Queso"
          description="Arepa recién hecha con queso blanco casero. Perfecta para desayuno o cualquier hora del día."
          price="10000"
          category="Arepas"
          icon="🥕"
          imageGradient="from-burnt-red-500 to-burnt-red-700"
        />
        <x-product-card
          name="Combo Familiar"
          description="4 empanadas + 2 pasteles + 1 hamburguesa + salchipapas + bebidas. Ideal para compartir."
          price="65000"
          category="Combos"
          icon="👨‍👩‍👧‍👦"
          imageGradient="from-warm-orange-600 to-warm-orange-900"
        />
      @endforelse

    </div>

    {{-- CTA Section --}}
    <div class="mt-16 text-center animate-fade-in" data-animate style="animation-delay: 0.2s;">
      <p class="text-gray-400 mb-6">
        ¿No ves lo que buscas?
      </p>
      
      <a 
        href="https://wa.me/573001234567?text=Hola%20Bocaditos%20Criollos%2C%20me%20gustar%C3%ADa%20conocer%20m%C3%A1s%20opciones"
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
