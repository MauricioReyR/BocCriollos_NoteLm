<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Editar Testimonio - Bocaditos Criollos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        body { background-color: #0F0F0F; }
        .admin-card {
            background: linear-gradient(135deg, #1a1a1a 0%, #2C2C2C 100%);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8">
    <div class="max-w-2xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.testimonios') }}" class="p-2 rounded-lg border border-white/10 text-gray-400 hover:text-cream hover:border-white/20 transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-display font-bold text-cream">Editar Testimonio</h1>
                <p class="text-gray-500 text-sm">Editando testimonio de <strong class="text-cream">{{ $testimonial->name }}</strong></p>
            </div>
        </div>

        {{-- Card --}}
        <div class="admin-card rounded-2xl p-8 shadow-premium">
            <form method="POST" action="{{ route('admin.testimonios.update', $testimonial) }}" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Estado --}}
                <div class="flex items-center gap-3 p-4 rounded-xl bg-warm-gray/30 border border-white/5">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="is_approved" value="0">
                        <input type="checkbox" name="is_approved" value="1" class="sr-only peer" id="is-approved" {{ $testimonial->is_approved ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-warm-gray/50 rounded-full peer peer-checked:bg-earth-green peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-cream after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                    </label>
                    <div>
                        <p class="text-cream text-sm font-medium">Testimonio aprobado</p>
                        <p class="text-gray-500 text-xs">Si está activo, se muestra en la página principal</p>
                    </div>
                </div>

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                        Nombre del cliente <span class="text-warm-orange-400">*</span>
                    </label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $testimonial->name) }}"
                        class="w-full @error('name') ring-2 ring-red-500/50 border-red-500/50 @enderror"
                        maxlength="100"
                        required
                    >
                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-300 mb-2">
                        Profesión o rol
                        <span class="text-gray-500 font-normal">(opcional)</span>
                    </label>
                    <input
                        id="role"
                        type="text"
                        name="role"
                        value="{{ old('role', $testimonial->role) }}"
                        class="w-full"
                        maxlength="100"
                    >
                </div>

                {{-- Rating --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-3">
                        Calificación <span class="text-warm-orange-400">*</span>
                    </label>
                    <div class="flex gap-2" id="rating-container" data-current="{{ old('rating', $testimonial->rating) }}">
                        @for ($i = 1; $i <= 5; $i++)
                            <button
                                type="button"
                                data-rating-value="{{ $i }}"
                                class="rating-star transition-all duration-150 hover:scale-110 focus:outline-none"
                            >
                                <svg
                                    class="w-8 h-8 transition-all duration-200 rating-svg {{ $i <= old('rating', $testimonial->rating) ? 'text-warm-orange-400' : 'text-gray-600' }}"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </button>
                        @endfor
                        <input type="hidden" name="rating" id="rating-input" value="{{ old('rating', $testimonial->rating) }}">
                    </div>
                    @error('rating')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Text --}}
                <div>
                    <label for="text" class="block text-sm font-medium text-gray-300 mb-2">
                        Texto del testimonio <span class="text-warm-orange-400">*</span>
                    </label>
                    <textarea
                        id="text"
                        name="text"
                        class="w-full min-h-[120px] resize-y @error('text') ring-2 ring-red-500/50 border-red-500/50 @enderror"
                        maxlength="1000"
                        required
                    >{{ old('text', $testimonial->text) }}</textarea>
                    @error('text')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-between pt-4 border-t border-white/5">
                    <a href="{{ route('admin.testimonios') }}" class="text-gray-400 hover:text-cream transition-colors text-sm">
                        ← Volver al listado
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Guardar Cambios</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Footer --}}
        <p class="text-center mt-8 text-gray-600 text-xs">
            &copy; {{ date('Y') }} Bocaditos Criollos &mdash; Panel de Administración
        </p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('rating-container');
            const ratingInput = document.getElementById('rating-input');
            const stars = container.querySelectorAll('.rating-star');

            function updateStars(value) {
                stars.forEach(function(star) {
                    const starValue = parseInt(star.dataset.ratingValue);
                    const svg = star.querySelector('.rating-svg');
                    if (starValue <= value) {
                        svg.classList.add('text-warm-orange-400');
                        svg.classList.remove('text-gray-600');
                    } else {
                        svg.classList.remove('text-warm-orange-400');
                        svg.classList.add('text-gray-600');
                    }
                });
                ratingInput.value = value;
            }

            stars.forEach(function(star) {
                star.addEventListener('click', function() {
                    const value = parseInt(this.dataset.ratingValue);
                    updateStars(value);
                });
            });
        });
    </script>
</body>
</html>
