{{-- Combos Section — Corazón de la página --}}
<section id="combos" class="relative py-20 md:py-32 bg-elegant-black overflow-hidden">
  
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
        <span class="text-warm-orange-400 font-bold text-sm uppercase tracking-widest">🔥 Combos Estrella</span>
      </span>
      
      <div class="relative mb-6">
        <h2 class="text-5xl sm:text-6xl md:text-7xl font-display font-black text-cream leading-tight">
          Elegí tu <span class="gradient-text">Combo</span>
        </h2>
        <div class="mt-4 flex items-center justify-center gap-3">
          <span class="block w-12 h-0.5 bg-gradient-to-r from-transparent to-warm-orange-500/60"></span>
          <span class="block w-2 h-2 rotate-45 bg-warm-orange-500"></span>
          <span class="block w-12 h-0.5 bg-gradient-to-r from-warm-orange-500/60 to-transparent"></span>
        </div>
      </div>
      
      <p class="text-lg md:text-xl text-gray-400 leading-relaxed max-w-2xl mx-auto">
        Combos pensados para cada ocasión. La mejor relación calidad-precio, 
        <span class="text-warm-orange-400 font-semibold">directo a tu puerta</span>.
      </p>
    </div>

    {{-- Featured Combos Section --}}
    @if(($featuredCombos ?? collect())->isNotEmpty())
      <div class="mb-16">
        <div class="flex items-center gap-3 mb-8">
          <span class="text-2xl">⭐</span>
          <h3 class="text-2xl sm:text-3xl font-display font-bold text-cream">
            Más <span class="gradient-text">Pedidos</span>
          </h3>
          <span class="flex-1 h-px bg-gradient-to-r from-warm-orange-500/30 to-transparent"></span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
          @foreach($featuredCombos as $combo)
            <x-combo-card
              :featured="true"
              data-scroll-reveal="bottom"
              data-delay="{{ $loop->index * 150 }}"
              name="{{ $combo->name }}"
              description="{{ $combo->description }}"
              price="{{ $combo->price }}"
              imageUrl="{{ $combo->image_url }}"
              size="{{ $combo->size }}"
            />
          @endforeach
        </div>
      </div>
    @endif

    {{-- Combos Tradicionales --}}
    @if(($combosTradicional ?? collect())->isNotEmpty())
      <div class="mb-14" data-scroll-reveal="bottom" data-delay="100">
        <div class="flex items-center gap-3 mb-8">
          <span class="text-2xl">🥟</span>
          <h3 class="text-2xl sm:text-3xl font-display font-bold text-cream">
            Tradicionales
          </h3>
          <span class="flex-1 h-px bg-gradient-to-r from-warm-orange-500/30 to-transparent"></span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
          @foreach($combosTradicional as $combo)
            <x-combo-card
              :featured="false"
              data-scroll-reveal="bottom"
              data-delay="{{ $loop->index * 150 }}"
              name="{{ $combo->name }}"
              description="{{ $combo->description }}"
              price="{{ $combo->price }}"
              imageUrl="{{ $combo->image_url }}"
              size="{{ $combo->size }}"
            />
          @endforeach
        </div>
      </div>
    @endif

    {{-- Combos Bocado --}}
    @if(($combosBocado ?? collect())->isNotEmpty())
      <div class="mb-14" data-scroll-reveal="bottom" data-delay="200">
        <div class="flex items-center gap-3 mb-8">
          <span class="text-2xl">🥟</span>
          <h3 class="text-2xl sm:text-3xl font-display font-bold text-cream">
            Bocados
          </h3>
          <span class="flex-1 h-px bg-gradient-to-r from-warm-orange-500/30 to-transparent"></span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
          @foreach($combosBocado as $combo)
            <x-combo-card
              :featured="false"
              data-scroll-reveal="bottom"
              data-delay="{{ $loop->index * 150 }}"
              name="{{ $combo->name }}"
              description="{{ $combo->description }}"
              price="{{ $combo->price }}"
              imageUrl="{{ $combo->image_url }}"
              size="{{ $combo->size }}"
            />
          @endforeach
        </div>
      </div>
    @endif

    {{-- Combos sin tamaño definido --}}
    @if(($combosSinSize ?? collect())->isNotEmpty())
      <div class="mb-14" data-scroll-reveal="bottom" data-delay="300">
        <div class="flex items-center gap-3 mb-8">
          <span class="text-2xl">🎁</span>
          <h3 class="text-2xl sm:text-3xl font-display font-bold text-cream">
            Todos los <span class="gradient-text">Combos</span>
          </h3>
          <span class="flex-1 h-px bg-gradient-to-r from-warm-orange-500/30 to-transparent"></span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
          @foreach($combosSinSize as $combo)
            <x-combo-card
              :featured="false"
              data-scroll-reveal="bottom"
              data-delay="{{ $loop->index * 150 }}"
              name="{{ $combo->name }}"
              description="{{ $combo->description }}"
              price="{{ $combo->price }}"
              imageUrl="{{ $combo->image_url }}"
            />
          @endforeach
        </div>
      </div>
    @endif

    {{-- Adiciones --}}
    @if(($combosAdiciones ?? collect())->isNotEmpty())
      <div class="mb-14" data-scroll-reveal="bottom" data-delay="350">
        <div class="flex items-center gap-3 mb-8">
          <span class="text-2xl">🥤</span>
          <h3 class="text-2xl sm:text-3xl font-display font-bold text-cream">
            Adiciones
          </h3>
          <span class="flex-1 h-px bg-gradient-to-r from-warm-orange-500/30 to-transparent"></span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
          @foreach($combosAdiciones as $combo)
            <x-combo-card
              :featured="false"
              data-scroll-reveal="bottom"
              data-delay="{{ $loop->index * 150 }}"
              name="{{ $combo->name }}"
              description="{{ $combo->description }}"
              price="{{ $combo->price }}"
              imageUrl="{{ $combo->image_url }}"
              size="{{ $combo->size }}"
            />
          @endforeach
        </div>
      </div>
    @endif

    {{-- Empty State --}}
    @if(($combos ?? collect())->isEmpty())
      <div class="py-16 text-center" data-scroll-reveal="bottom" data-delay="0">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-warm-orange-500/10 border border-warm-orange-500/20 mb-6">
          <svg class="w-10 h-10 text-warm-orange-400/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <h3 class="text-2xl font-display font-bold text-cream mb-2">Próximamente</h3>
        <p class="text-gray-400 max-w-md mx-auto">
          Estamos preparando nuestros combos. Muy pronto podrás ver todas nuestras opciones aquí.
        </p>
        <a 
          href="{{ whatsapp_url('Hola%20Bocaditos%20Criollos%2C%20me%20gustar%C3%ADa%20conocer%20los%20combos%20disponibles') }}"
          target="_blank"
          rel="noopener noreferrer"
          class="inline-flex items-center gap-2 mt-6 px-6 py-3 rounded-xl bg-warm-orange-500 text-elegant-black font-bold hover:bg-warm-orange-400 transition-all duration-300"
        >
          Consultar Combos por WhatsApp
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.272-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378c-3.055 2.291-3.89 6.887-1.9 10.427 1.832 3.325 5.635 5.187 9.315 4.874.614-.057 1.221-.174 1.814-.356l.04-.013c3.34-.935 5.82-3.839 6.487-7.324.466-2.459.216-5.532-1.308-7.701-1.608-2.27-4.045-3.5-6.5-3.5l-.077.001c-1.564.038-3.091.3-4.54.923zm0 0\"/>
          </svg>
        </a>
      </div>
    @endif

    {{-- CTA Section --}}
    <div class="mt-16 text-center" data-scroll-reveal="bottom" data-delay="300">
      <p class="text-gray-400 mb-6">
        ¿Quieres un combo ahora mismo?
      </p>
      
      <a 
        href="{{ whatsapp_url('Hola%20Bocaditos%20Criollos%2C%20quisiera%20un%20combo%20personalizado') }}"
        target="_blank"
        rel="noopener noreferrer"
        class="inline-flex items-center gap-2 btn btn-secondary"
      >
        <span>Pide tu Combo</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
        </svg>
      </a>
    </div>

  </div>

</section>
