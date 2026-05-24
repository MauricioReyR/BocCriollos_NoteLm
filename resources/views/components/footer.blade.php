{{-- Footer Premium --}}
<footer class="relative bg-elegant-black border-t border-white/10">
  
  {{-- Main Footer Content --}}
  <div class="container-premium py-16 md:py-20">
    
    {{-- Footer Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 md:gap-8 mb-12">
      
      {{-- Brand Section --}}
      <div class="col-span-1">
        <div class="flex items-center gap-3 mb-4">
          <div class="text-3xl">🍔</div>
          <div>
            <h3 class="font-display font-bold text-cream text-lg">Bocaditos Criollos</h3>
            <p class="text-xs text-gray-500">Auténtica Comida Colombiana</p>
          </div>
        </div>
        <p class="text-sm text-gray-400 mb-6">
          Comida rápida tradicional colombiana con ingredientes frescos y preparación artesanal en Engativá, Bogotá.
        </p>
        {{-- Social Links --}}
        <div class="flex gap-3 flex-wrap">
          {{-- Instagram --}}
          <a href="{{ config('store.social.instagram') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-pink-500/20 flex items-center justify-center text-cream hover:text-pink-400 transition-all duration-300" title="Instagram" aria-label="Instagram">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
            </svg>
          </a>
          {{-- Facebook --}}
          <a href="{{ config('store.social.facebook') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-blue-500/20 flex items-center justify-center text-cream hover:text-blue-400 transition-all duration-300" title="Facebook" aria-label="Facebook">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
          </a>
          {{-- WhatsApp --}}
          <a href="{{ config('store.whatsapp_url') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-green-500/20 flex items-center justify-center text-cream hover:text-green-400 transition-all duration-300" title="WhatsApp" aria-label="WhatsApp">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.272-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378c-3.055 2.291-3.89 6.887-1.9 10.427 1.832 3.325 5.635 5.187 9.315 4.874.614-.057 1.221-.174 1.814-.356l.04-.013c3.34-.935 5.82-3.839 6.487-7.324.466-2.459.216-5.532-1.308-7.701-1.608-2.27-4.045-3.5-6.5-3.5l-.077.001c-1.564.038-3.091.3-4.54.923zm0 0"/>
            </svg>
          </a>
          {{-- Google Maps --}}
          <a href="{{ config('store.google_maps_url') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-warm-orange-500/20 flex items-center justify-center text-cream hover:text-warm-orange-400 transition-all duration-300" title="Google Maps">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
          </a>
        </div>
      </div>

      {{-- Quick Links --}}
      <div>
        <h4 class="font-display font-bold text-cream mb-4">Menú</h4>
        <ul class="space-y-3">
          <li><a href="#productos" class="text-sm text-gray-400 hover:text-warm-orange-400 transition-colors">Productos</a></li>
          <li><a href="#categorias" class="text-sm text-gray-400 hover:text-warm-orange-400 transition-colors">Categorías</a></li>
          <li><a href="#testimonios" class="text-sm text-gray-400 hover:text-warm-orange-400 transition-colors">Testimonios</a></li>
          <li><a href="#" class="text-sm text-gray-400 hover:text-warm-orange-400 transition-colors">Promociones</a></li>
        </ul>
      </div>

      {{-- Hours --}}
      <div>
        <h4 class="font-display font-bold text-cream mb-4">Horarios</h4>
        <ul class="space-y-2 text-sm text-gray-400">
          <li>{{ config('store.hours.weekdays.label') }}</li>
          <li class="text-warm-orange-400 font-semibold">{{ config('store.hours.weekdays.hours') }}</li>
          <li class="mt-3">{{ config('store.hours.weekends.label') }}</li>
          <li class="text-warm-orange-400 font-semibold">{{ config('store.hours.weekends.hours') }}</li>
          <li class="text-[10px] text-gray-500 italic">{{ config('store.hours.weekends.note') }}</li>
        </ul>
      </div>

      {{-- Contact --}}
      <div>
        <h4 class="font-display font-bold text-cream mb-4">Contacto</h4>
        <ul class="space-y-3">
          <li>
            <a href="{{ config('store.whatsapp_url') }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-sm text-gray-400 hover:text-warm-orange-400 transition-colors">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.272-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378c-3.055 2.291-3.89 6.887-1.9 10.427 1.832 3.325 5.635 5.187 9.315 4.874.614-.057 1.221-.174 1.814-.356l.04-.013c3.34-.935 5.82-3.839 6.487-7.324.466-2.459.216-5.532-1.308-7.701-1.608-2.27-4.045-3.5-6.5-3.5l-.077.001c-1.564.038-3.091.3-4.54.923zm0 0"/>
              </svg>
              <span>+57 {{ config('store.phone') }}</span>
            </a>
          </li>
          <li>
            <a href="{{ config('store.google_maps_url') }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-sm text-gray-400 hover:text-warm-orange-400 transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              <span>{{ config('store.full_address') }}</span>
            </a>
          </li>
          <li>
            <div class="flex items-center gap-2 text-sm text-gray-400">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
              <span>info@bocaditos.co</span>
            </div>
          </li>
        </ul>
      </div>

    </div>

    {{-- Divider --}}
    <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent mb-8"></div>

    {{-- Bottom Footer --}}
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
      <p class="text-sm text-gray-500 text-center md:text-left">
        &copy; 2026 Bocaditos Criollos. Todos los derechos reservados.
      </p>
      
      <div class="flex items-center gap-6">
        <a href="#" class="text-xs text-gray-500 hover:text-warm-orange-400 transition-colors">Política de Privacidad</a>
        <a href="#" class="text-xs text-gray-500 hover:text-warm-orange-400 transition-colors">Términos de Servicio</a>
      </div>
    </div>

  </div>

  {{-- Back to Top Button (sticky) --}}
  <div 
    x-data="{ 
      showScroll: false 
    }"
    @scroll.window="showScroll = window.scrollY > 300"
    class="fixed bottom-8 right-8 z-40"
  >
    <button 
      @click="smoothScroll('hero')"
      x-show="showScroll"
      x-transition
      class="p-4 rounded-full bg-warm-orange-500 text-elegant-black hover:bg-warm-orange-600 hover:shadow-premium-lg transform hover:-translate-y-1 transition-all duration-300"
      title="Volver al inicio"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
      </svg>
    </button>
  </div>

</footer>
