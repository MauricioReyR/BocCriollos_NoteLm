<x-layout title="Bocaditos Criollos - Auténtica Comida Colombiana">
  {{-- Hero Section --}}
  @include('sections.hero')

  {{-- Nuestros Combos Section --}}
  @include('sections.combos')

  {{-- Productos Destacados Section --}}
  @include('sections.productos', ['products' => $featuredProducts])

  {{-- Categorías Section --}}
  @include('sections.categorias', ['categories' => $categories])

  {{-- Testimonios Section --}}
  @include('sections.testimonios')

  {{-- CTA WhatsApp Section --}}
  @include('sections.cta-whatsapp')

</x-layout>
