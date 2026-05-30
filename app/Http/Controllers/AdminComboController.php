<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminComboController extends Controller
{
    /**
     * Display a listing of all combos.
     */
    public function index()
    {
        $combos = Combo::orderBy('sort_order')->get();
        $activeCount = $combos->where('is_active', true)->count();
        $inactiveCount = $combos->where('is_active', false)->count();

        return view('admin.combos.index', compact(
            'combos',
            'activeCount',
            'inactiveCount'
        ));
    }

    /**
     * Show the form for editing a combo.
     */
    public function edit(Combo $combo)
    {
        return view('admin.combos.edit', compact('combo'));
    }

    /**
     * Update the specified combo.
     */
    public function update(Request $request, Combo $combo)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price'       => ['required', 'numeric', 'min:0', 'max:999999'],
            'size'        => ['nullable', 'string', 'in:tradicional,bocado,adiciones'],
            'is_active'   => ['boolean'],
            'is_featured' => ['boolean'],
            'sort_order'  => ['required', 'integer', 'min:0', 'max:999'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'remove_image' => ['boolean'],
        ]);

        // ---- Handle image upload ----
        if ($request->hasFile('image')) {
            // Delete old image file if exists
            if ($combo->image) {
                Storage::disk('public')->delete($combo->image);
            }

            // Store new image
            $path = $request->file('image')->store('combos', 'public');
            $combo->image_url = Storage::url($path);
            $combo->image = $path;
        }

        // ---- Handle image removal (only if no new file uploaded) ----
        if ($request->boolean('remove_image') && !$request->hasFile('image') && $combo->image) {
            Storage::disk('public')->delete($combo->image);
            $combo->image_url = null;
            $combo->image = null;
        }

        // Activar modo admin para permitir la asignación de campos protegidos
        Combo::$adminOverride = true;
        try {
            $combo->update($validated + [
                'image_url' => $combo->image_url,
                'image'     => $combo->image,
            ]);
        } finally {
            Combo::$adminOverride = false;
        }

        return redirect()->route('admin.combos')
            ->with('success', '✅ Combo actualizado correctamente.');
    }

    /**
     * Remove the specified combo.
     */
    public function destroy(Combo $combo)
    {
        // Delete associated image file
        if ($combo->image) {
            Storage::disk('public')->delete($combo->image);
        }

        $combo->delete();

        return redirect()->route('admin.combos')
            ->with('success', '🗑️ Combo eliminado correctamente.');
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(Combo $combo)
    {
        Combo::$adminOverride = true;
        try {
            $combo->update(['is_active' => !$combo->is_active]);
        } finally {
            Combo::$adminOverride = false;
        }

        $status = $combo->is_active ? 'activado' : 'desactivado';
        return redirect()->route('admin.combos')
            ->with('success', "✅ Combo «{$combo->name}» {$status} correctamente.");
    }
}
