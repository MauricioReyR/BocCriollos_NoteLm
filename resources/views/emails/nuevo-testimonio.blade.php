<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Testimonio</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #1f2937;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 24px;
        }
        .card {
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        }
        .header {
            background: linear-gradient(135deg, #ea580c, #c2410c);
            padding: 32px 28px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
        }
        .header .emoji {
            font-size: 40px;
            margin-bottom: 8px;
        }
        .body {
            padding: 28px;
        }
        .meta-grid {
            display: flex;
            gap: 16px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .meta-item {
            background: #fef3c7;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
        }
        .meta-item strong {
            color: #92400e;
        }
        .quote {
            background: #f8fafc;
            border-left: 4px solid #ea580c;
            padding: 16px 20px;
            border-radius: 0 8px 8px 0;
            font-style: italic;
            color: #475569;
            line-height: 1.6;
            margin: 0;
            white-space: pre-wrap;
        }
        .btn {
            display: inline-block;
            background: #ea580c;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            margin-top: 20px;
        }
        .btn:hover {
            background: #c2410c;
        }
        .footer {
            text-align: center;
            padding: 20px 28px;
            color: #9ca3af;
            font-size: 13px;
            border-top: 1px solid #f3f4f6;
        }
        .stars {
            color: #f59e0b;
            font-size: 18px;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <div class="emoji">💬</div>
                <h1>¡Nuevo Testimonio Recibido!</h1>
            </div>

            <div class="body">
                <p style="margin-top: 0; font-size: 16px; color: #64748b;">
                    Un cliente ha compartido su experiencia en Bocaditos Criollos. 
                    Revisa el testimonio y apruebalo para que se publique en el sitio web.
                </p>

                <div class="meta-grid">
                    <div class="meta-item">
                        <strong>👤 {{ $testimonial->name }}</strong>
                        @if($testimonial->role)
                            <span style="color: #92400e;"> — {{ $testimonial->role }}</span>
                        @endif
                    </div>
                    <div class="meta-item">
                        <strong>⭐ Calificación:</strong>
                        <span class="stars">{{ str_repeat('★', $testimonial->rating) }}{{ str_repeat('☆', 5 - $testimonial->rating) }}</span>
                    </div>
                </div>

                <div style="margin-bottom: 8px; font-size: 14px; color: #64748b; font-weight: 600;">
                    📝 Testimonio:
                </div>
                <p class="quote">{{ $testimonial->text }}</p>

                <div style="text-align: center;">
                    <a href="{{ url('/admin/testimonials/' . $testimonial->id . '/edit') }}" class="btn">
                        🔍 Revisar y Aprobar
                    </a>
                </div>
            </div>

            <div class="footer">
                <p>Este mensaje fue enviado automáticamente desde el sitio web de Bocaditos Criollos.</p>
                <p style="margin-bottom: 0;">&copy; {{ date('Y') }} Bocaditos Criollos. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</body>
</html>
