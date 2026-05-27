<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestión de Testimonios - Bocaditos Criollos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        body { background-color: #0F0F0F; }
        .admin-card {
            background: linear-gradient(135deg, #1a1a1a 0%, #2C2C2C 100%);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .admin-table th {
            font-family: 'Inter', system-ui, sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.75rem;
            color: #9CA3AF;
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .admin-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            vertical-align: top;
        }
        .admin-table tr:hover td {
            background-color: rgba(255, 255, 255, 0.02);
        }
        .badge-pending {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            background-color: rgba(230, 126, 34, 0.15);
            color: #F7A343;
            border: 1px solid rgba(230, 126, 34, 0.3);
        }
        .badge-approved {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            background-color: rgba(85, 107, 47, 0.15);
            color: #8FBC5A;
            border: 1px solid rgba(85, 107, 47, 0.3);
        }
        .text-truncate {
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .stat-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            padding: 1.25rem;
        }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8">
    <div class="max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-burnt-red-500 to-warm-orange-600 flex items-center justify-center text-2xl shadow-lg">
                    🥟
                </div>
                <div>
                    <h1 class="text-2xl font-display font-bold text-cream">Panel de Administración</h1>
                    <p class="text-gray-500 text-sm">Gestión de Testimonios</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-white/10 text-gray-400 hover:text-cream hover:border-white/20 transition-all duration-300 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </div>

        {{-- Navigation Tabs --}}
        <style>
            .nav-tab {
                padding: 0.625rem 1.25rem;
                border-radius: 0.75rem;
                font-size: 0.875rem;
                font-weight: 600;
                transition: all 0.2s;
            }
            .nav-tab-active {
                background: rgba(230, 126, 34, 0.15);
                color: #F7A343;
                border: 1px solid rgba(230, 126, 34, 0.3);
            }
            .nav-tab-inactive {
                color: #6B7280;
                border: 1px solid transparent;
            }
            .nav-tab-inactive:hover {
                color: #D1D5DB;
                background: rgba(255, 255, 255, 0.03);
                border-color: rgba(255, 255, 255, 0.05);
            }
        </style>
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('admin.testimonios') }}" class="nav-tab nav-tab-active">
                <span class="flex items-center gap-2">
                    <span>💬</span>
                    <span>Testimonios</span>
                </span>
            </a>
            <a href="{{ route('admin.combos') }}" class="nav-tab nav-tab-inactive">
                <span class="flex items-center gap-2">
                    <span>🍽️</span>
                    <span>Combos</span>
                </span>
            </a>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-earth-green/20 border border-earth-green/40 text-cream text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session('info'))
            <div class="mb-6 p-4 rounded-xl bg-warm-orange-500/20 border border-warm-orange-500/40 text-cream text-sm">
                {{ session('info') }}
            </div>
        @endif

        {{-- Stats --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div class="stat-card">
                <p class="text-gray-500 text-xs uppercase tracking-widest font-semibold mb-1">Total</p>
                <p class="text-3xl font-display font-bold text-cream">{{ $testimonials->count() }}</p>
            </div>
            <div class="stat-card">
                <p class="text-gray-500 text-xs uppercase tracking-widest font-semibold mb-1">Pendientes</p>
                <p class="text-3xl font-display font-bold text-warm-orange-400">{{ $pendingCount }}</p>
            </div>
            <div class="stat-card">
                <p class="text-gray-500 text-xs uppercase tracking-widest font-semibold mb-1">Aprobados</p>
                <p class="text-3xl font-display font-bold text-earth-green">{{ $approvedCount }}</p>
            </div>
        </div>

        {{-- Table --}}
        <div class="admin-card rounded-2xl overflow-hidden shadow-premium">
            @if($testimonials->isEmpty())
                <div class="text-center py-16">
                    <div class="text-4xl mb-4">📭</div>
                    <h3 class="text-xl font-display font-bold text-cream mb-2">No hay testimonios</h3>
                    <p class="text-gray-500">Aún no se han recibido testimonios de clientes.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="admin-table w-full">
                        <thead>
                            <tr>
                                <th>Estado</th>
                                <th>Cliente</th>
                                <th>Valoración</th>
                                <th class="hidden md:table-cell">Testimonio</th>
                                <th>Fecha</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($testimonials as $testimonial)
                                <tr>
                                    {{-- Status --}}
                                    <td>
                                        @if($testimonial->is_approved)
                                            <span class="badge-approved">
                                                <span>✓</span>
                                                <span>Aprobado</span>
                                            </span>
                                        @else
                                            <span class="badge-pending">
                                                <span>⏳</span>
                                                <span>Pendiente</span>
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Client --}}
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <span class="text-xl">{{ $testimonial->avatar }}</span>
                                            <div>
                                                <p class="text-cream font-medium text-sm">{{ $testimonial->name }}</p>
                                                @if($testimonial->role)
                                                    <p class="text-gray-500 text-xs">{{ $testimonial->role }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Rating --}}
                                    <td>
                                        <div class="flex gap-0.5">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $testimonial->rating)
                                                    <svg class="w-4 h-4 text-warm-orange-400 fill-current" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4 text-gray-600 fill-current" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                    </td>

                                    {{-- Text --}}
                                    <td class="hidden md:table-cell">
                                        <p class="text-gray-400 text-sm text-truncate">"{{ $testimonial->text }}"</p>
                                    </td>

                                    {{-- Date --}}
                                    <td>
                                        <p class="text-gray-500 text-xs whitespace-nowrap">{{ $testimonial->created_at->format('d/m/Y') }}</p>
                                        <p class="text-gray-600 text-xs whitespace-nowrap">{{ $testimonial->created_at->format('h:i A') }}</p>
                                    </td>

                                    {{-- Actions --}}
                                    <td>
                                        <div class="flex items-center justify-end gap-2">
                                            {{-- Approve --}}
                                            @unless($testimonial->is_approved)
                                                <form method="POST" action="{{ route('admin.testimonios.approve', $testimonial) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="p-2 rounded-lg bg-earth-green/10 border border-earth-green/20 text-earth-green hover:bg-earth-green/20 transition-all duration-200" title="Aprobar">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endunless

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.testimonios.edit', $testimonial) }}" class="p-2 rounded-lg bg-warm-orange-500/10 border border-warm-orange-500/20 text-warm-orange-400 hover:bg-warm-orange-500/20 transition-all duration-200" title="Editar">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>

                                            {{-- Delete --}}
                                            <form method="POST" action="{{ route('admin.testimonios.destroy', $testimonial) }}" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este testimonio de «{{ $testimonial->name }}»? Esta acción no se puede deshacer.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-lg bg-burnt-red-500/10 border border-burnt-red-500/20 text-burnt-red-400 hover:bg-burnt-red-500/20 transition-all duration-200" title="Eliminar">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Footer --}}
        <p class="text-center mt-8 text-gray-600 text-xs">
            &copy; {{ date('Y') }} Bocaditos Criollos &mdash; Panel de Administración
        </p>
    </div>
</body>
</html>
