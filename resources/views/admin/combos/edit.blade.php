<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Editar Combo - Bocaditos Criollos</title>
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
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            color: #F5F0E8;
            font-size: 0.9rem;
            transition: all 0.2s;
            outline: none;
        }
        .form-input:focus {
            border-color: rgba(230, 126, 34, 0.5);
            box-shadow: 0 0 0 3px rgba(230, 126, 34, 0.1);
            background: rgba(255, 255, 255, 0.05);
        }
        .form-input::placeholder { color: #6B7280; }
        textarea.form-input { min-height: 120px; resize: vertical; }
        select.form-input { cursor: pointer; }
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #D1D5DB;
            margin-bottom: 0.5rem;
        }
        .toggle-switch {
            position: relative;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
        }
        .toggle-track {
            width: 2.75rem;
            height: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 9999px;
            transition: all 0.2s;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .toggle-switch input:checked ~ .toggle-track {
            background: rgba(85, 107, 47, 0.5);
            border-color: rgba(85, 107, 47, 0.3);
        }
        .toggle-dot {
            position: absolute;
            top: 0.1875rem;
            left: 0.25rem;
            width: 1.125rem;
            height: 1.125rem;
            background: #F5F0E8;
            border-radius: 50%;
            transition: all 0.2s;
        }
        .toggle-switch input:checked ~ .toggle-dot {
            transform: translateX(1.25rem);
            background: #8FBC5A;
        }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8">
    <div class="max-w-2xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.combos') }}" class="p-2 rounded-lg border border-white/10 text-gray-400 hover:text-cream hover:border-white/20 transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-display font-bold text-cream">Editar Combo</h1>
                <p class="text-gray-500 text-sm">Editando <strong class="text-cream">{{ $combo->name }}</strong></p>
            </div>
        </div>

        {{-- Card --}}
        <div class="admin-card rounded-2xl p-8 shadow-premium">
            <form method="POST" action="{{ route('admin.combos.update', $combo) }}" class="space-y-6" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Toggles Row --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 rounded-xl bg-warm-gray/30 border border-white/5">
                    {{-- Active --}}
                    <div class="flex items-center gap-3">
                        <label class="toggle-switch">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $combo->is_active ? 'checked' : '' }}>
                            <div class="toggle-track"></div>
                            <div class="toggle-dot"></div>
                        </label>
                        <div>
                            <p class="text-cream text-sm font-medium">Activo</p>
                            <p class="text-gray-500 text-xs">Visible en frontend</p>
                        </div>
                    </div>

                    {{-- Featured --}}
                    <div class="flex items-center gap-3">
                        <label class="toggle-switch">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ $combo->is_featured ? 'checked' : '' }}>
                            <div class="toggle-track"></div>
                            <div class="toggle-dot"></div>
                        </label>
                        <div>
                            <p class="text-cream text-sm font-medium">Destacado</p>
                            <p class="text-gray-500 text-xs">Sección "Más Pedidos"</p>
                        </div>
                    </div>

                    {{-- Sort Order --}}
                    <div>
                        <label for="sort_order" class="block text-xs font-medium text-gray-400 mb-1">Orden</label>
                        <input
                            id="sort_order"
                            type="number"
                            name="sort_order"
                            value="{{ old('sort_order', $combo->sort_order) }}"
                            class="form-input text-center"
                            min="0"
                            max="999"
                        >
                        @error('sort_order')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Name --}}
                <div>
                    <label for="name" class="form-label">
                        Nombre del combo <span class="text-warm-orange-400">*</span>
                    </label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $combo->name) }}"
                        class="form-input @error('name') !border-red-500/50 !ring-2 !ring-red-500/50 @enderror"
                        maxlength="255"
                        required
                    >
                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="form-label">
                        Descripción
                        <span class="text-gray-500 font-normal">(opcional)</span>
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-input @error('description') !border-red-500/50 !ring-2 !ring-red-500/50 @enderror"
                        maxlength="2000"
                    >{{ old('description', $combo->description) }}</textarea>
                    @error('description')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Image Upload --}}
                <div>
                    <label class="form-label">
                        Imagen del combo
                        <span class="text-gray-500 font-normal">(opcional — sube una foto real del producto)</span>
                    </label>

                    {{-- Current Image Preview --}}
                    <div id="current-image-container" class="mb-4 {{ $combo->image_url ? '' : 'hidden' }}">
                        <div class="relative inline-block group">
                            <img
                                id="current-image"
                                src="{{ $combo->image_url }}"
                                alt="{{ $combo->name }}"
                                class="w-full max-w-sm h-48 object-cover rounded-xl border border-white/10"
                                onerror="this.closest('#current-image-container').classList.add('hidden')"
                            >
                            <div class="absolute inset-0 rounded-xl bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
                                <span class="text-white/0 group-hover:text-white/80 text-xs font-medium transition-all duration-300">Imagen actual</span>
                            </div>
                        </div>
                    </div>

                    {{-- Upload Area --}}
                    <div class="relative">
                        <label
                            for="image"
                            class="flex flex-col items-center justify-center w-full min-h-[160px] px-6 py-8 rounded-xl border-2 border-dashed border-white/10 bg-transparent cursor-pointer hover:border-warm-orange-500/50 hover:bg-warm-orange-500/5 transition-all duration-300 group"
                        >
                            {{-- Upload Icon --}}
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-14 h-14 rounded-full bg-warm-orange-500/10 border border-warm-orange-500/20 flex items-center justify-center group-hover:bg-warm-orange-500/20 group-hover:border-warm-orange-500/30 transition-all duration-300">
                                    <svg class="w-6 h-6 text-warm-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-400 text-sm group-hover:text-cream transition-colors">
                                        <span class="font-semibold text-warm-orange-400">Click para seleccionar</span>
                                        <span class="text-gray-500"> o arrastra una imagen</span>
                                    </p>
                                    <p class="text-gray-600 text-xs mt-1">JPG, PNG, WebP — Máx 2MB</p>
                                </div>
                            </div>

                            {{-- New Preview (hidden until file selected) --}}
                            <div id="new-preview" class="hidden mt-4 w-full max-w-sm">
                                <div class="relative">
                                    <img id="new-preview-img" src="" alt="Preview" class="w-full h-48 object-cover rounded-xl border border-warm-orange-500/30">
                                    <button type="button" id="clear-image-btn" class="absolute top-2 right-2 p-1.5 rounded-full bg-elegant-black/80 backdrop-blur-md border border-white/10 text-gray-400 hover:text-cream hover:border-white/20 transition-all" title="Quitar selección">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <input
                                id="image"
                                type="file"
                                name="image"
                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                class="hidden"
                            >
                        </label>
                    </div>

                    {{-- Remove Image --}}
                    @if($combo->image_url)
                        <div class="mt-3 flex items-center gap-2">
                            <input type="hidden" name="remove_image" value="0">
                            <input
                                id="remove_image"
                                type="checkbox"
                                name="remove_image"
                                value="1"
                                class="rounded border-white/10 bg-transparent text-burnt-red-500 focus:ring-burnt-red-500/50"
                            >
                            <label for="remove_image" class="text-sm text-gray-400 hover:text-burnt-red-400 cursor-pointer transition-colors">
                                Eliminar imagen actual
                            </label>
                        </div>
                    @endif

                    @error('image')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Price & Size Row --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Price --}}
                    <div>
                        <label for="price" class="form-label">
                            Precio <span class="text-warm-orange-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-medium">$</span>
                            <input
                                id="price"
                                type="number"
                                name="price"
                                value="{{ old('price', intval($combo->price)) }}"
                                class="form-input pl-8 @error('price') !border-red-500/50 !ring-2 !ring-red-500/50 @enderror"
                                min="0"
                                step="100"
                                required
                            >
                        </div>
                        @error('price')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Size --}}
                    <div>
                        <label for="size" class="form-label">
                            Tamaño / Categoría
                            <span class="text-gray-500 font-normal">(opcional)</span>
                        </label>
                        <select
                            id="size"
                            name="size"
                            class="form-input @error('size') !border-red-500/50 !ring-2 !ring-red-500/50 @enderror"
                        >
                            <option value="">— Sin categoría —</option>
                            <option value="tradicional" {{ old('size', $combo->size) === 'tradicional' ? 'selected' : '' }}>🥟 Tradicional</option>
                            <option value="bocado" {{ old('size', $combo->size) === 'bocado' ? 'selected' : '' }}>🌮 Bocado</option>
                            <option value="adiciones" {{ old('size', $combo->size) === 'adiciones' ? 'selected' : '' }}>🥤 Adiciones</option>
                        </select>
                        @error('size')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-between pt-4 border-t border-white/5">
                    <a href="{{ route('admin.combos') }}" class="text-gray-400 hover:text-cream transition-colors text-sm">
                        ← Volver al listado
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-warm-orange-500 to-burnt-red-600 text-white font-bold hover:from-warm-orange-400 hover:to-burnt-red-500 transition-all duration-300 shadow-lg shadow-warm-orange-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Guardar Cambios</span>
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
            const fileInput = document.getElementById('image');
            const newPreview = document.getElementById('new-preview');
            const newPreviewImg = document.getElementById('new-preview-img');
            const clearBtn = document.getElementById('clear-image-btn');
            const removeCheckbox = document.getElementById('remove_image');
            const currentContainer = document.getElementById('current-image-container');

            // Show preview when a file is selected
            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            newPreviewImg.src = e.target.result;
                            newPreview.classList.remove('hidden');
                            // Hide current image when new one is selected
                            if (currentContainer) {
                                currentContainer.classList.add('hidden');
                            }
                            // Uncheck remove if was checked
                            if (removeCheckbox) {
                                removeCheckbox.checked = false;
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Clear selected file
            if (clearBtn) {
                clearBtn.addEventListener('click', function() {
                    fileInput.value = '';
                    newPreview.classList.add('hidden');
                    newPreviewImg.src = '';
                    // Show current image again if exists
                    if (currentContainer && '{{ $combo->image_url }}') {
                        currentContainer.classList.remove('hidden');
                    }
                });
            }

            // When remove checkbox is checked, hide current image
            if (removeCheckbox) {
                removeCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        if (currentContainer) currentContainer.classList.add('hidden');
                        fileInput.value = '';
                        newPreview.classList.add('hidden');
                        newPreviewImg.src = '';
                    } else {
                        if (currentContainer && '{{ $combo->image_url }}') {
                            currentContainer.classList.remove('hidden');
                        }
                    }
                });
            }

            // Show file name on drag-and-drop (visual feedback)
            const dropZone = document.querySelector('label[for="image"]');
            if (dropZone) {
                ['dragenter', 'dragover'].forEach(event => {
                    dropZone.addEventListener(event, function(e) {
                        e.preventDefault();
                        this.classList.add('border-warm-orange-500', 'bg-warm-orange-500/10');
                    });
                });
                ['dragleave', 'drop'].forEach(event => {
                    dropZone.addEventListener(event, function(e) {
                        e.preventDefault();
                        this.classList.remove('border-warm-orange-500', 'bg-warm-orange-500/10');
                    });
                });
            }
        });
    </script>
</body>
</html>
