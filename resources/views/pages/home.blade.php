<x-layout title="Bocaditos Criollos - Auténtica Comida Colombiana">
  {{-- Hero Section --}}
  @include('sections.hero')

  {{-- Nuestros Combos Section --}}
  @include('sections.combos', ['combos' => $combos])

  {{-- Testimonios Section --}}
  @include('sections.testimonios')

  {{-- CTA WhatsApp Section --}}
  @include('sections.cta-whatsapp')

</x-layout>
