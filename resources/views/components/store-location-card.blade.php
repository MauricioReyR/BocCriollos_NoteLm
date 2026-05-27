{{-- Store Location Card Premium --}}
@props([
  'address' => config('store.full_address'),
  'phone' => config('store.phone'),
  'whatsappUrl' => config('store.whatsapp_full_url'),
  'mapsUrl' => config('store.google_maps_url'),
  'embedUrl' => config('store.osm_embed_url'),
  'hoursWeekdays' => config('store.hours.weekdays'),
  'hoursWeekends' => config('store.hours.weekends'),
])

<div {{ $attributes->merge(['class' => 'w-full']) }}>
  <div class="relative group">
    {{-- Glass Card Container --}}
    <div class="relative rounded-2xl overflow-hidden bg-white/5 backdrop-blur-xl border border-white/10 hover:border-warm-orange-500/30 transition-all duration-500">
      
      {{-- Subtle glow effect on hover --}}
      <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
        <div class="absolute -top-20 -right-20 w-40 h-40 bg-warm-orange-500/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-burnt-red-500/5 rounded-full blur-3xl"></div>
      </div>
      
      <div class="relative z-10 p-6 md:p-8">
        
        {{-- Header --}}
        <div class="flex items-center gap-3 mb-6">
          <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-warm-orange-500/10 border border-warm-orange-500/20">
            <svg class="w-5 h-5 text-warm-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
          </div>
          <div>
            <h4 class="font-display font-bold text-cream text-sm uppercase tracking-widest">Visítanos</h4>
            <p class="text-xs text-gray-500">Nuestra tienda física</p>
          </div>
        </div>

        {{-- Content Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          
          {{-- Left Column: Address + Hours --}}
          <div class="space-y-5">
            
            {{-- Address --}}
            <div class="flex items-start gap-3">
              <div class="flex-shrink-0 mt-0.5">
                <svg class="w-4 h-4 text-warm-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </div>
              <div>
                <p class="text-sm font-medium text-cream">Dirección</p>
                <p class="text-sm text-gray-400 leading-relaxed">{{ $address }}</p>
                <p class="text-xs text-gray-500 mt-0.5">📍 Local esquina — Fácil de encontrar</p>
              </div>
            </div>

            {{-- Divider --}}
            <div class="h-px bg-gradient-to-r from-white/5 via-white/10 to-transparent"></div>

            {{-- Hours --}}
            <div class="space-y-3">
              <div class="flex items-start gap-3">
                <div class="flex-shrink-0 mt-0.5">
                  <svg class="w-4 h-4 text-warm-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </div>
                <div>
                  <p class="text-sm font-medium text-cream mb-2">Horarios</p>
                  
                  {{-- Weekdays --}}
                  <div class="flex items-center justify-between gap-4 py-1.5">
                    <span class="text-xs text-gray-400">{{ $hoursWeekdays['label'] }}</span>
                    <span class="text-xs font-semibold text-warm-orange-400">{{ $hoursWeekdays['hours'] }}</span>
                  </div>

                  {{-- Weekends --}}
                  <div class="flex items-center justify-between gap-4 py-1.5 border-t border-white/5">
                    <div>
                      <span class="text-xs text-gray-400">{{ $hoursWeekends['label'] }}</span>
                      @if(!empty($hoursWeekends['note']))
                        <p class="text-[10px] text-gray-500 italic mt-0.5">{{ $hoursWeekends['note'] }}</p>
                      @endif
                    </div>
                    <span class="text-xs font-semibold text-warm-orange-400 whitespace-nowrap">{{ $hoursWeekends['hours'] }}</span>
                  </div>
                </div>
              </div>
            </div>

          </div>

          {{-- Right Column: Action Buttons --}}
          <div class="flex flex-col justify-center gap-3">
            
            {{-- WhatsApp Button --}}
            <a 
              href="{{ $whatsappUrl }}"
              target="_blank"
              rel="noopener noreferrer"
              class="no-underline group/btn relative overflow-hidden rounded-xl bg-gradient-to-r from-green-500 to-green-600 p-[1px] transition-all duration-300 hover:shadow-lg hover:shadow-green-500/25"
            >
              <div class="relative flex items-center justify-center gap-3 px-5 py-3.5 rounded-xl bg-elegant-black group-hover/btn:bg-green-600/10 transition-all duration-300">
                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.272-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378c-3.055 2.291-3.89 6.887-1.9 10.427 1.832 3.325 5.635 5.187 9.315 4.874.614-.057 1.221-.174 1.814-.356l.04-.013c3.34-.935 5.82-3.839 6.487-7.324.466-2.459.216-5.532-1.308-7.701-1.608-2.27-4.045-3.5-6.5-3.5l-.077.001c-1.564.038-3.091.3-4.54.923zm0 0"/>
                </svg>
                <span class="text-sm font-bold text-cream">Contáctanos por WhatsApp</span>
              </div>
            </a>

            {{-- Google Maps Button --}}
            <a 
              href="{{ $mapsUrl }}"
              target="_blank"
              rel="noopener noreferrer"
              class="no-underline group/btn relative overflow-hidden rounded-xl bg-gradient-to-r from-warm-orange-500 to-burnt-red-600 p-[1px] transition-all duration-300 hover:shadow-lg hover:shadow-warm-orange-500/25"
            >
              <div class="relative flex items-center justify-center gap-3 px-5 py-3.5 rounded-xl bg-elegant-black group-hover/btn:bg-warm-orange-600/10 transition-all duration-300">
                <svg class="w-5 h-5 text-warm-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
                <span class="text-sm font-bold text-cream">Abrir en Google Maps</span>
              </div>
            </a>

            {{-- Quick phone display --}}
            <div class="text-center pt-1">
              <a href="tel:+57{{ $phone }}" class="no-underline text-xs text-gray-500 hover:text-warm-orange-400 transition-colors">
                <span class="inline-flex items-center gap-1">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                  </svg>
                  Llámanos: +57 {{ $phone }}
                </span>
              </a>
            </div>

            {{-- Social Icons --}}
            <div class="flex items-center justify-center gap-2 pt-3 border-t border-white/5">
              <span class="text-[10px] text-gray-500 uppercase tracking-wider mr-1">Síguenos</span>
              {{-- Instagram --}}
              <a href="{{ config('store.social.instagram') }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-white/5 hover:bg-pink-500/20 flex items-center justify-center text-gray-400 hover:text-pink-400 transition-all duration-300" title="Instagram" aria-label="Instagram">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                </svg>
              </a>
              {{-- Facebook --}}
              <a href="{{ config('store.social.facebook') }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-white/5 hover:bg-blue-500/20 flex items-center justify-center text-gray-400 hover:text-blue-400 transition-all duration-300" title="Facebook" aria-label="Facebook">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </a>
            </div>

          </div>

        </div>

        {{-- Map Section --}}
        <div
          class="mt-6 pt-6 border-t border-white/10"
          x-data="{ mapLoaded: false, mapError: false }"
          x-init="
            const iframe = $el.querySelector('iframe');
            if (!iframe) return;

            const fallbackTimeout = setTimeout(() => {
              if (!mapLoaded) {
                mapError = true;
                console.warn('[OSM Map] No se pudo cargar el mapa de OpenStreetMap. Posible bloqueo de red o restricción del navegador.');
              }
            }, 15000);

            iframe.addEventListener('load', () => {
              mapLoaded = true;
              mapError = false;
              clearTimeout(fallbackTimeout);
            });
          "
        >
          <div class="flex items-center gap-2 mb-3">
            <svg class="w-4 h-4 text-warm-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
            </svg>
            <span class="text-xs text-gray-500 uppercase tracking-wider font-medium">Mapa — OpenStreetMap</span>
          </div>

          <div class="relative rounded-xl overflow-hidden group/map">
            {{-- Fallback overlay (shown on load error) --}}
            <div
              x-show="mapError"
              x-cloak
              x-transition:enter="transition ease-out duration-300"
              x-transition:enter-start="opacity-0"
              x-transition:enter-end="opacity-100"
              class="absolute inset-0 z-10 flex flex-col items-center justify-center bg-elegant-black/90 backdrop-blur-sm rounded-xl"
            >
              <span class="text-4xl mb-3">🌍</span>
              <p class="text-sm text-gray-400 text-center px-6 mb-2">No se pudo cargar el mapa</p>
              <a
                href="{{ $mapsUrl }}"
                target="_blank"
                rel="noopener noreferrer"
                class="text-xs text-warm-orange-400 hover:text-warm-orange-300 transition-colors"
              >
                Abrir en Google Maps ↗
              </a>
            </div>

            {{-- Map iframe --}}
            <iframe
              src="{{ $embedUrl }}"
              width="100%"
              height="280"
              style="border:0; filter: grayscale(0.3) invert(0.82);"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              class="rounded-xl transition-all duration-700 ease-out group-hover/map:scale-105"
              title="Ubicación de Bocaditos Criollos"
            ></iframe>
            {{-- Overlay gradient on hover --}}
            <div class="absolute inset-0 rounded-xl ring-1 ring-white/10 group-hover/map:ring-warm-orange-500/30 transition-all duration-500 pointer-events-none"></div>
          </div>

          <p class="text-[11px] text-gray-500 text-center mt-2">
            <a href="{{ $mapsUrl }}" target="_blank" rel="noopener noreferrer" class="no-underline hover:text-warm-orange-400 transition-colors">
              Abrir en Google Maps ↗
            </a>
          </p>
        </div>

      </div>
    </div>
  </div>
</div>
