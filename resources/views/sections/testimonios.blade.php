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
        Descubre lo que dicen nuestros clientes sobre sus combos favoritos. Cada pack está pensado para compartir momentos deliciosos.
      </p>
    </div>

    {{-- Testimonials Grid --}}
    @php
      $gradients = [
        'from-burnt-red-500 to-warm-orange-600',
        'from-warm-orange-600 to-warm-orange-800',
        'from-burnt-red-600 to-burnt-red-800',
        'from-warm-orange-700 to-orange-900',
        'from-burnt-red-700 to-warm-orange-700',
        'from-orange-600 to-burnt-red-800',
        'from-burnt-red-600 to-warm-orange-700',
        'from-burnt-red-700 to-burnt-red-900',
        'from-warm-orange-700 to-orange-800',
        'from-burnt-red-500 to-orange-700',
      ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      @forelse($testimonials as $testimonial)
        <x-testimonial-card
          data-scroll-reveal="bottom"
          data-delay="{{ $loop->index * 150 }}"
          name="{{ $testimonial->name }}"
          role="{{ $testimonial->role ?? 'Cliente Satisfecho' }}"
          rating="{{ $testimonial->rating }}"
          avatar="{{ $testimonial->avatar }}"
          avatarGradient="{{ $gradients[$loop->index % count($gradients)] }}"
          text="{{ $testimonial->text }}"
        />
      @empty
        <div class="col-span-full text-center text-gray-500 py-12">
          <p class="text-lg">Aún no hay testimonios. ¡Sé el primero en compartir tu experiencia!</p>
        </div>
      @endforelse
    </div>

    {{-- Testimonial Form --}}
    <div 
      x-data="testimonialForm()"
      class="mt-16"
      data-scroll-reveal="bottom"
      data-delay="200"
    >
      {{-- Toggle Button --}}
      <div class="text-center">
        <button 
          @click="open = !open; if(!open) { submitted = false; errors = {}; }"
          class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-warm-orange-500/10 border border-warm-orange-500/30 hover:bg-warm-orange-500/20 hover:border-warm-orange-500/50 text-cream font-semibold transition-all duration-300"
          :class="{ 'bg-warm-orange-500/20 border-warm-orange-500/50': open }"
        >
          <template x-if="!open">
            <span class="flex items-center gap-2">
              <span>✍️</span>
              <span>Deja tu Reseña</span>
            </span>
          </template>
          <template x-if="open">
            <span class="flex items-center gap-2">
              <span>✕</span>
              <span>Cerrar</span>
            </span>
          </template>
        </button>
      </div>

      {{-- Form Panel --}}
      <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0 translate-y-6 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-6 scale-95"
        class="mt-8 max-w-2xl mx-auto"
        x-cloak
      >
        {{-- Success Message --}}
        <div 
          x-show="submitted"
          x-transition:enter="transition ease-out duration-300"
          class="card-premium text-center py-12"
        >
          <div class="text-5xl mb-4">🎉</div>
          <h3 class="text-2xl font-display font-bold text-cream mb-2">¡Gracias por tu reseña!</h3>
          <p class="text-gray-400 mb-6">
            Tu testimonio ha sido recibido y será revisado pronto para ser publicado.
          </p>
          <button 
            @click="resetForm()"
            class="btn btn-primary"
          >
            Enviar otra reseña
          </button>
        </div>

        {{-- Form --}}
        <div x-show="!submitted" class="card-premium">
          <div class="text-center mb-8">
            <h3 class="text-xl font-display font-bold text-cream mb-2">Comparte tu experiencia con nuestros combos</h3>
            <p class="text-sm text-gray-400">¿Qué combo pediste? Cuéntanos cómo te fue.</p>
          </div>

          <div class="space-y-6">
            {{-- Rating Stars --}}
            <div>
              <label class="block text-sm font-medium text-gray-300 mb-3">
                Tu calificación
              </label>
              <div class="flex gap-2 justify-center" @mouseleave="hoverRating = 0">
                <template x-for="star in 5" :key="star">
                  <button 
                    type="button"
                    @click="form.rating = star"
                    @mouseenter="hoverRating = star"
                    class="transition-all duration-150 transform hover:scale-110 focus:outline-none"
                    :class="{ 'scale-110': star === form.rating }"
                  >
                    <svg 
                      class="w-8 h-8 md:w-10 md:h-10 transition-all duration-200"
                      :class="star <= (hoverRating || form.rating) ? 'text-warm-orange-400' : 'text-gray-600'"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                  </button>
                </template>
              </div>
              <template x-if="errors.rating">
                <p class="text-red-400 text-sm mt-2 text-center" x-text="errors.rating"></p>
              </template>
            </div>

            {{-- Name --}}
            <div>
              <label for="testimonial-name" class="block text-sm font-medium text-gray-300 mb-2">
                Tu nombre <span class="text-warm-orange-400">*</span>
              </label>
              <input 
                id="testimonial-name"
                type="text" 
                x-model="form.name" 
                placeholder="Ej: María González"
                class="w-full"
                :class="{ 'ring-2 ring-red-500/50 border-red-500/50': errors.name }"
                maxlength="100"
              >
              <template x-if="errors.name">
                <p class="text-red-400 text-sm mt-1" x-text="errors.name"></p>
              </template>
            </div>

            {{-- Role (optional) --}}
            <div>
              <label for="testimonial-role" class="block text-sm font-medium text-gray-300 mb-2">
                Tu profesión o rol
                <span class="text-gray-500 font-normal">(opcional)</span>
              </label>
              <input 
                id="testimonial-role"
                type="text" 
                x-model="form.role" 
                placeholder="Ej: Estudiante, Ingeniero, Mamá..."
                class="w-full"
                maxlength="100"
              >
            </div>

            {{-- Text --}}
            <div>
              <label for="testimonial-text" class="block text-sm font-medium text-gray-300 mb-2">
                Tu testimonio <span class="text-warm-orange-400">*</span>
              </label>
              <textarea 
                id="testimonial-text"
                x-model="form.text" 
                placeholder="Cuéntanos qué combo pediste, qué te pareció, si lo recomiendas..."
                class="w-full min-h-[120px] resize-y"
                :class="{ 'ring-2 ring-red-500/50 border-red-500/50': errors.text }"
                maxlength="1000"
              ></textarea>
              <div class="flex justify-between mt-1">
                <template x-if="errors.text">
                  <p class="text-red-400 text-sm" x-text="errors.text"></p>
                </template>
                <p 
                  class="text-xs text-gray-500 ml-auto"
                  x-text="form.text.length + '/1000'">
                </p>
              </div>
            </div>

            {{-- Honeypot: hidden from humans, visible to bots --}}
            <div class="honeypot-field" aria-hidden="true" style="position: absolute; left: -9999px; opacity: 0; height: 0; overflow: hidden;">
              <label for="testimonial-website">No llenar si eres humano</label>
              <input 
                id="testimonial-website"
                type="text" 
                x-model="form.website" 
                tabindex="-1"
                autocomplete="off"
              >
            </div>

            {{-- Submit --}}
            <div class="text-center pt-2">
              <button 
                type="button"
                @click="submitForm()"
                :disabled="submitting"
                class="btn btn-primary btn-lg min-w-[200px]"
                :class="{ 'opacity-75 cursor-not-allowed': submitting }"
              >
                <template x-if="!submitting">
                  <span class="flex items-center gap-2">
                    <span>💬</span>
                    <span>Enviar Testimonio</span>
                  </span>
                </template>
                <template x-if="submitting">
                  <span class="flex items-center gap-2">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Enviando...</span>
                  </span>
                </template>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- CTA Section --}}
    <div class="mt-16 text-center" data-scroll-reveal="bottom" data-delay="300">
      <p class="text-gray-400 mb-6 text-lg">
        ¿Listo para probar nuestros combos?
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
