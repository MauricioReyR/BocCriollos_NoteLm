<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminTestimonialController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle admin login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $adminPassword = config('admin.password');

        if (! $adminPassword || ! Hash::check($request->password, $adminPassword)) {
            return back()->withErrors([
                'password' => 'La contraseña ingresada es incorrecta.',
            ])->onlyInput('password');
        }

        $request->session()->put('admin_authenticated', true);
        $request->session()->regenerate();

        return redirect()->route('admin.testimonios')
            ->with('success', '✅ Sesión iniciada correctamente.');
    }

    /**
     * Handle admin logout.
     */
    public function logout(Request $request)
    {
        $request->session()->forget('admin_authenticated');
        $request->session()->regenerate();

        return redirect()->route('admin.login')
            ->with('success', '👋 Sesión cerrada correctamente.');
    }

    /**
     * Display a listing of all testimonials.
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        $pendingCount = $testimonials->where('is_approved', false)->count();
        $approvedCount = $testimonials->where('is_approved', true)->count();

        return view('admin.testimonios.index', compact(
            'testimonials',
            'pendingCount',
            'approvedCount'
        ));
    }

    /**
     * Show the form for editing a testimonial.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonios.edit', compact('testimonial'));
    }

    /**
     * Update the specified testimonial.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'role' => ['nullable', 'string', 'max:100'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'text' => ['required', 'string', 'min:10', 'max:1000'],
            'is_approved' => ['boolean'],
        ]);

        $testimonial->update($validated);

        return redirect()->route('admin.testimonios')
            ->with('success', '✅ Testimonio actualizado correctamente.');
    }

    /**
     * Remove the specified testimonial.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonios')
            ->with('success', '🗑️ Testimonio eliminado correctamente.');
    }

    /**
     * Approve a testimonial.
     */
    public function approve(Testimonial $testimonial)
    {
        if ($testimonial->is_approved) {
            return redirect()->route('admin.testimonios')
                ->with('info', 'Este testimonio ya estaba aprobado.');
        }

        $testimonial->update(['is_approved' => true]);

        return redirect()->route('admin.testimonios')
            ->with('success', '✅ Testimonio aprobado correctamente.');
    }
}
