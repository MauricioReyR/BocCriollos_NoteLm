<x-layout title="Bocaditos Criollos - Auténtica Comida Colombiana">
  {{-- Hero Section --}}
  @include('sections.hero')

  {{-- Nuestros Combos Section --}}
  @include('sections.combos', ['combos' => $combos])

  {{-- Productos + Categorías con filtro compartido --}}
  <div x-data="{ selectedCategory: null }">
    @include('sections.productos', ['products' => $featuredProducts])
    @include('sections.categorias', ['categories' => $categories])
  </div>

  {{-- Testimonios Section --}}
  @include('sections.testimonios')

  {{-- CTA WhatsApp Section --}}
  @include('sections.cta-whatsapp')

</x-layout>
