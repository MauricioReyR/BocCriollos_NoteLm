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

      {{-- Menu Desktop (hidden en mobile, será completado en próximas fases) --}}
      <div class="hidden md:flex items-center gap-8">
        <a href="#hero" class="text-cream hover:text-warm-orange-500 transition-colors duration-300 text-sm font-medium">
          Inicio
        </a>
        <a href="#productos" class="text-cream hover:text-warm-orange-500 transition-colors duration-300 text-sm font-medium">
          Productos
        </a>
        <a href="#categorias" class="text-cream hover:text-warm-orange-500 transition-colors duration-300 text-sm font-medium">
          Categorías
        </a>
        <a href="#testimonios" class="text-cream hover:text-warm-orange-500 transition-colors duration-300 text-sm font-medium">
          Testimonios
        </a>
      </div>

      {{-- CTA Button (Desktop) --}}
      <div class="hidden md:flex items-center gap-4">
        <button class="btn btn-primary">
          <span>📱 Ordenar</span>
        </button>
      </div>

      {{-- Mobile Menu Toggle (placeholder - será implementado en próxima fase) --}}
      <button class="md:hidden text-cream hover:text-warm-orange-500 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>

    </div>
  </div>
</nav>
