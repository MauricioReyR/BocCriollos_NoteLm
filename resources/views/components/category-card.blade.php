{{-- Category Card Component --}}
<div 
  class="group relative h-full animate-fade-in"
  data-animate
>
  {{-- Card Container --}}
  <div 
    class="relative h-32 sm:h-40 md:h-48 rounded-2xl overflow-hidden cursor-pointer transition-all duration-300 hover:shadow-premium-lg"
    @click="smoothScroll('productos')"
  >
    {{-- Background Gradient --}}
    <div class="absolute inset-0 bg-gradient-to-br {{ $gradient ?? 'from-burnt-red-500 to-warm-orange-600' }}">
      {{-- Overlay --}}
      <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition-all duration-300"></div>
    </div>

    {{-- Decorative Icon Background --}}
    <div class="absolute -right-10 -bottom-10 text-8xl opacity-20 group-hover:opacity-30 transition-opacity duration-300">
      {{ $icon ?? '🍔' }}
    </div>

    {{-- Content --}}
    <div class="relative z-10 h-full flex flex-col justify-between p-6 text-cream">
      
      {{-- Category Name --}}
      <div>
        <h3 class="text-2xl sm:text-3xl md:text-4xl font-display font-bold group-hover:text-warm-orange-400 transition-colors duration-300">
          {{ $name }}
        </h3>
      </div>

      {{-- Product Count & Arrow --}}
      <div class="flex items-end justify-between">
        <div class="flex items-baseline gap-2">
          <span class="text-4xl sm:text-5xl font-bold text-warm-orange-400">{{ $count }}</span>
          <span class="text-sm text-gray-300 mb-1">producto{{ $count != 1 ? 's' : '' }}</span>
        </div>
        
        {{-- Arrow Icon --}}
        <div class="opacity-0 group-hover:opacity-100 transform group-hover:translate-x-2 transition-all duration-300">
          <svg class="w-6 h-6 text-warm-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
          </svg>
        </div>
      </div>

    </div>

    {{-- Hover Border --}}
    <div class="absolute inset-0 border-2 border-warm-orange-500/0 group-hover:border-warm-orange-500/50 rounded-2xl transition-all duration-300 pointer-events-none"></div>

  </div>
</div>
