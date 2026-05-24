{{-- CTA WhatsApp Premium Section --}}
<section class="relative py-16 md:py-24 overflow-hidden">
  {{-- Background Gradient --}}
  <div class="absolute inset-0 bg-gradient-to-r from-burnt-red-900 via-warm-orange-900 to-burnt-red-900"></div>
  
  {{-- Decorative Elements --}}
  <div class="absolute inset-0 opacity-10">
    <div class="absolute -top-1/2 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
    <div class="absolute -bottom-1/2 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
  </div>

  {{-- Content Container --}}
  <div class="relative z-10 container-premium">
    <div class="max-w-4xl mx-auto">
      
      {{-- Main Content --}}
      <div class="text-center">
        {{-- Icon --}}
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6 animate-float">
          <svg class="w-10 h-10 text-cream" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.272-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378c-3.055 2.291-3.89 6.887-1.9 10.427 1.832 3.325 5.635 5.187 9.315 4.874.614-.057 1.221-.174 1.814-.356l.04-.013c3.34-.935 5.82-3.839 6.487-7.324.466-2.459.216-5.532-1.308-7.701-1.608-2.27-4.045-3.5-6.5-3.5l-.077.001c-1.564.038-3.091.3-4.54.923zm0 0"/>
          </svg>
        </div>

        {{-- Headline --}}
        <h2 class="text-4xl sm:text-5xl md:text-6xl font-display font-bold text-cream mb-4" data-scroll-reveal="bottom" data-delay="0">
          ¿Listo para disfrutar?
        </h2>

        {{-- Subheading --}}
        <p class="text-lg sm:text-xl text-gray-100 mb-8 max-w-2xl mx-auto" data-scroll-reveal="bottom" data-delay="100">
          Contáctanos por WhatsApp y realiza tu pedido en minutos.
          Entrega rápida a domicilio o visítanos en nuestra tienda física en Engativá.
        </p>

        {{-- CTA Button --}}
        <div data-scroll-reveal="bottom" data-delay="200">
          <a 
            href="{{ config('store.whatsapp_full_url') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="no-underline inline-flex items-center gap-3 px-8 md:px-12 py-4 md:py-5 rounded-xl bg-white text-burnt-red-600 font-bold text-lg md:text-xl hover:bg-gray-100 hover:shadow-premium-lg transform hover:-translate-y-1 transition-all duration-300"
          >
            <svg class="w-6 h-6 md:w-8 md:h-8" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.272-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378c-3.055 2.291-3.89 6.887-1.9 10.427 1.832 3.325 5.635 5.187 9.315 4.874.614-.057 1.221-.174 1.814-.356l.04-.013c3.34-.935 5.82-3.839 6.487-7.324.466-2.459.216-5.532-1.308-7.701-1.608-2.27-4.045-3.5-6.5-3.5l-.077.001c-1.564.038-3.091.3-4.54.923zm0 0"/>
            </svg>
            <span>Ordenar Ahora</span>
          </a>
        </div>

        {{-- Trust Indicators --}}
        <div class="mt-12 grid grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
          <div class="text-center" data-scroll-reveal="bottom" data-delay="300">
            <div class="text-3xl mb-2">⚡</div>
            <p class="text-sm text-gray-100">Entrega en 60-90 min</p>
          </div>
          <div class="text-center" data-scroll-reveal="bottom" data-delay="400">
            <div class="text-3xl mb-2">💳</div>
            <p class="text-sm text-gray-100">Transferencia o efectivo en el punto de Venta</p>
          </div>
          <div class="text-center" data-scroll-reveal="bottom" data-delay="500">
            <div class="text-3xl mb-2">✅</div>
            <p class="text-sm text-gray-100">100% Garantizado</p>
          </div>
        </div>

        {{-- Store Location Card --}}
        <div class="mt-16 max-w-3xl mx-auto" data-scroll-reveal="bottom" data-delay="600">
          <x-store-location-card />
        </div>

      </div>

    </div>
  </div>
</section>
