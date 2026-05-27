<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Bocaditos Criollos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        body { background-color: #0F0F0F; }
        .admin-login-card {
            background: linear-gradient(135deg, #1a1a1a 0%, #2C2C2C 100%);
            border: 1px solid rgba(230, 126, 34, 0.2);
        }
        .admin-login-card:hover {
            border-color: rgba(230, 126, 34, 0.4);
            box-shadow: 0 25px 60px -12px rgba(15, 15, 15, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        {{-- Branding --}}
        <div class="text-center mb-8">
            <div class="text-5xl mb-4">🥟</div>
            <h1 class="text-2xl font-display font-bold text-cream mb-1">Bocaditos Criollos</h1>
            <p class="text-gray-500 text-sm">Panel de Administración</p>
        </div>

        {{-- Card --}}
        <div class="admin-login-card rounded-2xl p-8 shadow-premium transition-all duration-300">
            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-earth-green/20 border border-earth-green/40 text-cream text-sm text-center">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-burnt-red-500/20 border border-burnt-red-500/40 text-cream text-sm text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                        Contraseña de Administrador
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autofocus
                        autocomplete="current-password"
                        placeholder="Ingresa la contraseña"
                        class="w-full @error('password') ring-2 ring-red-500/50 border-red-500/50 @enderror"
                    >
                    @error('password')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-full py-3 text-base">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span>Ingresar al Panel</span>
                    </span>
                </button>
            </form>
        </div>

        {{-- Footer --}}
        <p class="text-center mt-8 text-gray-600 text-xs">
            &copy; {{ date('Y') }} Bocaditos Criollos &mdash; Todos los derechos reservados.
        </p>
    </div>
</body>
</html>
