<div align="center">
  <br>
  <h1>🍔 Bocaditos Criollos</h1>
  <p><strong>Auténtica Comida Colombiana — Engativá, Bogotá</strong></p>
  <br>
  <p>
    <img src="https://img.shields.io/badge/Laravel-10.x-red?logo=laravel" alt="Laravel 10">
    <img src="https://img.shields.io/badge/PHP-8.1+-purple?logo=php" alt="PHP 8.1+">
    <img src="https://img.shields.io/badge/Tailwind-3.3-06B6D4?logo=tailwindcss" alt="Tailwind CSS 3">
    <img src="https://img.shields.io/badge/Alpine.js-3.3-8BC0D0?logo=alpine.js" alt="Alpine.js 3">
    <img src="https://img.shields.io/badge/Vite-5-646CFF?logo=vite" alt="Vite 5">
  </p>
  <br>
</div>

## 📋 Descripción

Sitio web profesional de **Bocaditos Criollos**, un negocio de comida rápida tradicional colombiana ubicado en **Engativá, Bogotá**. El sitio permite a los clientes conocer el menú, explorar categorías, leer testimonios y realizar pedidos directamente a través de WhatsApp.

## ✨ Características

- **🥟 Menú Interactivo** — Visualización de productos con precios dinámicos y selectores de tamaños
- **🍱 Sección de Combos** — Combos familiares con precios especiales
- **🏷️ Filtro por Categorías** — Navegación y filtrado de productos por categoría con Alpine.js
- **💬 Testimonios** — Sección de reseñas de clientes con calificaciones
- **📱 Pedidos por WhatsApp** — Botones CTA en toda la página que abren WhatsApp con mensajes predefinidos
- **📍 Información de la Tienda** — Dirección, horarios, mapa interactivo de Google Maps
- **🌐 SEO Optimizado** — Meta tags Open Graph, Twitter Cards, Schema.org JSON-LD (LocalBusiness)
- **📱 Diseño 100% Responsive** — Adaptado a móvil, tablet y desktop
- **🎨 Animaciones Premium** — Scroll reveal, transiciones suaves, efectos glassmorphism
- **⚡ Rendimiento** — Fuentes async, lazy loading de imágenes, Vite para build

## 🛠️ Stack Tecnológico

| Tecnología | Versión | Propósito |
|---|---|---|
| **Laravel** | 10.x | Framework PHP backend |
| **PHP** | ≥ 8.1 | Lenguaje de programación |
| **Tailwind CSS** | 3.3.5 | Estilos y diseño responsive |
| **Alpine.js** | 3.13.3 | Interactividad frontend (filtros, tooltips, menú mobile) |
| **Vite** | 5.x | Bundler y dev server |
| **Laravel Sanctum** | 3.x | API tokens (futuro) |

## 🚀 Instalación

```bash
# Clonar el repositorio
git clone <repo-url>
cd BocCriollos_NoteLm

# Instalar dependencias PHP
composer install

# Instalar dependencias JS
npm install

# Copiar y configurar variables de entorno
cp .env.example .env
php artisan key:generate

# Configurar base de datos en .env y ejecutar migraciones
php artisan migrate --seed

# Compilar assets para desarrollo
npm run dev

# O compilar para producción
npm run build
```

## ⚙️ Configuración

Los datos de la tienda están centralizados en `config/store.php`:

| Clave | Valor |
|---|---|
| **Nombre** | Bocaditos Criollos |
| **Dirección** | Carrera 87 # 68 - 91, Local esquina, Engativá |
| **Teléfono** | +57 3138513658 |
| **WhatsApp** | [wa.me/573138513658](https://wa.me/573138513658) |
| **Email** | nuestrosbocaditoscriollos@gmail.com |
| **Horario L-S** | 8:30 AM - 8:00 PM |
| **Horario Dom/Fest** | 2:00 PM - 6:00 PM (solo domicilios) |

## 📁 Estructura del Proyecto

```
├── app/                    # Lógica de backend (Modelos, Controladores, Helpers)
├── config/
│   └── store.php           # Datos centralizados de la tienda
├── database/
│   ├── migrations/         # Migraciones de base de datos
│   └── factories/          # Factories para testing
├── public/
│   └── images/             # Imágenes (favicon, OG Image, etc.)
├── resources/
│   ├── css/app.css         # Estilos Tailwind + custom
│   ├── js/app.js           # JavaScript + Alpine.js
│   └── views/
│       ├── components/     # Componentes Blade reutilizables
│       │   ├── navbar.blade.php
│       │   ├── footer.blade.php
│       │   ├── product-card.blade.php
│       │   ├── category-card.blade.php
│       │   ├── testimonial-card.blade.php
│       │   └── store-location-card.blade.php
│       ├── sections/       # Secciones de la landing page
│       │   ├── hero.blade.php
│       │   ├── productos.blade.php
│       │   ├── combos.blade.php
│       │   ├── categorias.blade.php
│       │   ├── testimonios.blade.php
│       │   └── cta-whatsapp.blade.php
│       └── pages/          # Páginas (home)
└── routes/web.php          # Rutas web
```

## 🌐 Secciones del Sitio

| Sección | ID | Descripción |
|---|---|---|
| **Hero** | `#hero` | Portada principal con CTA a WhatsApp |
| **Combos** | `#combos` | Combos familiares destacados |
| **Productos** | `#productos` | Menú con filtro por categorías |
| **Categorías** | `#categorias` | Tarjetas de categorías con filtro interactivo |
| **Testimonios** | `#testimonios` | Reseñas de clientes |
| **CTA WhatsApp** | `#cta-whatsapp` | Llamado a la acción + ubicación y horarios |

## 📞 Contacto

- **WhatsApp:** [+57 3138513658](https://wa.me/573138513658)
- **Email:** [nuestrosbocaditoscriollos@gmail.com](mailto:nuestrosbocaditoscriollos@gmail.com)
- **Instagram:** [@bocaditoscriollos](https://www.instagram.com/bocaditoscriollos/)
- **Facebook:** [Bocaditos Criollos](https://www.facebook.com/Bocaditos-Criollos-1487704988144414/)
- **Dirección:** Carrera 87 # 68 - 91, Local esquina, Engativá, Bogotá

## 📄 Licencia

Este proyecto es de código abierto bajo la licencia [MIT](https://opensource.org/licenses/MIT).
