{{-- Testimonial Card Component --}}
<div 
  class="group relative animate-fade-in"
  data-animate
>
  {{-- Card Container --}}
  <div class="card-premium h-full flex flex-col justify-between hover:shadow-premium-lg">
    
    {{-- Stars Rating --}}
    <div class="flex gap-1 mb-4">
      @for ($i = 0; $i < 5; $i++)
        @if ($i < $rating)
          <svg class="w-5 h-5 text-warm-orange-400 fill-current" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
          </svg>
        @else
          <svg class="w-5 h-5 text-gray-600 fill-current" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
          </svg>
        @endif
      @endfor
    </div>

    {{-- Testimonial Text --}}
    <p class="text-gray-300 text-base leading-relaxed mb-6 flex-1">
      "{{ $text }}"
    </p>

    {{-- Divider --}}
    <div class="mb-6 h-px bg-gradient-to-r from-transparent via-warm-orange-500/30 to-transparent"></div>

    {{-- Author Info --}}
    <div class="flex items-center gap-4">
      
      {{-- Avatar --}}
      <div class="relative">
        <div class="w-12 h-12 rounded-full bg-gradient-to-br {{ $avatarGradient ?? 'from-burnt-red-500 to-warm-orange-600' }} flex items-center justify-center text-xl shadow-lg">
          {{ $avatar ?? '😊' }}
        </div>
        <div class="absolute -inset-0.5 bg-gradient-to-br {{ $avatarGradient ?? 'from-burnt-red-500 to-warm-orange-600' }} rounded-full opacity-20 blur group-hover:opacity-40 transition-opacity duration-300"></div>
      </div>

      {{-- Name & Role --}}
      <div>
        <h4 class="font-display font-bold text-cream text-sm sm:text-base">
          {{ $name }}
        </h4>
        <p class="text-xs text-gray-500">
          {{ $role ?? 'Cliente Satisfecho' }}
        </p>
      </div>

    </div>

  </div>
</div>
