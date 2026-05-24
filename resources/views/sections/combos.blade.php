{{-- Nuestros Combos Section --}}
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
        <span class="text-warm-orange-400 font-bold text-sm uppercase tracking-widest">⚡ Eventos Familiares</span>
      </span>
      
      <div class="relative mb-6">
        <h2 class="text-5xl sm:text-6xl md:text-7xl font-display font-black text-cream leading-tight">
          Nuestros <span class="gradient-text">Combos</span>
        </h2>
        <div class="mt-4 flex items-center justify-center gap-3">
          <span class="block w-12 h-0.5 bg-gradient-to-r from-transparent to-warm-orange-500/60"></span>
          <span class="block w-2 h-2 rotate-45 bg-warm-orange-500"></span>
          <span class="block w-12 h-0.5 bg-gradient-to-r from-warm-orange-500/60 to-transparent"></span>
        </div>
      </div>
      
      <p class="text-lg md:text-xl text-gray-400 leading-relaxed max-w-2xl mx-auto">
        Pensados para ti: la mejor calidad, la mejor relación precio-valor y el máximo sabor. Perfectos para compartir o para ti solo.
      </p>
    </div>

    {{-- Combos Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      
      @forelse($combos ?? [] as $combo)
        <x-product-card
          data-scroll-reveal="bottom"
          data-delay="{{ ($loop->index ?? 0) * 150 }}"
          name="{{ $combo->name }}"
          description="{{ $combo->description }}"
          price="{{ $combo->price }}"
          category="{{ $combo->category?->name ?? 'Combos' }}"
          icon="{{ $combo->icon ?? '🎁' }}"
          imageGradient="{{ $combo->image_gradient }}"
          imageUrl="{{ $combo->image_url }}"
          :sizes="$combo->sizes"
        />
      @empty
        {{-- Hardcoded fallback --}}
        <x-product-card
          data-scroll-reveal="bottom"
          data-delay="0"
          name="Combo Tradicional"
          description="12 crujientes y deliciosas empanadas vallunas 🤤 con aji criollo🥵 y salsa casera tipo chimichurri😏. Disfruta esta delicia en casa🏡, calientitas y crujientes 🛵 pide tu domicilio ahora 😎"
          price="35000"
          category="Combos" 
          icon="🥟"
          imageGradient="from-warm-orange-600 to-burnt-red-700"
        />
        <x-product-card
          data-scroll-reveal="bottom"
          data-delay="150"
          name="Combo Megacombo"
          description="¡¡¡MEGACOMBO!!! ⚠️ 6 crujientes y deliciosas😋 empanadas tradicionales y 4 arepas de huevo 🍳 trifasicas con pollo 🍗 desmechado y carne 🥩 desmechada."
          price="35000"
          category="Combos"
          icon="🫓"         
          imageGradient="from-burnt-red-600 to-warm-orange-700"
        />
        <x-product-card
          data-scroll-reveal="bottom"
          data-delay="300"
          name="Combo Cerpincho"
          description="3 deliciosos pinchos 🍢 con chicharroncito carnudito con papa salada, jugosa carne de cerdo y plátano maduro delicioso💯."
          price="35000"
          category="Combos"
          icon="🍢"
          imageGradient="from-burnt-red-700 to-burnt-red-900"
        />
        <x-product-card
          data-scroll-reveal="bottom"
          data-delay="450"
          name="Combo Bocaditos"
          description="30 deliciosas empanadas tradicionales tipo Bocado 🤤 con aji criollo🥵 y salsa casera tipo chimichurri😏. Disfruta esta delicia en casa🏡, calientitas y crujientes 🛵 pide tu domicilio ahora 😎"
          price="35000"
          category="Combos"
          icon="🥟"
          imageGradient="from-warm-orange-700 to-orange-800"
        />
        <x-product-card
          data-scroll-reveal="bottom"
          data-delay="600"
          name="Combo Mini Pasteitos de Yuca"
          description="20 deliciosos y calientitos mini  pastelitos de yuca 😋 acompañados de ají criollo y salsa casera tipo chimichurri."
          price="35000"
          category="Combos"
          icon="🥕"
          imageGradient="from-burnt-red-500 to-burnt-red-700"
        />
        <x-product-card
          data-scroll-reveal="bottom"
          data-delay="750"
          name="Combo Megabocado"
          description="5 Empanadas Tradicionales, 2 Empanadas Gourmet y 2 Arepas de huevo Trifasicas. El combo perfecto para los amantes de la variedad y el sabor auténtico colombiano. Se entregan calientes y Crujientes, acompalñadas de nuestro aji casero  y nuestra salsa casera tipo chimichurri. ¡Pide tu domicilio ahora y disfruta de esta delicia en casa!  😎"
          price="35000"
          category="Combos"
          icon="🎉"
          imageGradient="from-warm-orange-600 to-warm-orange-900"
        />
        <x-product-card
          data-scroll-reveal="bottom"
          data-delay="750"
          name="Combo Megabocado"
          description="5 Empanadas Tradicionales, 2 Empanadas Gourmet y 2 Arepas de huevo Trifasicas. El combo perfecto para los amantes de la variedad y el sabor auténtico colombiano. Se entregan calientes y Crujientes, acompalñadas de nuestro aji casero  y nuestra salsa casera tipo chimichurri. ¡Pide tu domicilio ahora y disfruta de esta delicia en casa!  😎"
          price="35000"
          category="Combos"
          icon="🎉"
          imageGradient="from-warm-orange-600 to-warm-orange-900"
        />
      @endforelse

    </div>

    {{-- CTA Section --}}
    <div class="mt-16 text-center" data-scroll-reveal="bottom" data-delay="300">
      <p class="text-gray-400 mb-6">
        ¿Quieres un combo personalizado?
      </p>
      
      <a 
        href="{{ whatsapp_url('Hola%20Bocaditos%20Criollos%2C%20quisiera%20un%20combo%20personalizado') }}"
        target="_blank"
        rel="noopener noreferrer"
        class="inline-flex items-center gap-2 btn btn-secondary"
      >
        <span>Armar mi Combo</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
        </svg>
      </a>
    </div>

  </div>

</section>
