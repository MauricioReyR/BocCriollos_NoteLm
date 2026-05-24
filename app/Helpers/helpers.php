<?php

if (!function_exists('whatsapp_url')) {
    /**
     * Generate a WhatsApp URL with an optional pre-encoded message.
     *
     * @param  string|null  $text  Pre-URL-encoded message text (e.g. 'Hola%20Bocaditos...')
     * @return string
     */
    function whatsapp_url(?string $text = null): string
    {
        $base = config('store.whatsapp_url');

        if (!$text) {
            return $base;
        }

        return $base . '?text=' . $text;
    }
}
