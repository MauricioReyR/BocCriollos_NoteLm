{{-- Product Card Component - Reutilizable --}}
<div 
  class="group relative h-full animate-fade-in"
  data-animate
  x-data="{ 
    expanded: false,
    selectedSize: '{{ ($sizes ?? null)?->first()?->slug ?? '' }}',
    basePrice: {{ $price ?? 0 }},
    sizeOptions: {{ ($sizes ?? collect())->isNotEmpty() ? json_encode(collect($sizes)->map(fn($s) => ['slug' => $s->slug, 'adjustment' => (float)$s->price_adjustment])->values()) : '[]' }}
  }"
>
  {{-- Card Container --}}
  <div class="glass rounded-2xl overflow-hidden h-full flex flex-col transition-all duration-300 hover:border-warm-orange-500/80 hover:bg-warm-orange-500/5 hover:shadow-premium-lg">
    
    {{-- Image Container --}}
    <div class="relative h-40 sm:h-48 overflow-hidden bg-gradient-to-br {{ $imageGradient ?? 'from-burnt-red-500 to-warm-orange-600' }}">
      
      @if($imageUrl ?? false)
        {{-- Real Image --}}
        <img 
          src="{{ $imageUrl }}" 
          alt="{{ $name }}" 
          class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
          loading="lazy"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent group-hover:from-black/80 group-hover:via-black/30 transition-all duration-300"></div>
      @else
        {{-- Emoji Fallback with Gradient --}}
        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition-all duration-300"></div>
        <div class="absolute inset-0 flex items-center justify-center">
          <span class="text-6xl group-hover:scale-110 transition-transform duration-300">{{ $icon ?? '🍔' }}</span>
        </div>
      @endif

      {{-- Category Badge --}}
      <div class="absolute top-3 right-3">
        <span class="inline-flex items-center px-3 py-1 rounded-full bg-warm-orange-500/90 text-elegant-black text-xs font-bold uppercase tracking-wide backdrop-blur-sm">
          {{ $category ?? 'Comida' }}
        </span>
      </div>

      {{-- Hover Shine Effect --}}
      <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent translate-x-full group-hover:translate-x-0 transition-transform duration-500 pointer-events-none"></div>
    </div>

    {{-- Content Container --}}
    <div class="flex-1 p-5 sm:p-6 flex flex-col justify-between">
      
      {{-- Title & Description --}}
      <div>
        <h3 class="text-lg sm:text-xl font-display font-bold text-cream mb-2 group-hover:text-warm-orange-400 transition-colors duration-300">
          {{ $name }}
        </h3>
        
        {{-- Description with Expand/Collapse --}}
        <div>
          <p 
            class="text-sm text-gray-400 break-words transition-all duration-300"
            :class="expanded ? '' : 'line-clamp-3'"
          >
            {{ $description }}
          </p>
          
          @if(mb_strlen(strip_tags($description ?? '')) > 100)
            <button 
              @click="expanded = !expanded"
              :aria-expanded="expanded"
              class="inline-flex items-center gap-1 text-xs text-warm-orange-400 hover:text-warm-orange-300 mt-1.5 transition-all duration-300 font-medium hover:underline underline-offset-2"
              x-text="expanded ? 'Ver menos ↑' : 'Ver más ↓'"
            >
            </button>
          @endif
        </div>
      </div>

      {{-- Footer: Price & CTA --}}
      <div class="mt-4 pt-4 border-t border-white/10">
        
        {{-- Size Selector (si el producto tiene tamaños) --}}
        @if(isset($sizes) && $sizes->isNotEmpty())
          <div class="flex flex-wrap gap-2 mb-3">
            @foreach($sizes as $size)
              <button 
                @click="selectedSize = '{{ $size->slug }}'"
                :class="selectedSize === '{{ $size->slug }}' ? 'bg-warm-orange-500/30 text-warm-orange-300 border-warm-orange-500' : 'bg-white/5 text-gray-400 border-white/10 hover:bg-white/10'"
                class="px-3 py-1.5 rounded-lg text-xs font-medium border transition-all duration-200"
              >
                {{ $size->name }}
              </button>
            @endforeach
          </div>
        @endif

        {{-- Price & CTA Row --}}
        <div class="flex items-center justify-between gap-4">
          
          {{-- Price --}}
          <div class="flex flex-col">
            <span class="text-xs text-gray-500 uppercase tracking-wide">Precio</span>
            @if(isset($sizes) && $sizes->isNotEmpty())
              {{-- Dynamic price with Alpine --}}
              <span 
                x-text="'$' + new Intl.NumberFormat('es-CO').format(sizeOptions.find(s => s.slug === selectedSize).adjustment + basePrice)"
                class="text-2xl font-bold text-warm-orange-400"
              >
                ${{ number_format($price, 0, ',', '.') }}
              </span>
            @else
              {{-- Static price --}}
              <span class="text-2xl font-bold text-warm-orange-400">
                ${{ number_format($price, 0, ',', '.') }}
              </span>
            @endif
          </div>

          {{-- CTA Button --}}
          <a 
            href="{{ whatsapp_url('Quiero%20' . urlencode($name)) }}"
            target="_blank"
            rel="noopener noreferrer"
            class="flex-shrink-0 p-3 rounded-lg bg-warm-orange-500/20 text-warm-orange-400 hover:bg-warm-orange-500 hover:text-elegant-black transition-all duration-300 group/btn"
          >
            <svg class="w-5 h-5 group-hover/btn:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.272-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378c-3.055 2.291-3.89 6.887-1.9 10.427 1.832 3.325 5.635 5.187 9.315 4.874.614-.057 1.221-.174 1.814-.356l.04-.013c3.34-.935 5.82-3.839 6.487-7.324.466-2.459.216-5.532-1.308-7.701-1.608-2.27-4.045-3.5-6.5-3.5l-.077.001c-1.564.038-3.091.3-4.54.923zm0 0"/>
            </svg>
          </a>
        </div>

      </div>

    </div>

  </div>
</div>
