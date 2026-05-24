<nav 
  x-data="{ 
    scrolled: false,
    mobileMenuOpen: false 
  }"
  @scroll.window="scrolled = window.scrollY > 50"
  :class="scrolled ? 'bg-elegant-black/80 backdrop-blur-xl border-b border-white/10' : 'bg-transparent'"
  class="sticky top-0 z-50 w-full transition-all duration-300"
>
  <div class="container-premium">
    <div class="flex items-center justify-between h-20">
      
      {{-- Logo / Branding --}}
      <div class="flex items-center gap-3 group cursor-pointer">
        <div class="relative">
          <div class="text-3xl">🍔</div>
          <div class="absolute inset-0 bg-warm-orange-500 rounded-full blur opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
        </div>
        <div class="hidden sm:flex flex-col">
          <span class="text-lg font-display font-bold text-cream">Bocaditos Criollos</span>
          <span class="text-xs text-warm-orange-500 font-medium">Auténtica Comida Colombiana</span>
        </div>
      </div>

      {{-- Menu Desktop --}}
      <div class="hidden md:flex items-center gap-8">
        <a href="#hero" data-nav-link="hero" class="text-cream hover:text-warm-orange-500 transition-colors duration-300 text-sm font-medium">
          Inicio
        </a>
        <a href="#combos" data-nav-link="combos" class="text-cream hover:text-warm-orange-500 transition-colors duration-300 text-sm font-medium">
          Combos
        </a>
        <a href="#productos" data-nav-link="productos" class="text-cream hover:text-warm-orange-500 transition-colors duration-300 text-sm font-medium">
          Productos
        </a>
        <a href="#categorias" data-nav-link="categorias" class="text-cream hover:text-warm-orange-500 transition-colors duration-300 text-sm font-medium">
          Categorías
        </a>
        <a href="#testimonios" data-nav-link="testimonios" class="text-cream hover:text-warm-orange-500 transition-colors duration-300 text-sm font-medium">
          Testimonios
        </a>
      </div>

      {{-- CTA Button (Desktop) --}}
      <div class="hidden md:flex items-center gap-4">
        <button class="btn btn-primary">
          <span>📱 Ordenar</span>
        </button>
      </div>

      {{-- Mobile Menu Toggle (Hamburguesa animada a X) --}}
      <button 
        @click="mobileMenuOpen = !mobileMenuOpen"
        :aria-expanded="mobileMenuOpen"
        aria-label="Menú de navegación"
        class="md:hidden relative w-10 h-10 flex items-center justify-center text-cream hover:text-warm-orange-500 transition-colors focus:outline-none focus:ring-2 focus:ring-warm-orange-500/50 rounded-lg"
      >
        <span class="sr-only">Menú de navegación</span>
        <div class="relative w-6 h-5">
          <span 
            class="absolute left-0 block w-full h-0.5 bg-current rounded-full transition-all duration-300 ease-out"
            :class="mobileMenuOpen ? 'top-1/2 -translate-y-1/2 rotate-45' : 'top-0'">
          </span>
          <span 
            class="absolute left-0 top-1/2 -translate-y-1/2 block w-full h-0.5 bg-current rounded-full transition-all duration-300 ease-out"
            :class="mobileMenuOpen ? 'opacity-0 scale-0' : 'opacity-100 scale-100'">
          </span>
          <span 
            class="absolute left-0 block w-full h-0.5 bg-current rounded-full transition-all duration-300 ease-out"
            :class="mobileMenuOpen ? 'top-1/2 -translate-y-1/2 -rotate-45' : 'bottom-0'">
          </span>
        </div>
      </button>

    </div>
  </div>

  {{-- Mobile Menu Panel --}}
  <div 
    x-show="mobileMenuOpen"
    x-transition:enter="transition-all duration-300 ease-out"
    x-transition:enter-start="opacity-0 -translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition-all duration-200 ease-in"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-4"
    x-cloak
    class="md:hidden absolute top-full left-0 w-full bg-elegant-black/95 backdrop-blur-xl border-t border-white/10 shadow-2xl"
  >
    <div class="container-premium py-6 space-y-1">
      <a href="#hero" 
         data-nav-link="hero"
         @click.prevent="window.smoothScroll('hero'); mobileMenuOpen = false"
         class="block px-4 py-3 rounded-xl text-cream hover:text-warm-orange-500 hover:bg-white/5 transition-all duration-300 text-base font-medium">
        <span class="inline-flex items-center gap-3">
          <span class="text-lg">🏠</span>
          Inicio
        </span>
      </a>
      <a href="#combos"
         data-nav-link="combos"
         @click.prevent="window.smoothScroll('combos'); mobileMenuOpen = false"
         class="block px-4 py-3 rounded-xl text-cream hover:text-warm-orange-500 hover:bg-white/5 transition-all duration-300 text-base font-medium">
        <span class="inline-flex items-center gap-3">
          <span class="text-lg">🍱</span>
          Combos
        </span>
      </a>
      <a href="#productos"
         data-nav-link="productos"
         @click.prevent="window.smoothScroll('productos'); mobileMenuOpen = false"
         class="block px-4 py-3 rounded-xl text-cream hover:text-warm-orange-500 hover:bg-white/5 transition-all duration-300 text-base font-medium">
        <span class="inline-flex items-center gap-3">
          <span class="text-lg">🍔</span>
          Productos
        </span>
      </a>
      <a href="#categorias"
         data-nav-link="categorias"
         @click.prevent="window.smoothScroll('categorias'); mobileMenuOpen = false"
         class="block px-4 py-3 rounded-xl text-cream hover:text-warm-orange-500 hover:bg-white/5 transition-all duration-300 text-base font-medium">
        <span class="inline-flex items-center gap-3">
          <span class="text-lg">📂</span>
          Categorías
        </span>
      </a>
      <a href="#testimonios"
         data-nav-link="testimonios"
         @click.prevent="window.smoothScroll('testimonios'); mobileMenuOpen = false"
         class="block px-4 py-3 rounded-xl text-cream hover:text-warm-orange-500 hover:bg-white/5 transition-all duration-300 text-base font-medium">
        <span class="inline-flex items-center gap-3">
          <span class="text-lg">⭐</span>
          Testimonios
        </span>
      </a>

      {{-- Divider --}}
      <div class="my-4 border-t border-white/10"></div>

      {{-- CTA Mobile --}}
      <a href="#cta-whatsapp"
         @click.prevent="window.smoothScroll('cta-whatsapp'); mobileMenuOpen = false"
         class="block w-full btn btn-primary text-center">
        <span class="inline-flex items-center gap-2">
          <span>📱</span>
          Ordenar Ahora
        </span>
      </a>
    </div>
  </div>

  {{-- Backdrop overlay --}}
  <div 
    x-show="mobileMenuOpen"
    x-transition.opacity.duration.300ms
    x-cloak
    class="md:hidden fixed inset-0 top-20 z-[-1] bg-black/60 backdrop-blur-sm"
    @click="mobileMenuOpen = false"
    aria-hidden="true">
  </div>

</nav>
