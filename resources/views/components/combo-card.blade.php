{{-- Combo Card Component - Simple y Visual --}}
@props([
    'featured' => false,
    'name' => '',
    'description' => '',
    'price' => 0,
    'imageUrl' => null,
    'size' => null,
])

<div 
  class="group relative h-full animate-fade-in"
  data-animate
>
  {{-- Card Container --}}
  <div class="glass rounded-2xl overflow-hidden h-full flex flex-col transition-all duration-300 hover:border-warm-orange-500/80 hover:bg-warm-orange-500/5 hover:shadow-premium-lg @if($featured) ring-2 ring-warm-orange-500/40 @endif">
    
    {{-- Image Container --}}
    <div class="relative h-48 sm:h-56 md:h-64 overflow-hidden bg-gradient-to-br from-warm-orange-600 to-warm-orange-900">
      
      {{-- Badge Container --}}
      <div class="absolute top-3 left-3 z-10 flex flex-col gap-2">
        @if($featured)
          <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gradient-to-r from-warm-orange-500 to-burnt-red-500 text-elegant-black text-xs font-bold shadow-lg">
            <span>⭐</span>
            <span>Más pedido</span>
          </span>
        @endif
        @if($size === 'tradicional')
          <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-elegant-black/80 backdrop-blur-md border border-warm-orange-500/60 text-warm-orange-400 text-xs font-bold shadow-lg">
            <span>🥟</span>
            <span>Tradicional</span>
          </span>
        @elseif($size === 'bocado')
          <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-elegant-black/80 backdrop-blur-md border border-soft-gold/60 text-soft-gold text-xs font-bold shadow-lg">
            <span>🌮</span>
            <span>Bocado</span>
          </span>
        @elseif($size === 'adiciones')
          <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-elegant-black/80 backdrop-blur-md border border-green-500/60 text-green-400 text-xs font-bold shadow-lg">
            <span>🥤</span>
            <span>Adición</span>
          </span>
        @endif
      </div>

      @if($imageUrl ?? false)
        {{-- Real Image --}}
        <img 
          src="{{ $imageUrl }}" 
          alt="{{ $name }}" 
          class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
          loading="lazy"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
      @else
        {{-- Gradient Background with icon overflow --}}
        <div class="absolute inset-0 bg-gradient-to-br from-warm-orange-500/20 to-burnt-red-500/20"></div>
        <div class="absolute inset-0 flex items-center justify-center">
          <span class="text-7xl md:text-8xl opacity-30 select-none">🎁</span>
        </div>
      @endif

      {{-- Price Badge --}}
      <div class="absolute bottom-4 right-4">
        <span class="inline-flex items-center px-4 py-2 rounded-xl bg-elegant-black/80 backdrop-blur-md text-warm-orange-400 font-bold text-xl shadow-lg">
          ${{ number_format($price, 0, ',', '.') }}
        </span>
      </div>

      {{-- Hover Shine Effect --}}
      <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent translate-x-full group-hover:translate-x-0 transition-transform duration-700 pointer-events-none"></div>
    </div>

    {{-- Content Container --}}
    <div class="flex-1 p-5 sm:p-6 flex flex-col justify-between">
      
      {{-- Title & Description --}}
      <div>
        <h3 class="text-xl sm:text-2xl font-display font-bold text-cream mb-3 group-hover:text-warm-orange-400 transition-colors duration-300">
          {{ $name }}
        </h3>
        
        {{-- Description --}}
        @if($description ?? false)
          <p class="text-sm sm:text-base text-gray-400 leading-relaxed">
            {{ $description }}
          </p>
        @endif
      </div>

      {{-- CTA Button --}}
      <div class="mt-5 pt-5 border-t border-white/10">
        <a 
          href="{{ whatsapp_url('Quiero%20' . urlencode($name)) }}"
          target="_blank"
          rel="noopener noreferrer"
          class="flex items-center justify-center gap-2 w-full px-5 py-3 rounded-xl bg-warm-orange-500/20 text-warm-orange-400 hover:bg-warm-orange-500 hover:text-elegant-black font-bold transition-all duration-300 group/btn"
        >
          <svg class="w-5 h-5 group-hover/btn:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.272-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378c-3.055 2.291-3.89 6.887-1.9 10.427 1.832 3.325 5.635 5.187 9.315 4.874.614-.057 1.221-.174 1.814-.356l.04-.013c3.34-.935 5.82-3.839 6.487-7.324.466-2.459.216-5.532-1.308-7.701-1.608-2.27-4.045-3.5-6.5-3.5l-.077.001c-1.564.038-3.091.3-4.54.923zm0 0\"/>
          </svg>
          <span>Pedir este Combo</span>
          <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
          </svg>
        </a>
      </div>

    </div>

  </div>
</div>
