{{-- Testimonios Section --}}
<section id="testimonios" class="relative py-20 md:py-32 bg-elegant-black overflow-hidden">
  
  {{-- Background Decorative Elements --}}
  <div class="absolute inset-0 opacity-5">
    <div class="absolute top-1/4 right-0 w-96 h-96 bg-warm-orange-500 rounded-full blur-3xl"></div>
    <div class="absolute bottom-1/4 left-0 w-96 h-96 bg-burnt-red-500 rounded-full blur-3xl"></div>
  </div>

  {{-- Content Container --}}
  <div class="relative z-10 container-premium">
    
    {{-- Section Header --}}
    <div class="max-w-3xl mx-auto text-center mb-16" data-scroll-reveal="bottom" data-delay="0">
      <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-warm-orange-500/20 border border-warm-orange-500/50 mb-6">
        <span class="text-warm-orange-400 font-bold text-sm uppercase tracking-widest">💬 Lo Que Dicen</span>
      </span>
      
      <div class="relative mb-6">
        <h2 class="text-5xl sm:text-6xl md:text-7xl font-display font-black text-cream leading-tight">
          <span class="gradient-text">Testimonios</span> de Clientes
        </h2>
        <div class="mt-4 flex items-center justify-center gap-3">
          <span class="block w-12 h-0.5 bg-gradient-to-r from-transparent to-warm-orange-500/60"></span>
          <span class="block w-2 h-2 rotate-45 bg-warm-orange-500"></span>
          <span class="block w-12 h-0.5 bg-gradient-to-r from-warm-orange-500/60 to-transparent"></span>
        </div>
      </div>
      
      <p class="text-lg md:text-xl text-gray-400 leading-relaxed max-w-2xl mx-auto">
        Lee las historias de nuestros clientes satisfechos que disfrutan nuestros productos todos los días
      </p>
    </div>

    {{-- Testimonials Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      
      {{-- Testimonial 1 --}}
      <x-testimonial-card
        data-scroll-reveal="bottom"
        data-delay="0"
        name="María González"
        role="Estudiante"
        rating="5"
        avatar="😊"
        avatarGradient="from-burnt-red-500 to-warm-orange-600"
        text="Las empanadas de Bocaditos Criollos son increíbles. Crujientes por fuera, jugosas por dentro. He probado en muchos lugares pero estos se llevan el premio. ¡Altamente recomendado!"
      />

      {{-- Testimonial 2 --}}
      <x-testimonial-card
        data-scroll-reveal="bottom"
        data-delay="150"
        name="Carlos Rodríguez"
        role="Trabajador Independiente"
        rating="5"
        avatar="👨‍💼"
        avatarGradient="from-warm-orange-600 to-warm-orange-800"
        text="Perfecto para mi almuerzo rápido. La comida llega en menos de 15 minutos y siempre está caliente. El servicio por WhatsApp es muy práctico. Vuelvo cada semana."
      />

      {{-- Testimonial 3 --}}
      <x-testimonial-card
        data-scroll-reveal="bottom"
        data-delay="300"
        name="Ana Martínez"
        role="Mamá Emprendedora"
        rating="5"
        avatar="👩"
        avatarGradient="from-burnt-red-600 to-burnt-red-800"
        text="Mis hijos aman las salchipapas. Es comida rápida pero hecha con calidad. Ingredientes frescos y porciones generosas. Definitivamente es nuestro lugar favorito en Engativá."
      />

      {{-- Testimonial 4 --}}
      <x-testimonial-card
        data-scroll-reveal="bottom"
        data-delay="450"
        name="Juan Pérez"
        role="Oficinista"
        rating="4"
        avatar="👨"
        avatarGradient="from-warm-orange-700 to-orange-900"
        text="Las hamburguesas son de lujo. Pan tostado perfecto, carne jugosa y ingredientes premium. El combo familiar es perfecto para compartir con compañeros. Muy buen precio."
      />

      {{-- Testimonial 5 --}}
      <x-testimonial-card
        data-scroll-reveal="bottom"
        data-delay="600"
        name="Sofia Acosta"
        role="Deportista"
        rating="5"
        avatar="🏃‍♀️"
        avatarGradient="from-burnt-red-700 to-warm-orange-700"
        text="Como deportista busco comida nutritiva y deliciosa. Bocaditos Criollos ofrece ambas cosas. Sus arepas de queso son mi favorita después del entrenamiento. Gracias por la calidad."
      />

      {{-- Testimonial 6 --}}
      <x-testimonial-card
        data-scroll-reveal="bottom"
        data-delay="750"
        name="Diego López"
        role="Chef Pasante"
        rating="5"
        avatar="👨‍🍳"
        avatarGradient="from-orange-600 to-burnt-red-800"
        text="Como alguien en la industria culinaria, respeto mucho lo que hacen aquí. Recetas auténticas, técnica impecable, presentación elegante. Es comida rápida pero con alma. Chapeau."
      />

    </div>

    {{-- CTA Section --}}
    <div class="mt-16 text-center" data-scroll-reveal="bottom" data-delay="300">
      <p class="text-gray-400 mb-6 text-lg">
        ¿Quieres probar Bocaditos Criollos?
      </p>
      
      <a 
        href="{{ whatsapp_url('Hola%20Bocaditos%20Criollos%2C%20quiero%20hacer%20mi%20primer%20pedido') }}"
        target="_blank"
        rel="noopener noreferrer"
        class="inline-flex items-center gap-2 btn btn-primary text-lg"
      >
        <span>🛒 Hacer mi Primer Pedido</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
        </svg>
      </a>
    </div>

  </div>

</section>
