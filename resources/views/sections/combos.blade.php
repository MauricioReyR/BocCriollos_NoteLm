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
    <div class="max-w-3xl mx-auto text-center mb-16 animate-fade-in" data-animate>
      <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-warm-orange-500/20 border border-warm-orange-500/50 mb-4">
        <span class="text-warm-orange-500 font-semibold text-sm">⚡ EVENTOS FAMILIARES Y EMPRESARIALES</span>
      </span>
      
      <h2 class="text-4xl sm:text-5xl md:text-6xl font-display font-bold text-cream mb-4">
        Nuestros Combos
      </h2>
      
      <p class="text-lg text-gray-400">
        Pensados para ti: Con la mejor calidad, la mejor relación precio-valor y máximo sabor. Perfectos para compartir o para ti solo.
      </p>
    </div>

    {{-- Combos Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      
      {{-- Combo Tradicional --}}
      <x-product-card
        name="Combo Tradicional"
        description="12 crujientes y deliciosas empanadas vallunas 🤤 con aji criollo🥵 y salsa casera tipo chimichurri😏. Disfruta esta delicia en casa🏡, calientitas y crujientes 🛵 pide tu domicilio ahora 😎"
        price="30000"
        category="Combos"
        icon="🥟"
        imageGradient="from-warm-orange-600 to-burnt-red-700"
      />

      {{-- Combo Megacombo --}}
      <x-product-card
        name="Combo Megacombo"
        description="¡¡¡MEGACOMBO!!! ⚠️ 6 crujientes y deliciosas😋 empanadas tradicionales y 4 arepas de huevo 🍳 trifasicas con pollo 🍗 desmechado y carne 🥩 desmechada. Se preparan  y salen calientitos para despacho 🏍️. Los entregamos con aji criollo 🥵y salsa casera tipo chimichurri😏"
        price="38000"
        category="Combos"
        icon="🫓"         
        imageGradient="from-burnt-red-600 to-warm-orange-700"
      />        

      {{-- Combo Cerpincho --}}
      <x-product-card
        name="Combo Cerpincho"
        description="3 deliciosos pinchos 🍢con chicharroncito carnudito  con papa salada, jugosa carne de cerdo y plátano maduro delicioso💯. Acompañados de ají criollo y nuestra infaltable salsa casera tipo chimichurri."
        price="45000"
        category="Combos"
        icon="🍢"
        imageGradient="from-burnt-red-700 to-burnt-red-900"
      />

      {{-- Combo Familia Pequeña --}}
      <x-product-card
        name="Combo Familia Pequeña"
        description="4 empanadas + 2 pasteles + 1 hamburguesa. El combo para la familia reunida."
        price="62000"
        category="Combos"
        icon="👨‍👩‍👧"
        imageGradient="from-warm-orange-700 to-orange-800"
      />

      {{-- Combo Vegetariano --}}
      <x-product-card
        name="Combo Vegetariano"
        description="3 arepas de queso + 2 tostadas criollas + bebida. Delicioso sin sacrificar sabor."
        price="32000"
        category="Combos"
        icon="🥕"
        imageGradient="from-burnt-red-500 to-burnt-red-700"
      />

      {{-- Combo Fiesta --}}
      <x-product-card
        name="Combo Fiesta (8 pax)"
        description="12 empanadas + 6 pasteles + 2 hamburguesas + salchipapas + 4 bebidas. ¡Para celebrar!"
        price="120000"
        category="Combos"
        icon="🎉"
        imageGradient="from-warm-orange-600 to-warm-orange-900"
      />

    </div>

    {{-- CTA Section --}}
    <div class="mt-16 text-center animate-fade-in" data-animate style="animation-delay: 0.2s;">
      <p class="text-gray-400 mb-6">
        ¿Quieres un combo personalizado?
      </p>
      
      <a 
        href="https://wa.me/573001234567?text=Hola%20Bocaditos%20Criollos%2C%20quisiera%20un%20combo%20personalizado"
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
