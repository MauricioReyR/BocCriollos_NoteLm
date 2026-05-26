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
          <img src="{{ asset('images/logo_60x60.png') }}" alt="Bocaditos Criollos" class="w-[30px] h-[30px] object-contain rounded-full" style="width:30px;height:30px" width="30" height="30">
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
        <a href="#testimonios" data-nav-link="testimonios" class="text-cream hover:text-warm-orange-500 transition-colors duration-300 text-sm font-medium">
          Testimonios
        </a>
      </div>

      {{-- CTA Button (Desktop) with Tooltip --}}
      <div class="hidden md:flex items-center gap-4">
        <div class="relative group/tooltip">
          <a 
            href="{{ whatsapp_url('Hola%20Bocaditos%20Criollos%2C%20me%20gustar%C3%ADa%20hacer%20un%20pedido') }}"
            target="_blank"
            rel="noopener noreferrer"
            aria-describedby="whatsapp-tooltip"
            class="btn btn-primary"
          >
            <span>📱 Ordenar</span>
          </a>
          {{-- Tooltip --}}
          <div 
            id="whatsapp-tooltip"
            class="absolute bottom-full left-1/2 -translate-x-1/2 mb-3 pointer-events-none opacity-0 group-hover/tooltip:opacity-100 transition-all duration-300 translate-y-1 group-hover/tooltip:translate-y-0"
            role="tooltip"
          >
            <div class="relative bg-elegant-black/95 backdrop-blur-xl border border-white/10 rounded-lg px-3 py-1.5 shadow-xl whitespace-nowrap">
              <div class="flex items-center gap-1.5 text-xs text-cream">
                <svg class="w-3.5 h-3.5 text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.272-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378c-3.055 2.291-3.89 6.887-1.9 10.427 1.832 3.325 5.635 5.187 9.315 4.874.614-.057 1.221-.174 1.814-.356l.04-.013c3.34-.935 5.82-3.839 6.487-7.324.466-2.459.216-5.532-1.308-7.701-1.608-2.27-4.045-3.5-6.5-3.5l-.077.001c-1.564.038-3.091.3-4.54.923zm0 0"/>
                </svg>
                <span>Pedido por <span class="text-green-400 font-semibold">WhatsApp</span></span>
              </div>
              {{-- Arrow --}}
              <div class="absolute left-1/2 -translate-x-1/2 top-full w-0 h-0 border-4 border-transparent border-t-elegant-black/95"></div>
            </div>
          </div>
        </div>
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
