<?php

namespace App\Http\Controllers;

use App\Mail\NuevoTestimonio;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TestimonialController extends Controller
{
    private const AVATARS = ['😊', '👩', '👨', '👨‍💼', '👩‍🏫', '👨‍🍳', '🏃‍♀️', '👩‍💻', '🎨', '🚖', '👨‍🎓', '👩‍🎓', '👨‍👩‍👧‍👦'];

    private function getNotificationEmail(): string
    {
        return config('app.admin_notification_email') ?: env('ADMIN_NOTIFICATION_EMAIL', 'nuestrosbocaditoscriollos@gmail.com');
    }

    public function store(Request $request)
    {
        // Honeypot: if filled, silently return success (bot detected)
        if (!empty($request->input('website'))) {
            return response()->json([
                'success' => true,
                'message' => 'Tu testimonio ha sido recibido y será revisado pronto.',
            ], 201);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'role' => ['nullable', 'string', 'max:100'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'text' => ['required', 'string', 'min:10', 'max:1000'],
        ]);

        $validated['avatar_emoji'] = self::AVATARS[array_rand(self::AVATARS)];
        $validated['is_approved'] = false;
        $validated['sort_order'] = Testimonial::max('sort_order') + 1;

        $testimonial = Testimonial::create($validated);

        // Send email notification to admin
        try {
            Mail::to($this->getNotificationEmail())
                ->send(new NuevoTestimonio($testimonial));
        } catch (\Throwable $e) {
            // Log the error but don't block the testimonial submission
            Log::error('Error al enviar notificación de nuevo testimonio: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Tu testimonio ha sido recibido y será revisado pronto.',
            'testimonial' => $testimonial,
        ], 201);
    }
}
